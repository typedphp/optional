<?php

namespace TypedPHP\Optional;

class Optional
{

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param $value
     *
     * @return Optional
     */
    public function __construct($value)
    {
        if ($value instanceof Optional) {
            $value = $value->value();
        }

        $this->value = $value;
    }

    /**
     * @param mixed $then
     *
     * @return mixed
     */
    public function value(callable $then = null)
    {
        if (is_callable($then)) {
            $then($this->value);
        }

        return $this->value;
    }

    /**
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $callable = [$this->value, $method];

        if (is_callable($callable)) {
            $result = $this->callWithParameters($callable, $parameters);

            if ($this->isNotNone($result)) {
                return new Optional($result);
            }
        }

        return new None();
    }

    /**
     * @param array $callable
     * @param array $parameters
     *
     * @return mixed
     */
    protected function callWithParameters($callable, $parameters)
    {
        return call_user_func_array($callable, $parameters);
    }

    /**
     * @param mixed $result
     *
     * @return bool
     */
    protected function isNotNone($result)
    {
        return !empty($result);
    }

    /**
     * @return $this
     */
    public function none()
    {
        return $this;
    }
}
