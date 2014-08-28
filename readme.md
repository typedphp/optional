# Optional

This library is inspired by [the code of Johannes Schmitt](https://github.com/schmittjoh/php-option) and [the writing of Igor Wiedler](https://igor.io/2014/01/10/functional-library-null.html). It is intended to reduce the code required for null-checking.

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
$none->foo()->bar()->baz()->value(); // null
```

Once an `Optional` method call returns an empty value, it is transformed into a `None`.

## License

[MIT](license.md)
