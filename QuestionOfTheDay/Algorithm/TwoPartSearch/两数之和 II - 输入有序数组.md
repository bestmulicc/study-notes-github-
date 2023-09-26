## 两数之和 II - 输入有序数组
![image.png](https://bestacou-1317041502.cos.ap-guangzhou.myqcloud.com/20230926155511.png)

### 解题思路

1.对撞指针。利用数组是有序这个特性，设置前后2个指针，不断移动指针找出答案。
    
```php
class Solution {

    /**
     * @param Integer[] $numbers
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($numbers, $target) {
        $i = 0;
        $j = count($numbers) - 1;
        while($i < $j){
            $arg = $numbers[$i] + $numbers[$j];
            if ($arg === $target){
                return [$i+1,$j+1];
            } else if($arg > $target){
                $j--;
            } else {
                $i++;
            }
        }
        return [];
    }
}
```
2.二分查找。利用数组是有序这个特性，对每个元素进行二分查找，找出答案。
    
```php
class Solution {

    /**
     * @param Integer[] $numbers
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($numbers, $target) {
        $leng = count($numbers);
        for($i=0;$i<$leng;$i++){
            $left = $i + 1;
            $right = $leng - 1;
            while($left <= $right){
                $mid = $left + intval(($right - $left) / 2);
                if($numbers[$mid] === $target - $numbers[$i]){
                    return [$i+1,$mid+1];
                } else if($numbers[$mid] > $target - $numbers[$i]){
                    $right = $mid - 1;
                } else {
                    $left = $mid + 1;
                }
            }
        }
        return [];
    }
}
```
