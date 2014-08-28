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
   * @return null
   */
  public function value()
  {
    return null;
  }
}