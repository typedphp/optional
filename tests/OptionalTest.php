<?php

namespace TypedPHP\Optional\Tests;

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
}
