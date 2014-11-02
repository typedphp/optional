<?php

namespace TypedPHP\Optional;

class None
{
    /**
     * @param string $method
     * @param array  $parameters
     *
     * @return $this
     */
    public function __call($method, $parameters)
    {
        return $this;
    }

    /**
     * @param mixed $then
     *
     * @return null
     */
    public function value(callable $then = null)
    {
        return null;
    }

    /**
     * @param mixed $then
     *
     * @return $this
     */
    public function none(callable $then = null)
    {
        $then();
        return $this;
    }
}
