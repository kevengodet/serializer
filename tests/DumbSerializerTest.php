<?php

namespace Adagio\Serializer\Tests;

use Adagio\Serializer\DumbSerializer;

class DumbSerializerTest extends \PHPUnit\Framework\TestCase
{
    function setUp()
    {
        $this->foo = new Foo;
        $this->foo->bar = new Bar;
        $this->serialized = '{
    "myProperty": 123,
    "bar": {
        "word1": "Hello",
        "word2": [
            "world!"
        ]
    }
}';
    }

    function testSerialize()
    {
        $serializer = new DumbSerializer;

        $json = $serializer->serialize($this->foo);
        $this->assertJson($json);
        $this->assertJsonStringEqualsJsonString($this->serialized, $json);
    }

    function testDeserializeStdClass()
    {
        $serializer = new DumbSerializer;

        $obj = new \stdClass;
        $obj->myProperty = 123;
        $obj->bar = [
            'word1' => 'Hello',
            'word2' =>  ['world!'],
        ];

        $this->assertEquals($obj, $serializer->deserialize($this->serialized));
    }

    function testDeserializeCustomClass()
    {
        $serializer = new DumbSerializer;

        $this->assertEquals($this->foo, $serializer->deserialize($this->serialized, Foo::class));
    }
}

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
