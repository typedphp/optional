# Optional

![Build Status](http://img.shields.io/travis/typedphp/optional.svg?style=flat-square)
![Code Quality](http://img.shields.io/scrutinizer/g/typedphp/optional.svg?style=flat-square)
![Code Coverage](http://img.shields.io/scrutinizer/coverage/g/typedphp/optional.svg?style=flat-square)
![Version](http://img.shields.io/packagist/v/typedphp/optional.svg?style=flat-square)
![License](http://img.shields.io/packagist/l/typedphp/optional.svg?style=flat-square)

This library is inspired by [the code of Johannes Schmitt](https://github.com/schmittjoh/php-option) and [the writing of Igor Wiedler](https://igor.io/2014/01/10/functional-library-null.html). It is intended to reduce the code required for null-checking. Part of [TypedPHP](https://leanpub.com/typedphp).

## Examples

```php
<?php

require("vendor/autoload.php");

use TypedPHP\Optional\Optional;

class Foo
{
    public function hello()
    {
        return new Bar();
    }
}

class Bar
{
    public function world()
    {
        return "hello world";
    }
}

$optional = new Optional(new Foo());
$optional->hello()->world()->value(); // "hello world"
```

```php
<?php

require("vendor/autoload.php");

use TypedPHP\Optional\None;

$none = new None();
$none->hello()->world()->value(); // null
```

```php
<?php

require("vendor/autoload.php");

use TypedPHP\Optional\None;

$none = new None();
$none
    ->none(function() { print "none"; }); // "none" printed
    ->value(function($value) { print $value; }); // $value not printed

use TypedPHP\Optional\Optional;

$optional = new Optional("hello world");
$optional
    ->none(function() { print "none"; }); // "none" not printed
    ->value(function($value) { print $value; }); // "hello world" printed
```

Once an `Optional` method call returns an empty value, it is transformed into a `None`.

## Installation

```sh
❯ composer require "typedphp/optional:*"
```

## Testing

```sh
❯ composer create-project "typedphp/optional:*" .
❯ vendor/bin/phpunit
```
