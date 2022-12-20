<?php
/*
 * 原型模式（Prototype Pattern）是用于创建重复的对象，同时又能保证性能。
 *
 * 这种模式是基于“复制”的概念，可以在运行时创建新的对象。
 *
 * 优点：
 * 可以快速创建对象。原型模式可以快速创建对象，因为不需要调用构造函数。
 * 可以避免创建的复杂度。如果创建对象的过程很复杂，使用原型模式可以避免这种复杂度。
 * 可以改变对象的类型。使用原型模式，可以将对象的类型改变为另一个类型。
 * 缺点：
 * 必须实现 Cloneable 接口。使用原型模式时，必须实现 Cloneable 接口，这可能带来一定的麻烦。
 * 可能存在安全问题。使用原型模式时，可能存在安全问题，因为对象的状态可能被意外修改
 *
 * 原型模式的主要角色如下。
 * 抽象原型类（Prototype）：规定了具体原型对象必须实现的接口。
 * 具体原型类（Concrete Prototype）：实现抽象原型类的 clone() 方法，它是可被复制的对象。
 * 访问类（Client）：访问类使用具体原型类中的 clone() 方法来复制新的对象。
 *
 * 应用场景：
 * 类初始化需要消化非常多的资源，这个资源包括数据、硬件资源等。
 * new 产生一个对象需要非常繁琐的数据准备或访问权限，则可以使用原型模式。
 * 一个对象多个修改者的场景，例如：一个对象需要提供给其他对象访问，而且各个调用者可能都需要修改其值时，可以考虑使用原型模式拷贝多个对象供调用者使用。
 * 创建新对象成本较大（如初始化需要占用较长的时间，占用太多的CPU资源或网络资源），新的对象可以通过原型模式对已有对象进行复制来获得，如果是相似对象，则可以对其成员变量稍作修改。
 * 如果系统要保存对象的状态，而对象的状态变化很小，或者对象本身占用内存不大的时候，则可以使用原型模式配合备忘录模式来实现。
 *
 */

// 假设我们要开发一个订单系统，其中订单中包含了订单项目（OrderItem）。订单项目中包含了商品信息（Product）和购买数量（Quantity）。
// 我们可以使用原型模式来创建新的订单项目。

// 订单项目类
class OrderItem
{
    private Product $product;
    private int $quantity;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function clone(): OrderItem
    {
        return clone $this;
    }
}

// 商品类
class Product
{
    private string $name;
    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}

// 创建商品
$product1 = new Product('Phone', 999.99);
$product2 = new Product('Tablet', 499.99);

// 创建订单项目
$item1 = new OrderItem($product1, 1);
$item2 = new OrderItem($product2, 2);

// 使用原型模式创建新的订单项目
$item3 = $item1->clone();
$item3->setProduct($product2);
$item3->setQuantity(3);

$item4 = $item2->clone();
$item4->setProduct($product1);
$item4->setQuantity(4);

// 输出订单项目信息
echo "Item 1: " . $item1->getProduct()->getName() . " x " . $item1->getQuantity() . "\n";
// 项目 1：手机 x 1
echo "Item 2: " . $item2->getProduct()->getName() . " x " . $item2->getQuantity() . "\n";
// 项目 2：平板电脑 x 2
echo "Item 3: " . $item3->getProduct()->getName() . " x " . $item3->getQuantity() . "\n";
// 项目 3：平板电脑 x 3
echo "Item 4: " . $item4->getProduct()->getName() . " x " . $item4->getQuantity() . "\n";
// 项目 4：手机 x 4
