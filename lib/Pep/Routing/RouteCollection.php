<?php

namespace Pep\Routing;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;

class RouteCollection implements ArrayAccess, Countable, IteratorAggregate {

  protected $routes = [];

  public function __construct($routes = []) {
    $this->routes = $routes;
  }

  public function getRoute($method, $path) {
    foreach ($this->routes as $route) {
      if ($route->getPath() === $path && $route->getMethod() === $method) {
        return $route;
      }
    }
  }

  public function getRouteByName($name) {
    foreach ($this->routes as $route) {
      if ($route->getName() === $name) {
        return $route;
      }
    }
  }

  public function offsetSet($offset, $value) {
    if (is_null($offset)) {
      $this->routes[] = $value;
    } else {
      $this->routes[$offset] = $value;
    }
  }

  public function offsetExists($offset) {
    return isset($this->routes[$offset]);
  }

  public function offsetUnset($offset) {
    unset($this->routes[$offset]);
  }

  public function offsetGet($offset) {
    return isset($this->routes[$offset]) ? $this->routes[$offset] : null;
  }

  public function count() {
    return count($this->routes);
  }

  public function getIterator() {
    return new ArrayIterator($this->routes);
  }

}