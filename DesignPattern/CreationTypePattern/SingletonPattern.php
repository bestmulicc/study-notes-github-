<?php

/*
 * 单例模式（Singleton Pattern）是最简单的设计模式之一。这种类型的设计模式属于创建型模式，它提供了一种创建对象的最佳方式。
 * 这种模式涉及到一个单一的类，该类负责创建自己的对象，同时确保只有单个对象被创建。这个类提供了一种访问其唯一的对象的方式，可以直接访问，不需要实例化该类的对象。
 *
 * 介绍
 * 意图：保证一个类仅有一个实例，并提供一个访问它的全局访问点。
 * 主要解决：一个全局使用的类频繁地创建与销毁。
 * 何时使用：当您想控制实例数目，节省系统资源的时候。
 * 如何解决：判断系统是否已经有这个单例，如果有则返回，如果没有则创建。
 * 关键代码：构造函数是私有的。
 * 应用实例：
 * 1、一个党只能有一个主席。
 * 2、Windows 是多进程环境，每进程有一个独立的实例。
 * 3、一次只能打开一个文件，比如使用记事本打开一个文件，那么此时记事本程序实例化一个对象，其他想要实例化记事本的程序必须等待，直到文件被关闭。
 *
 * 优点：
 * 1、在内存里只有一个实例，减少了内存的开销，特别是一个对象需要频繁地创建与销毁的时候。
 * 2、避免对资源的多重占用（比如写文件操作）。
 * 缺点：
 * 没有接口，扩展困难。
 *
 * 使用场景：
 * 1、要求生产唯一序列号。
 * 2、WEB 中的计数器，不用每次刷新都在数据库里加一次，用单例先缓存起来。
 * 3、创建的一个对象需要消耗的资源过多，比如 I/O 与数据库的连接等。
 * 注意事项：getInstance() 方法中需要使用同步锁 synchronized (Singleton.class) 防止多线程同时进入造成 instance 被多次实例化。
 *
 * 单例模式的几种实现方式
 * 1、懒汉式，线程不安全
 * 2、懒汉式，线程安全
 * 3、饿汉式
 * 4、双检锁/双重校验锁（DCL，即 double-checked locking）
 * 5、登记式/静态内部类
 * 6、枚举
 */

final class Singleton
{
    private static $instance;

    /**
     * 不允许从外部调用以防止创建多个实例
     */
    private function __construct()
    {
    }
    /**
     * 懒汉式，线程不安全
     * 是否 Lazy 初始化：是
     * 是否多线程安全：否
     * 实现难度：易
     * 描述：这种方式是最基本的实现方式，这种实现最大的问题就是不支持多线程。因为没有加锁 synchronized，所以严格意义上它并不算单例模式。
     * 这种方式 lazy loading 很明显，不要求线程安全，在多线程不能正常工作。
     */
    public static function getLazyInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * 饿汉式
     * 是否 Lazy 初始化：否
     * 是否多线程安全：是
     * 实现难度：易
     * 描述：这种方式比较常用，但容易产生垃圾对象。
     * 优点：没有加锁，执行效率会提高。
     * 缺点：类加载时就初始化，浪费内存。
     * 它基于 classloader 机制避免了多线程的同步问题，
     * 不过，instance 在类装载时就实例化，在单例模式中大多数都是调用 getInstance 方法，
     * 但是导致类装载的原因有很多种，因此不能确定有其他的方式（或者其他的静态方法）导致类装载，
     * 这时候初始化 instance 显然没有达到 lazy loading 的效果。
     */
//    private static $instance = new Singleton();
//    public static function getInstance(){
//        return $instance;
//    }


    /**
     * 防止实例被克隆（这会创建实例的副本）
     */
    private function __clone()
    {
    }

    /**
     * 防止反序列化（这将创建它的副本）
     */
    private function __wakeup()
    {
    }
}

$singleton = Singleton::getLazyInstance();
var_dump($singleton);

