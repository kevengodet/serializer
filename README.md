# adagio/serializer

[![Latest Stable Version](https://poser.pugx.org/adagio/serializer/v/stable)](https://packagist.org/packages/adagio/serializer)
[![Build Status](https://travis-ci.org/adagiolabs/serializer.svg)](https://travis-ci.org/adagiolabs/serializer)
[![License](https://poser.pugx.org/adagio/serializer/license)](https://packagist.org/packages/adagio/serializer)
[![Total Downloads](https://poser.pugx.org/adagio/serializer/downloads)](https://packagist.org/packages/adagio/serializer)

A PHP serializer that just works.

## Installation

Install [Composer](https://getcomposer.org) and run the following command to get
the latest version:

```php
composer require adagio/serializer
```

## Usage

```php
<?php

use Adagio\Serializer\DumbSerializer;

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

$serializer = new DumbSerializer;

echo $json = $serializer->serialize($foo));

// Outputs:
// {
//     "myProperty": 123,
//     "bar": {
//         "word1": "Hello",
//         "word2": [
//             "world!"
//         ]
//     }
// }

print_r($serializer->deserialize($json));

// Outputs:
// stdClass Object
// (
//     [myProperty] => 123
//     [bar] => Array
//         (
//             [word1] => Hello
//             [word2] => Array
//                 (
//                     [0] => world!
//                 )
//
//         )
//
// )

print_r($serializer->deserialize($json, Foo::class));

// Outputs:
// Foo Object
// (
//     [myProperty] => 123
//     [bar] => Array
//         (
//             [word1] => Hello
//             [word2] => Array
//                 (
//                     [0] => world!
//                 )
//
//         )
//
// )
```
