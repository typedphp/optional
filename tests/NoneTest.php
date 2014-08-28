<?php

namespace TypedPHP\Optional\Tests;

use TypedPHP\Optional\None;

class NoneTest extends TestCase
{
  /**
   * @test
   */
  public function itOnlyReturnsThisOnMethodCalls()
  {
    $none = new None();

    $this->assertSame(
      $none, $none->foo()
    );
  }

  /**
   * @test
   */
  public function itReturnsNullAsValue()
  {
    $none = new None();

    $this->assertNull(
      $none->value()
    );
  }
}
