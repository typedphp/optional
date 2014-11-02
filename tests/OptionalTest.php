<?php

namespace TypedPHP\Optional\Tests;

use BadMethodCallException;
use Mockery;
use TypedPHP\Optional\None;
use TypedPHP\Optional\Optional;

class OptionalTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function itReturnsValue()
    {
        $optional = new Optional("hello");

        $this->assertEquals(
            "hello", $optional->value()
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function itReturnsNoneWhenEmpty()
    {
        $mock = Mockery::mock("stdClass");
        $mock->shouldReceive("foo")->andReturn(null);

        $optional = new Optional($mock);

        $this->assertInstanceOf(
            None::class, $optional->foo()
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function itReturnsOptionalWhenNotEmpty()
    {
        $mock = Mockery::mock("stdClass");
        $mock->shouldReceive("bar")->andReturn("foo");

        $optional = new Optional($mock);

        $this->assertInstanceOf(
            Optional::class, $optional->bar()
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function itIgnoresNoneCallbacks()
    {
        $value    = "not empty";
        $optional = new Optional("hello world");

        $optional->none(function () use (&$value) {
            $value = "empty";
        });

        $this->assertEquals(
            "not empty", $value
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function itHandlesValueCallbacks()
    {
        $optional = new Optional("hello world");

        $optional->value(function ($value) {
            $this->assertEquals(
                "hello world", $value
            );
        });
    }

    /**
     * @test
     *
     * @return void
     */
    public function itSquashesNestedOptionals()
    {
        $optional = new Optional(
            new Optional(
                new Optional(
                    new Optional(
                        "hello world"
                    )
                )
            )
        );

        $this->assertEquals(
            "hello world",
            $optional->value()
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function itHandlesOptionalsCreatedWithNulls()
    {
        $optional = new Optional(null);

        $optional->value(function () {
            $this->fail("Value should not be called here.");
        });

        $flag = false;

        $optional->none(function () use (&$flag) {
            $flag = true;
        });

        $this->assertTrue($flag);
    }

    /**
     * @test
     *
     * @return void
     */
    public function itThrowsIfMethodNotImplemented()
    {
        $optional = new Optional("hello world");

        $this->setExpectedException(BadMethodCallException::class);

        $optional->foo();
    }
}
