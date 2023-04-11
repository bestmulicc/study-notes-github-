## 前言
在使用ES做为查询服务的时候，常常会遇到关联查询的问题。毕竟ES是以文档为单位的，想要达到联表查询的效果比较的麻烦。但是ES官方也有提供关联关系查询的方式，今天就学习一下其中的父子关系查询（Parent-Child）。
## ES查询
### 回顾一下ES
#### 索引解释
一个 Elasticsearch 集群可以 包含多个 *索引* ，相应的每个索引可以包含多个 *类型* 。 这些不同的类型存储着多个 *文档* ，每个文档又有 多个 *属性* 。
索引（名词）：
如前所述，一个 *索引* 类似于传统关系数据库中的一个 *数据库* ，是一个存储关系型文档的地方。 *索引* (*index*) 的复数词为 *indices* 或 *indexes* 。
索引（动词）：
*索引一个文档* 就是存储一个文档到一个 *索引* （名词）中以便被检索和查询。这非常类似于 SQL 语句中的 `INSERT` 关键词，除了文档已存在时，新文档会替换旧文档情况之外。

倒排索引：
关系型数据库通过增加一个 *索引* 比如一个 B树（B-tree）索引 到指定的列上，以便提升数据检索速度。Elasticsearch 和 Lucene 使用了一个叫做 *倒排索引* 的结构来达到相同的目的。

#### 基本概念

##### Node与Cluster

Elastic 本质上是一个分布式数据库，允许多台服务器协同工作，每台服务器可以运行多个 Elastic 实例。

单个 Elastic 实例称为一个节点（node）。一组节点构成一个集群（cluster）。

##### Index

Elastic 会索引所有字段，经过处理后写入一个反向索引（Inverted Index）。查找数据的时候，直接查找该索引。

所以，Elastic 数据管理的顶层单位就叫做 Index（索引）。它是单个数据库的同义词。每个 Index （即数据库）的名字必须是小写。

下面的命令可以查看当前节点的所有 Index。

```bash
curl -X GET 'http://localhost:9200/_cat/indices?v'
```

##### Document

Index 里面单条的记录称为 Document（文档）。许多条 Document 构成了一个 Index。

`同一个 Index 里面的 Document，不要求有相同的结构（scheme），但是最好保持相同，这样有利于提高搜索效率。`

##### Type

Document 可以分组，比如`weather`这个 Index 里面，可以按城市分组（北京和上海），也可以按气候分组（晴天和雨天）。这种分组就叫做 Type，它是虚拟的逻辑分组，用来过滤 Document。

不同的 Type 应该有相似的结构（schema），举例来说，`id`字段不能在这个组是字符串，在另一个组是数值。这是与关系型数据库的表的一个区别。性质完全不同的数据（比如`products`和`logs`）应该存成两个 Index，而不是一个 Index 里面的两个 Type（虽然可以做到）。

#### 新建&删除 索引

新建 Index，可以直接向 Elastic 服务器发出 PUT 请求。

```bash
curl -X PUT 'localhost:9200/library' // 新建一个library的索引

// 返回体
{
  "acknowledged":true, // 表示操作成功
  "shards_acknowledged":true
}
```

删除Index，发出 DELETE 请求，删除这个 Index。

```bash
curl -X DELETE 'localhost:9200/library' // 删除一个library的索引
```

#### 短语搜索

找出一个属性中的独立单词是没有问题的，但有时候想要精确匹配一系列单词或者_短语_ 。 比如， 我们想执行这样一个查询，仅匹配同时包含 “rock” *和* “climbing” ，*并且* 二者以短语 “rock climbing” 的形式紧挨着的雇员记录。

为此对 `match` 查询稍作调整，使用一个叫做 `match_phrase` 的查询：

```php
GET /megacorp/employee/_search
{
    "query" : {
        "match_phrase" : {
            "about" : "rock climbing"
        }
    }
}
```

```php
{
   ...
   "hits": {
      "total":      1,
      "max_score":  0.23013961,
      "hits": [
         {
            ...
            "_score":         0.23013961,
            "_source": {
               "first_name":  "John",
               "last_name":   "Smith",
               "age":         25,
               "about":       "I love to go rock climbing",
               "interests": [ "sports", "music" ]
            }
         }
      ]
   }
}
```

#### 高亮搜索

许多应用都倾向于在每个搜索结果中 *高亮* 部分文本片段，以便让用户知道为何该文档符合查询条件。在 Elasticsearch 中检索出高亮片段也很容易。

再次执行前面的查询，并增加一个新的 `highlight` 参数：

