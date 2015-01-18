<?php

namespace Pep\Routing;

class Route {

  private $method;
  private $name;
  private $path;
  private $action;

  public function __construct($method, $name, $path, Action $action) {
    $this->method = $method;
    $this->name = $name;
    $this->path = $path;
    $this->action = $action;
  }

  public function getName() {
    return $this->name;
  }

  public function getPath() {
    return $this->path;
  }

  public function getAction() {
    return $this->action;
  }

  public function getMethod() {
    return $this->method;
  }

}