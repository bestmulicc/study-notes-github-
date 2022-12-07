## 学习背景

写代码不光要考虑实现，也要考虑代码的效率问题。最近在做力扣题的时候，经常遇到对时间，空间复杂度有要求的题目。但对于这个概念并不清楚，故需要学习一下。

## 时间复杂度

时间复杂度是对一个算法在运行过程中所消耗的时间进行的一个量度。它是一个函数，这个函数的值是问题规模n的某个函数。通常用大O记法来表示，即O(f(n))。其中，f(n)随着问题规模n的增大而增大，但增长率不会超过f(n)。常见的时间复杂度有：

* O(1)：常数复杂度
* O(logn)：对数复杂度
* O(n)：线性复杂度
* O(nlogn)：线性对数复杂度
* O(n^2)：平方复杂度
* O(n^3)：立方复杂度
* O(2^n)：指数复杂度
* O(n!)：阶乘复杂度
* O(n^k)：k次方复杂度
* O(n^m+n^k)：多项式复杂度
* O(n!)：阶乘复杂度

### 常数阶O(1)

无论代码执行了多少行，只要是没有循环等复杂结构，那这个代码的时间复杂度就都是O(1)，如：

```php 
int i = 1;
int j = 2;
++i;
j++;
int m = i + j;
```

上述代码在执行的时候，它消耗的时候并不随着某个变量的增长而增长，那么无论这类代码有多长，即使有几万几十万行，都可以用O(1)来表示它的时间复杂度。

### 对数阶O(logn)

```php 
int i = 1;
while(i<n)
{
    i = i * 2;
}
```

从上面代码可以看到，在while循环里面，每次都将 i 乘以 2，乘完之后，i 距离 n 就越来越近了。我们试着求解一下，假设循环x次之后，i 就大于 n 了，此时这个循环就退出了，也就是说 2 的 x 次方等于 n，那么 x =
log2^n
也就是说当循环 log2^n 次以后，这个代码就结束了。因此这个代码的时间复杂度为：O(logn)

### 线性对数阶O(nlogN)

```php
for(m=1; m<n; m++)
{
    i = 1;
    while(i<n)
    {
        i = i * 2;
    }
}
```

将时间复杂度为O(logn)的代码循环N遍的话，那么它的时间复杂度就是 n * O(logN)，也就是了O(nlogN)。

### 平方阶O(n²)

```php
for(i=1; i<n; i++)
{
    for(j=1; j<n; j++)
    {
        x = i * j;
    }
}
```

上面代码中，有两个for循环，外层循环执行了n次，内层循环也执行了n次，因此这个代码的时间复杂度就是O(n²)。
如果将其中一层循环的n改成m，即：

```php
for(i=1; i<n; i++)
{
    for(j=1; j<m; j++)
    {
        x = i * j;
    }
}
```

那么这个代码的时间复杂度就是O(nm)。

### 立方阶O(n³)、K次方阶O(n^k)

```php
for(i=1; i<n; i++)
{
    for(j=1; j<n; j++)
    {
        for(k=1; k<n; k++)
        {
            x = i * j * k;
        }
    }
}
```

参考上面的O(n²) ，O(n³)相当于三层n循环.