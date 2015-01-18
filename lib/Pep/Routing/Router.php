<?php

namespace Pep\Routing;

use Pep\Http\Request;

class Router {

  private $request;
  private $collection;

  public function __construct() {
    $this->request = Request::createFromGlobals();
    $this->collection = new RouteCollection();
  }

  public function get($name, $path, $action) {
    $this->collection[] = new Route(Request::METHOD_GET, $name, $path, new Action($action));
  }

  public function post($name, $path, $action) {
    $this->collection[] = new Route(Request::METHOD_POST, $name, $path, new Action($action));
  }

  public function getBaseUrl() {
    return $this->request->getBaseUrl();
  }

  public function getRoute() {
    $route = $this->collection->getRoute($this->request->getMethod(), $this->request->getPathInfo());

    return $route;
  }

  public function getRequest() {
    return $this->request;
  }

  public function getRouteByName($name) {
    $route = $this->collection->getRouteByName($name);

    return $route;
  }

}