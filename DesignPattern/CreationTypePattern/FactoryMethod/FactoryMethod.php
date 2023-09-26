<?php
/*
 * 简单工厂模式
 *
 * 工厂模式（Factory Pattern）是最常用的设计模式之一。这种类型的设计模式属于创建型模式，它提供了一种创建对象的最佳方式。
 * 在工厂模式中，我们在创建对象时不会对客户端暴露创建逻辑，并且是通过使用一个共同的接口来指向新创建的对象。
 * 意图：定义一个创建对象的接口，让其子类自己决定实例化哪一个工厂类，工厂模式使其创建过程延迟到子类进行。
 * 主要解决：主要解决接口选择的问题。
 * 何时使用：我们明确地计划不同条件下创建不同实例时。
 * 如何解决：让其子类实现工厂接口，返回的也是一个抽象的产品。
 * 关键代码：创建过程在其子类执行。
 *
 * 优点：
 * 1、一个调用者想创建一个对象，只要知道其名称就可以了。
 * 2、扩展性高，如果想增加一个产品，只要扩展一个工厂类就可以。
 * 3、屏蔽产品的具体实现，调用者只关心产品的接口。
 * 缺点：
 * 1、每次增加一个产品时，都需要增加一个具体类和对象实现工厂，这增加了系统的复杂度。
 * 2、系统扩展困难，一定程度上违背了开闭原则。如，增加一个产品，就需要修改工厂接口，这样就会对原有代码造成影响。
 * 使用场景：
 * 1、日志记录器，可以记录文件、数据库、或者内存中的日志，而且用户可以根据需要自己选择日志记录方式，而且代码还可以屏蔽住这种选择，用户使用时无需关心日志记录方式。
 * 2、数据库访问，当用户不知道最后系统采用哪一类数据库，以及数据库可能有变化时。
 * 3、加密方式，用户可以选择用MD5还是SHA加密。
 * 注意事项：在软件开发中，我们应该尽量遵循依赖倒转原则，使用接口或抽象类进行变量的声明，使用具体类进行变量的赋值。
 */

interface Procurement
{
    public function buy();
}

class Product implements Procurement
{
    public function buy()
    {
        echo '采购商品' . PHP_EOL;
    }
}

class Material implements Procurement
{
    public function buy()
    {
        echo '采购物料' . PHP_EOL;
    }
}

class BulkProduct implements Procurement
{
    public function buy()
    {
        echo '采购散装商品' . PHP_EOL;
    }
}

class NoType implements Procurement
{
    public function buy()
    {
        echo '没有输入目标商品哦' . PHP_EOL;
    }
}

class Factory
{
    public static function create($type): Procurement
    {
        return match ($type) {
            'product' => new Product(),
            'material' => new Material(),
            'bulkProduct' => new BulkProduct(),
            default =>  new NoType(),
        };
    }
}

class Client
{
    public function __construct()
    {
        $product = Factory::create('product');
        $product->buy();

        $material = Factory::create('material');
        $material->buy();

        $bulkProduct = Factory::create('bulkProduct');
        $bulkProduct->buy();

        $noType = Factory::create('noType');
        $noType->buy();
    }
}

$worker = new Client();
