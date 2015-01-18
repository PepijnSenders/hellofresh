<?php

namespace Pep\Foundation;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Pep\View\ViewFactory;
use Pep\Routing\Router;
use Pep\Database\Connection;
use Pep\Config\Config;
use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;

class Application implements ArrayAccess, Countable, IteratorAggregate {

  private $viewFactory;
  private $router;
  private $paths;

  public function __construct($paths = []) {
    $this->paths = $paths;

    $this->router = new Router();

    $this->viewFactory = new ViewFactory($this);

    $this->log = new Logger('hellofresh');
    $this->log->pushHandler(new StreamHandler($this->paths['STORAGE'] . '/logs/hellofresh.log', Logger::DEBUG));

    $this->connection = new Connection(
      $this->log,
      Config::get($this, 'database.host'),
      Config::get($this, 'database.user'),
      Config::get($this, 'database.password'),
      Config::get($this, 'database.database')
    );

    date_default_timezone_set(Config::get($this, 'app.timezone'));
  }

  public function getRouter() {
    return $this->router;
  }

  public function getViewFactory() {
    return $this->viewFactory;
  }

  public function getConnection() {
    return $this->connection;
  }

  public function run() {
    $route = $this->router->getRoute();

    $action = $route->getAction();

    $controllerName = $action->getControllerName();
    $controller = new $controllerName($this);

    $response = $controller->{$action->getActionName()}();

    $response->send();
    exit;
  }

  public function offsetSet($offset, $value) {
    if (is_null($offset)) {
      $this->paths[] = $value;
    } else {
      $this->paths[$offset] = $value;
    }
  }

  public function offsetExists($offset) {
    return isset($this->paths[$offset]);
  }

  public function offsetUnset($offset) {
    unset($this->paths[$offset]);
  }

  public function offsetGet($offset) {
    return isset($this->paths[$offset]) ? $this->paths[$offset] : null;
  }

  public function count() {
    return count($this->paths);
  }

  public function getIterator() {
    return new ArrayIterator($this->paths);
  }

}