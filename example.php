<?php

interface MyInterface
{
    //Contains abstract functions
    // public function test() {}

    //Cannot contain non-abstract functions
    public function firstFunction();
}

class MyClass
{
    //Contains non-abstract functions
    public function normalFunction()
    {
    }

    //cannot contain abstract functions
    // public function abstractFunction();
}

abstract class MyAbstractClass
{
    //Contains non-abstract functions
    public function normalFunction()
    {
    }

    //cannot contain abstract functions
    public abstract function abstractFunction();
}

// class A {}

// class B extends A {}

//**************************/

// class A
// {
//     public function test()
//     {
//     }
// }

// class B extends A
// {
// }

//**************************/

// abstract class A
// {
//     public function test()
//     {
//     }
// }

// class B extends A
// {
// }

//**************************/

abstract class A
{
    public function test()
    {
    }

    public abstract function myAbstractFunction();
}

class B extends A
{

    public function myAbstractFunction()
    {
    }
}


interface Test
{
    function t1();
}
