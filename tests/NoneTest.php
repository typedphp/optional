<?php

namespace TypedPHP\Optional\Tests;

use TypedPHP\Optional\None;

class NoneTest extends TestCase
{
    /**
     * @test
     *
     * @return void
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
     *
     * @return void
     */
    public function itReturnsNullAsValue()
    {
        $none = new None();

        $this->assertNull(
            $none->value()
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function itHandlesNoneCallbacks()
    {
        $value = "not empty";
        $none  = new None();

        $none->none(function () use (&$value) {
            $value = "empty";
        });

        $this->assertEquals(
            "empty", $value
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function itIgnoresValueCallbacks()
    {
        $value = "empty";
        $none  = new None();

        $none->value(function () use (&$value) {
            $value = "not empty";
        });

        $this->assertEquals(
            "empty", $value
        );
    }
}
