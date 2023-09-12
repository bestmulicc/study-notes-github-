# 这里是一个学习笔记
# 前言
开发环境作为一个开发者最重要的东西，一个好的开发环境，能让开发人员得心应手，一个坏的开发环境，会让开发人员做很多重复性高，且效率低下的工作。但是好的开发环境是人来定的，也就是说还是得看个人习惯吧。
## 常规软件
### Obsidian
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909150450.png)
官网地址： https://obsidian.md/
是个人都需要一款简单好用的Markdown笔记软件吧，苦于上一个神器Typora目前已经是收费阶段，并且价格还不便宜！但是上有政策下有对策。在一堆免费的软件中，我选择了国外Obsidian。
Obsidian是基于**Markdown文件**的**本地**知识管理软件，并且开发者承诺Obsidian对于个人使用者**永久免费**。
从目前来看，Obsidian仅对【**发布**】和【**同步**】功能额外收费，8+4每月的价格可以说是非常良心了，而且还有50%的早鸟优惠。况且如果仅将Obsidian作为本地科研笔记知识管理软件，根本不需要这些额外功能。而且【发布】可以用其他软件替代，【同步】可以用git实现。
并且Obsidian的可玩性非常的高，可以安装非常多的插件。
#### PicGO + 腾讯COS + Obsidian
既然选择了Markdown语法作为笔记工具,那么图床总不能少了吧，但是之前用的国外站点的一些免费的图床软件基本都寄了，不是收费就是连不上了。所以我换成了国内的腾讯云COS做为图床基础。
**腾讯COS
直接百度搜索腾讯COS就行，点进去购买一下对象存储就可以，这里就不多赘述了。重点讲一下需要获取的数据以及设置。
创建桶
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909144243.png)
获取配置
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909144417.png)
查看列表的密钥管理（若找不到，则去控制台搜索[ 访问管理CAM ]）
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909144519.png)
在访问管理中
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909144805.png)
安装PicGO
这个的话直接github下载就可以了
https://github.com/Molunerfinn/PicGo
下载完成之后，打开PicGO-图床设置-腾讯云COS
将上面的配置按对应栏填入
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909150341.png)
PicGo就设置完毕了
接下来打开Obsidian，在设置中关闭安全模式，浏览第三方市场
搜索 Image auto upload Plugin 直接安装即可
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909150603.png)
在插件设置中，选择PicGO
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909150732.png)
这样子就设置好了，直接在外面截图复制到Obsidian的文件中，就会自动上传图片了。
### utools
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909151118.png)

这是一个集中的快捷搜索栏，同时也是一个工具栏，它也拥有很多好用的小插件，识别json格式，翻译等等。。直接下载对应版本即可。
*Windows环境下使用ALT+SPEACE唤出
Mac系统下使用Option+SPEACE唤出*
下载之后打开插件市场，就可以安装很多好用的小插件了
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909151251.png)
### Chrome
最强浏览器，不必多说
### 百分浏览器
最强浏览器的儿子，内核都是Chrome，但是一些使用习惯比较符合我的个人操作习惯，这也是我用得最久的一款浏览器，可惜Mac系统不兼容这个浏览器
### ClashX
爬墙小工具，不多赘述。拥有各种版本，建议去github上查找最新版。
### IObit Uninstaller
一个Windows的卸载软件的工具，可以把软件卸载得干干净净，连注册表都会帮你清理。
## Terminal工具
### Iterm2 + Oh-my-zsh
安装教程： https://www.bilibili.com/video/BV14a4y1F7Ss/
（我其实已经安装过一遍了，但是觉得不太好用，就卸载了
### terminus
下载地址： https://www.termius.com/download/macos
个人简单比Iterm2好用，可视化工具更加直观一点，也可以与 Oh-my-zsh 一起使用
## 开发工具
### Homebrew
国内源安装：
```bash
/bin/zsh -c "$(curl -fsSL https://gitee.com/cunkai/HomebrewCN/raw/master/Homebrew.sh)"
```
#### 安装php

```bash
brew install php
```
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910003357.png)
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910010654.png)
校验安装
```bash
php -v
```
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910010911.png)
#### 安装composer
```bash
brew install composer
```

![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910011011.png)
验证安装
```bash
brew install composer
```
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910011057.png)

### Phpstorm
开发工具核心，，JET全家桶之一： https://www.jetbrains.com/phpstorm/
#### 插件
##### env工具
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910000743.png)
##### Codeium(copilot平替)
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910000905.png)
##### Git工具
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910000952.png)
##### PHP注解工具
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910001047.png)
##### PlantUML(程序员画图工具)
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910001136.png)
##### Rainbow Brackets(括号带颜色)
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910001913.png)

##### Atom Material Icons(文件夹美化工具)
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910001958.png)

#### 快捷键
直接上链接： https://laravelacademy.org/books/phpstorm-tutorial
除此之外，也可以自定义一些快捷键，比如打印，打开最近项目
`打开最近项目`
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910013159.png)
`快捷打印`
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230910013230.png)

