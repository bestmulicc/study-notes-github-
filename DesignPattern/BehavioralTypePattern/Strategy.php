<?php
/*
 * STRATEGY（策略）
 *
 * 策略模式（Strategy Pattern）是作为一系列算法的包，它们可以互换使用。策略模式可以让算法独立于使用它的客户而变化。
 * 介绍
 * 有许多算法可对一个正文流进行分行。将这些算法硬编进使用它们的类中是不可取的，其原因如下:
 * 需要换行功能的客户程序如果直接包含换行算法代码的话将会变得复杂，这使得客户程序庞大并且难以维护,尤其当其需要支持多种换行算法时问题会更加严重。
 * 不同的时候需要不同的算法，我们不想支持我们并不使用的换行算法。
 * 当换行功能是客户程序的一个难以分割的成分时,增加新的换行算法或改变现有算法将十分困难。
 *
 * 意图：定义一系列的算法，把它们一个个封装起来，并且使它们可相互替换。
 * 主要解决：在有多种算法相似的情况下，使用 if...else 所带来的复杂和难以维护。
 * 何时使用：一个系统有许多许多类，而区分它们的只是他们直接的行为。
 * 如何解决：将这些算法封装成一个一个的类，任意地替换。
 * 关键代码：实现同一个接口。
 * 应用实例：
 * 1、诸葛亮的锦囊妙计，每一个锦囊就是一个策略。
 * 2、JAVA AWT 中的 LayoutManager。
 * 优点：
 * 1、算法可以自由切换。
 * 2、避免使用多重条件判断。
 * 3、扩展性良好。
 * 缺点：
 * 1、策略类会增多。
 * 2、所有策略类都需要对外暴露。
 * 使用场景：
 * 1、一个系统有许多许多类，而区分它们的只是他们直接的行为。
 * 2、一个系统需要动态地在几种算法中选择一种。
 *
 * 注意事项：可以动态地改变对象的行为，但是不能改变对象的状态。
 */

// 策略接口
interface Algorithm
{
    public function doOperation($num1, $num2);
}

// 策略实现类
class AddAlgorithm implements Algorithm
{
    public function doOperation($num1, $num2): int
    {
        return $num1 + $num2;
    }
}

class SubtractionAlgorithm implements Algorithm
{
    public function doOperation($num1, $num2): int
    {
        return $num1 - $num2;
    }
}

class MultiplicationAlgorithm implements Algorithm
{
    public function doOperation($num1, $num2): float|int
    {
        return $num1 * $num2;
    }
}

// 策略上下文
class Context
{
    private Algorithm $algorithm;

    public function __construct(Algorithm $algorithm)
    {
        $this->algorithm = $algorithm;
    }

    public function executeStrategy($num1, $num2)
    {
        return $this->algorithm->doOperation($num1, $num2);
    }
}

// 测试
$context = new Context(new AddAlgorithm());
echo $context->executeStrategy(8, 6) . PHP_EOL;
$context = new Context(new SubtractionAlgorithm());
echo $context->executeStrategy(8, 6) . PHP_EOL;
$context = new Context(new MultiplicationAlgorithm());
echo $context->executeStrategy(8, 6) . PHP_EOL;

/*
 * Result:
 * 14
 * 2
 * 48
 */