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
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function value()
    {
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

        if ($this->isCallable($callable)) {
            $result = $this->callWithParameters($callable, $parameters);

            if ($this->isNotNone($result)) {
                return new Optional($result);
            }
        }

        return new None();
    }

    /**
     * @param array $callable
     *
     * @return bool
     */
    protected function isCallable($callable)
    {
        return is_callable($callable);
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
}
