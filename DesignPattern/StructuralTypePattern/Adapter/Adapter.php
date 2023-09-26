<?php

/*
 * ADAPTER（适配器）
 *
 * 适配器模式（Adapter Pattern）是作为两个不兼容的接口之间的桥梁。这种类型的设计模式属于结构型模式，它结合了两个独立接口的功能。
 * 这种模式涉及一个单一的类，该类负责加入独立或不兼容的接口功能。
 * 介绍
 * 意图：将一个类的接口转换成客户希望的另外一个接口。适配器模式使得原本由于接口不兼容而不能一起工作的那些类可以一起工作。
 * 主要解决：主要解决的是接口不兼容的问题。
 * 何时使用：
 * 1、系统需要使用现有的类，而此类的接口不符合系统的需要。
 * 2、想要建立一个可以重复使用的类，用于一些彼此之间没有太大关系的类，（即接口不一致）。
 * 如何解决：继承或依赖（推荐）。
 * 关键代码：适配器继承或依赖已有的对象，实现想要的目标接口。
 * 应用实例： 1、美国的两项插头。 2、JAVA 中的 jdbc。
 * 优点：
 * 1、可以让任何两个没有关联的类一起运行。
 * 2、提高了类的复用。
 * 3、增加了类的透明度。
 * 4、灵活性好。
 * 缺点：
 * 1、过多地使用适配器，会让系统非常零乱。
 * 2、增加代码阅读难度。
 * 3、增加代码编写难度。
 * 使用场景：有动机地修改一个正常运行的系统的接口，这时应该考虑使用适配器模式。
 * 注意事项：适配器不是在详细设计时添加的，而是解决正在服役的项目的问题。
 *
 */

// 美国110V电压
class USAPower
{
    public function getUsaPower(): void
    {
        echo '110V' . PHP_EOL;
    }
}

// 中国220V电压
class ChinaPower
{
    public function getChinaPower(): void
    {
        echo '220V' . PHP_EOL;
    }
}

// 适配器
interface Adapter
{
    public function getPower();
}

// 中国电压适配器
class ChinaPowerAdapter extends ChinaPower implements Adapter
{
    public function getPower()
    {
        $this->getChinaPower();
    }
}

// 美国电压适配器
class USAPowerAdapter extends USAPower implements Adapter
{
    public function getPower()
    {
        $this->getUsaPower();
    }
}

// 电脑
class House
{
    private Adapter $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getPower(): void
    {
        $this->adapter->getPower();
    }
}

$house = new House(new ChinaPowerAdapter());
$house->getPower();

$house = new House(new USAPowerAdapter());
$house->getPower();
