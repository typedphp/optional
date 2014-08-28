<?php

namespace TypedPHP\Optional\Tests;

use Mockery;
use TypedPHP\Optional\Optional;
use TypedPHP\Optional\None;

class OptionalTest extends TestCase
{
  /**
   * @test
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
