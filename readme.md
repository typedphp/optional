# Optional

This library is inspired by [the code of Johannes Schmitt](https://github.com/schmittjoh/php-option) and [the writing of Igor Wiedler](https://igor.io/2014/01/10/functional-library-null.html). It is intended to reduce the code required for null-checking. Part of [TypedPHP](https://leanpub.com/typedphp).

[![Build Status](https://travis-ci.org/typedphp/php-optional.svg?branch=master)](https://travis-ci.org/typedphp/php-optional)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/typedphp/php-optional/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/typedphp/php-optional/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/typedphp/php-optional/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/typedphp/php-optional/?branch=master)

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

## License

[MIT](license.md)
