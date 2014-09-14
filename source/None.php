<?php

namespace TypedPHP\Optional;

class None
{
    /**
     * @param string $method
     * @param array  $parameters
     *
     * @return None
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
     * @return None
     */
    public function none(callable $then = null)
    {
        $then();
        return $this;
    }
}