### Datagrip
连接数据库的工具，JET全家桶之一： https://www.jetbrains.com/datagrip/
### Another Redis Desktop
连接Redis的工具，完全免费： https://github.com/qishibo/AnotherRedisDesktopManager
### Git
官网下载使用即可： https://git-scm.com/downloads
#### 配置SSH链接
配置git
```bash
git config --global user.name "Your Name" 
git config --global user.email "your_email@example.com" 
```

生成ssh键，在命令行中输入以下命令：
```bash
ssh-keygen -t rsa -C "your_email@example.com"`
```

将公钥添加到github或其他git托管平台，将生成的公钥复制到你的git托管平台的ssh密钥设置中。
```bash
cat ~/.ssh/id_rsa.pub
```
测试ssh链接，在命令行中输入以下命令：
```bash
ssh -T git@github.com
```

如果出现类似以下信息，则说明ssh链接配置成功：
```bash
Hi username! You've successfully authenticated, but GitHub does not provide shell access.
```
### Postman
官网下载使用即可： https://www.postman.com/downloads/
## 环境构建
### Docker
前提条件：主板开启虚拟化技术
#### 下载 Docker Desktop for Mac

1. 访问 Docker 的官方网站: [Docker Desktop for Mac](https://link.zhihu.com/?target=https%3A//www.docker.com/products/docker-desktop)
2. 点击 “Download for Mac” 或类似的按钮以下载 Docker Desktop 的最新版本。
#### 安装 Docker Desktop:
1. 打开下载的 `.dmg` 文件。
2. 将 Docker.app 拖到你的 Applications 文件夹。
#### 启动 Docker:

1. 打开 Applications 文件夹，然后双击 Docker.app 以启动它。
2. 第一次启动时，Docker 可能会要求你输入密码以赋予权限。
3. 你应该在 Mac 菜单栏的顶部看到一个小鲸鱼图标，这表示 Docker 正在运行。
#### 验证安装:
1. 打开终端。
2. 输入以下命令以验证 Docker 是否正确安装：
3. 会看到 Docker 的版本号作为输出
   ![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909163636.png)
#### Docker更换国内源
1. 打开Docker桌面应用，找到设置
   ![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909163842.png)
2. 在右侧代码框中输入以下代码
```bash
  "registry-mirrors": [
    "https://docker.mirrors.ustc.edu.cn",
    "https://hub-mirror.c.163.com"
  ]
```
如果没有客户端，可以在终端输入，也可以打开配置文件
```bash
sudo vim /etc/docker/daemon.json
```
3. 验证结果
```bash
// 打开终端输入
docker info
```
出现一下配置，设置成功。
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909164130.png)
#### 构建镜像
**Dockerfile(不适用所有人，包含SFTP工具)
```bash
FROM hyperf/hyperf:7.4-alpine-v3.14-swoole-v4

WORKDIR /opt/www

COPY ./composer.* /opt/www/

RUN git clone https://github.com/assert6/hyperf-watch.git \
    && mv hyperf-watch/hyperf-watch /usr/bin/ \
    && chmod +x  /usr/bin/hyperf-watch \
    && rm -rf hyperf-watch

# sftp windows下使用SFTP文件上传的方式，因为windows下目录映射效率极慢
RUN apk add openssh-server \
    && apk add openssh-sftp-server \
    && ssh-keygen -t rsa -N "" -f /etc/ssh/ssh_host_rsa_key \
    && ssh-keygen -t ecdsa -N "" -f /etc/ssh/ssh_host_ecdsa_key \
    && ssh-keygen -t ed25519 -N "" -f /etc/ssh/ssh_host_ed25519_key

RUN mkdir /root/.ssh \
    && echo "PermitRootLogin yes" >> /etc/ssh/sshd_config \
    && echo "PermitEmptyPasswords yes" >> /etc/ssh/sshd_config \
    && passwd -d root

RUN composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ \
    && composer self-update --2 
COPY . /opt/www

EXPOSE 22
EXPOSE 9501

CMD ["sh", "-c", "/usr/sbin/sshd && /bin/bash"]
```
**构建镜像
```bash
docker build -t hyperf/php7.4:v1.0 .
```
**查看结果
```bash
docker images
```
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909165848.png)
#### 搭建容器
由于容器之间的通信只能通过容器内部访问，并不能通过映射宿主机的端口访问，原因很简单，因为在容器中的127.0.0.1地址就是容器本身的地址，而不是外部宿主机的。
而使用默认网络启动时，容器的IP是无法固定的，它会根据容器的启动顺序进行排序。
所以在搭建之前，先要创建一个自己的网络群才可以。
创建自定义网络
```bash
docker network create --subnet 172.33.0.0/20 work
```
查询网络是否创建成功
```bash
docker network ls
```
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230909232945.png)
构建容器
```bash
// --name 指定名称
// -v 目录映射
// -p 端口映射
// -it 进入容器内部，并像在本地终端一样与容器进行交互
// --privileged 赋予容器特权级别的访问权限
// -u 指定容器内部进程的用户
// --entrypoint 指定容器启动时要执行的命令或程序。

docker run --name redis --net work --ip 172.33.0.2 -p 6379:6379 -dit redis:7.0.13-bookworm

// ...按照自己需求构建容器即可
docker ps -a // 查看所有容器状态
docker start container_name // 启动容器
docker exec -it container_name /bin/sh // 进入container_name容器，并打开终端窗口
```

## Q&A