```php
GET /megacorp/employee/_search
{
    "query" : {
        "match_phrase" : {
            "about" : "rock climbing"
        }
    },
    "highlight": {
        "fields" : {
            "about" : {}
        }
    }
}
```

```html
{
   ...
   "hits": {
      "total":      1,
      "max_score":  0.23013961,
      "hits": [
         {
            ...
            "_score":         0.23013961,
            "_source": {
               "first_name":  "John",
               "last_name":   "Smith",
               "age":         25,
               "about":       "I love to go rock climbing",
               "interests": [ "sports", "music" ]
            },
            "highlight": {
               "about": [
                  "I love to go <em>rock</em> <em>climbing</em>" 
               ]
            }
         }
      ]
   }
}
```

#### 分析

终于到了最后一个业务需求：支持管理者对员工目录做分析。 Elasticsearch 有一个功能叫聚合（aggregations），允许我们基于数据生成一些精细的分析结果。聚合与 SQL 中的 `GROUP BY` 类似但更强大。

举个例子，挖掘出员工中最受欢迎的兴趣爱好：

```php
GET /megacorp/employee/_search
{
  "aggs": {
    "all_interests": {
      "terms": { "field": "interests" }
    }
  }
}
```

```php
{
   ...
   "hits": { ... },
   "aggregations": {
      "all_interests": {
         "buckets": [
            {
               "key":       "music",
               "doc_count": 2
            },
            {
               "key":       "forestry",
               "doc_count": 1
            },
            {
               "key":       "sports",
               "doc_count": 1
            }
         ]
      }
   }
}
```

如果想知道叫 Smith 的员工中最受欢迎的兴趣爱好，可以直接构造一个组合查询：

```php
GET /megacorp/employee/_search
{
  "query": {
    "match": {
      "last_name": "smith"
    }
  },
  "aggs": {
    "all_interests": {
      "terms": {
        "field": "interests"
      }
    }
  }
}
```

`all_interests` 聚合已经变为只包含匹配查询的文档：

```php
  "all_interests": {
     "buckets": [
        {
           "key": "music",
           "doc_count": 2
        },
        {
           "key": "sports",
           "doc_count": 1
        }
     ]
  }
```

聚合还支持分级汇总 。比如，查询特定兴趣爱好员工的平均年龄：

```php
GET /megacorp/employee/_search
{
    "aggs" : {
        "all_interests" : {
            "terms" : { "field" : "interests" },
            "aggs" : {
                "avg_age" : {
                    "avg" : { "field" : "age" }
                }
            }
        }
    }
}
```

```php
	"all_interests": {
     "buckets": [
        {
           "key": "music",
           "doc_count": 2,
           "avg_age": {
              "value": 28.5
           }
        },
        {
           "key": "forestry",
           "doc_count": 1,
           "avg_age": {
              "value": 35
           }
        },
        {
           "key": "sports",
           "doc_count": 1,
           "avg_age": {
              "value": 25
           }
        }
     ]
  }
```

#### 索引文档

##### 使用自定义的ID

```php
PUT /{index}/{type}/{id}
{
  "field": "value",
  ...
}
```

举个例子，如果我们的索引称为 `website` ，类型称为 `blog` ，并且选择 `123` 作为 ID ，那么索引请求应该是下面这样：

```sense
PUT /website/blog/123
{
  "title": "My first blog entry",
  "text":  "Just trying this out...",
  "date":  "2014/01/01"
}
```

Elasticsearch 响应体如下所示：

```js
{
   "_index":    "website",
   "_type":     "blog",
   "_id":       "123",
   "_version":  1,
   "created":   true
}
```

##### ES自动生成ID

```sense
POST /website/blog/
{
  "title": "My second blog entry",
  "text":  "Still trying this out...",
  "date":  "2014/01/01"
}
```

除了 `_id` 是 Elasticsearch 自动生成的，响应的其他部分和前面的类似：

```js
{
   "_index":    "website",
   "_type":     "blog",
   "_id":       "AVFgSgVHUP18jI2wRx0w",
   "_version":  1,
   "created":   true
}
```

#### 取回一个文档

```sense
GET /website/blog/123?pretty
```

响应体包括目前已经熟悉了的元数据元素，再加上 `_source` 字段，这个字段包含我们索引数据时发送给 Elasticsearch 的原始 JSON 文档：

