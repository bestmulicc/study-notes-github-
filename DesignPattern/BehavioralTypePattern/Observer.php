<?php
/*
 * Observer（观察者）
 *
 * 观察者模式（Observer Pattern）也叫发布-订阅模式（Publish/Subscribe Pattern），
 * 它定义对象间的一种一对多的依赖关系，当一个对象的状态发生改变时，所有依赖于它的对象都得到通知并被自动更新。
 * 观察者模式又叫做模型-视图模式（Model-View-Controller Pattern），它是一种对象行为型模式。
 * 观察者模式包含以下主要角色。
 * 1. 抽象主题（Subject）角色：抽象主题角色把所有观察者对象的引用保存在一个集合中，每个主题都可以有任意数量的观察者。抽象主题提供一个接口，可以增加和删除观察者对象。
 * 2. 具体主题（Concrete Subject）角色：将有关状态存入具体观察者对象；在具体主题的内部状态改变时，给所有登记过的观察者发出通知。
 * 3. 抽象观察者（Observer）角色：为所有的具体观察者定义一个接口，在得到主题的通知时更新自己。
 * 4. 具体观察者（Concrete Observer）角色：实现抽象观察者角色所要求的更新接口，以便使本身的状态与主题的状态协调。
 * 主要解决：一个对象状态发生改变时，所有依赖于它的对象都得到通知并被自动更新。
 * 何时使用：
 * 1、当一个抽象模型有两个方面，其中一个方面依赖于另一个方面。将这两者封装在独立的对象中使它们可以各自独立地改变和复用。
 * 2、当对一个对象的改变需要同时改变其它对象，而不知道具体有多少对象有待改变。
 * 3、当一个对象必须通知其它对象，而它又不能假定其它对象是谁。
 * 如何解决：使用面向对象技术，可以将这种依赖关系弱化。
 * 关键代码：在抽象类里有一个 ArrayList 存放观察者们。
 * 优点：
 * 1、观察者和被观察者是抽象耦合的。
 * 2、建立一套触发机制。
 * 缺点：
 * 1、如果一个被观察者有很多直接和间接观察者时，将所有的观察者都通知到会花费很多时间。
 * 2、如果在观察者和被观察者之间有循环依赖，观察者会等待被观察者通知，而被观察者也在等待观察者，就形成了僵局。
 * 3、观察者模式需要考虑一下开发效率和运行效率的问题，程序中包括一个被观察者、多个观察者，开发和调试等内容会比较复杂，而且在Java中消息的通知默认是顺序执行，一个观察者卡壳，会影响整体的执行效率，在这种情况下，一般会采用异步的方式。
 * 使用场景：
 * 1、拍卖的时候，拍卖师观察最高标价，然后通知给其他竞价者竞价。
 * 2、西游记里面悟空请求菩萨降服红孩儿，菩萨洒了一地水招来一个老乌龟，这个乌龟就是观察者，他观察菩萨洒水这个动作。
 * 注意事项：
 * 1、避免循环引用。
 * 2、注意代码的优化。
 * 3、注意线程安全。
 */

// 被观察者接口
interface Subject
{
    public function register(Observer $observer);  //添加（注册）观察者对象

    public function detach(Observer $observer);    //删除观察者对象

    public function notify();                      //通知观察者执行相应功能
}

// 观察者接口
interface Observer
{
    public function watch();                      //更新
}

// 被观察者继承类
class Action implements Subject
{
    private $observers = [];                      //观察者对象集合

    // 添加（注册）观察者对象
    public function register(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    // 删除观察者对象
    public function detach(Observer $observer)
    {
        foreach ($this->observers as $k => $v) {
            if ($v == $observer) {
                unset($this->observers[$k]);
            }
        }
    }

    // 通知观察者执行相应功能
    public function notify()
    {
        foreach ($this->observers as $v) {
            $v->watch();
        }
    }
}

// User观察者继承类
class User implements Observer
{
    // 更新
    public function watch()
    {
        echo '人类观察者执行相应功能'.PHP_EOL;
    }
}

// Cat观察者继承类
class Cat implements Observer
{
    // 更新
    public function watch()
    {
        echo '猫观察者执行相应功能'.PHP_EOL;
    }
}

// Dog观察者继承类
class Dog implements Observer
{
    // 更新
    public function watch()
    {
        echo '狗观察者执行相应功能'.PHP_EOL;
    }
}

// 实例化被观察者
$action = new Action();
// 实例化观察者
$action->register(new User());
$action->register(new Cat());
$action->register(new Dog());
// 通知观察者执行相应功能
$action->notify();

