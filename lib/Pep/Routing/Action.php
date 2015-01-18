<?php

namespace Pep\Routing;

class Action {

  private $action;

  public function __construct($action) {
    $this->action = $action;
  }

  public function getControllerName() {
    $exploded = explode('@', $this->action);

    return $exploded[0];
  }

  public function getActionName() {
    $exploded = explode('@', $this->action);

    return $exploded[1];
  }

}