```js
{
  "_index" :   "website",
  "_type" :    "blog",
  "_id" :      "123",
  "_version" : 1,
  "found" :    true,
  "_source" :  {
      "isbn": "9787532781508"
  }
}
```
查询结果：
```json
{
        "isbn": "9787532781508",
        "name": "伊甸园",
        "author": "[美] 欧内斯特·海明威",
        "description": "★ 海明威诞辰120周年 名家名译\n★ “潜下水去，潜到我们还能回得上来的深处。”\n-\n美国青年作家戴维在20世纪20年代和妻子凯瑟琳从巴黎到法国南部地中海海滨度蜜月，沉醉在浪漫的性爱生活中。戴维想继续写作，妻子却只想及时行乐，找发型师把头发铰短，甚至在结识外国姑娘玛丽塔 后，怂恿丈夫爱她，三人投入了危险的性爱游戏中。但好景不长，因玛丽塔支持戴维写作，凯瑟琳由妒生恨，把他的手稿付之一炬后留信出走。戴维在玛丽塔的呵护下，文思泉涌，把最喜爱的一个短篇一字不错地重写出来，又回到了“伊甸园” 中。\n-\n本书是海明威1961年自杀后出版的遗作，虽然写于晚年身体日渐衰退的时期，但全书焕发着如火如荼的生命力与爱情，是一部难得的青春小说。...",
        "publishing_company": "上海译文出版社",
        "img_url": "https://kk-library-manager-private-test.oss-cn-shenzhen.aliyuncs.com/398135048640143360/9e573cc3a45d12d308838385d9d6a544.jpeg?OSSAccessKeyId=LTAI5t7vK7JGmV8ZSxzHDEDY&Expires=1666672384&Signature=TzVosa7ydb43Xwvacn%2BKKxajKIw%3D",
    }
```

## ES-父子关系查询
ES是以文档为单位的，父数据为一个文档，子数据为一个文档，那么父子文档与索引的关系图为：
![](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230411153755.png)
说明什么，父子文档使用的是同一个索引，这个索引里面包括了父子文档的所有字段。
### 定义父文档
```text
{
    "title":"父子关系标题",
    "author":"Acou",
    "content":"XoX",
    "created":12345678,
    "relation":
}
```
### 定义子文档
```text
{
    "name":"子名称",
    "content":"OxO",
    "created": 987654321
    "relation":
}
```
### 定义索引
```text
{
	"mappings":{
		"properties":{
			"title":{
				"type":"text"
				}
			},
			"author":{
				"type":"text"
				}
			},
			"content":{
				"type":"text",
			},
			"created":{
				"type":"date"
			},
			"name":{
				"type":"text"
			},
			"relation":{
				"type":"join",
				"relations":{
					"Father":"Son"
				}
			}
		}
	}
}
```
重点的是"relation"字段，可以看到类型定义为`join`，relations定义了谁是父谁是子，"Father":"Son"表示Father是父，Son是子。

父子文档的插入是父与子分别插入(可以理解为把两个表塞到了一张表里)。
### 插入
#### 父文档
```text
POST http://localhost:9200/blog/1
{
    "title":"父子关系标题",
    "author":"Acou",
    "content":"XoX",
    "created":12345678,
    "relation": "Father"
}
```
#### 子文档
```text
POST http://localhost:9200/blog/2?routing=1
{
    "name":"子名称",
    "content":"OxO",
    "created": 987654321
    "relation":{
    	"name":"Son",
    	"parent":1
    }
}
```
这样，ES中的父子关系文档就创建好了。
### 搜索
#### 父查子
查询author为“Acou”的所有子文档
```text
GET http://localhost:9200/blog/_search
{
	"query":{
		"has_parent":{
			"parent_type":"Father",
			"query":{
				"match":{
					"author":"Acou"
				}
			}
		}
	}
}
```
ES只返回了relation结构中的子数据，而不是全部包括文章数据也返回。
这是嵌套对象查询与父子文档查询的区别之一——**子文档可以单独返回**。
#### 子查父
查询父数据中含有“XoX”的描述
```text
GET http://localhost:9200/blog/artice/_search
{
	"query":{
		"has_child":{
			"type":"Son",
			"query":{
				"match":{
					"content":"XoX"
				}
			}
		}
	}
}
```
ES同样也只返回了父文档的数据，而没有子文档的数据。
### 总结
创建父子文档有几个关键的点在于创建索引时，要加入一个类型为`join`的字段，并将它用于关联关系的作用。同时索引还需要将父子文档中的所有字段包含在索引中（两表塞一表）。
父子文档创建成功后，ES提供了2种方式，父查子，子查父。
它们的结构大致相同，在定义好结构之后，就可以在嵌套里的query中写入查询语句了。