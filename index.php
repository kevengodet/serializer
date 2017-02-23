<?php

require_once __DIR__.'/vendor/autoload.php';

class Foo
{
    private $myProperty = 123;

    /**
     * @var Bar
     */
    public $bar;
}

class Bar
{
    private $word1 = 'Hello';
    protected $word2 = ['world!'];
}

$foo = new Foo;
$foo->bar = new Bar;

$serializer = new Adagio\Serializer\DumbSerializer;
var_dump($json = $serializer->serialize($foo));
print_r($serializer->deserialize($json));
print_r($serializer->deserialize($json, Foo::class));