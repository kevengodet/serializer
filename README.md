# adagio/serializer

[![Latest Stable Version](https://poser.pugx.org/adagiolabs/serializer/version.svg)](https://packagist.org/packages/adagiolabs/serializer)
[![Build Status](https://secure.travis-ci.org/adagio/serializer.svg)](http://travis-ci.org/adagiolabs/serializer)
[![License](https://poser.pugx.org/adagio/serializer/license.svg)](https://packagist.org/packages/adagiolabs/serializer)
[![Downloads](https://poser.pugx.org/adagio/serializer/d/total.svg)](https://packagist.org/packages/adagiolabs/serializer)

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
