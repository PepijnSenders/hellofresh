<?php

namespace Pep\Database\ORM;

use Pep\Support\Str;
use Pep\Foundation\Application;
use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;

class Model implements ArrayAccess, Countable, IteratorAggregate {

  private $properties;
  protected $table;
  protected $app;
  protected $validations = [];
  protected $hidden = [];

  public function __construct($app, $properties = []) {
    $this->properties = $properties;
    $this->app = $app;
  }

  public function save() {
    $connection = $this->app->getConnection();

    $connection->save($this->table, $this->properties);
  }

  public function find() {
    $connection = $this->app->getConnection();

    $properties = $connection->find($this->table, $this->properties);

    $this->properties = $this->properties + $properties;
  }

  public function findAll() {
    $connection = $this->app->getConnection();

    $models = $connection->findAll($this->table, $this->properties);

    return $models;
  }

  public function validate() {
    foreach ($this->properties as $property => $value) {
      if (array_key_exists($property, $this->validations)) {
        $validations = explode('|', $this->validations[$property]);

        foreach ($validations as $validation) {
          if (preg_match('/\:/', $validation)) {
            $exploded = explode(':', $validation);

            $validation = $exploded[0];
            $otherProperty = $exploded[1];

            $arguments = [$property, $otherProperty, $value, $this[$otherProperty]];
          } else {
            $arguments = [$property, $value];
          }

          $validationFunction = Str::camel("validate_$validation");

          call_user_func_array(['Pep\\Validation\\Validator', $validationFunction], $arguments);
        }
      }
    }
  }

  public function offsetSet($offset, $value) {
    if (is_null($offset)) {
      $this->properties[] = $value;
    } else {
      $this->properties[$offset] = $value;
    }
  }

  public function offsetExists($offset) {
    return isset($this->properties[$offset]);
  }

  public function offsetUnset($offset) {
    unset($this->properties[$offset]);
  }

  public function offsetGet($offset) {
    return isset($this->properties[$offset]) ? $this->properties[$offset] : null;
  }

  public function count() {
    return count($this->properties);
  }

  public function getIterator() {
    return new ArrayIterator($this->properties);
  }

  public function __get($name) {
    $getter = Str::camel("get_$name");

    if (method_exists($this, $getter)) {
      return $this->$getter();
    }

    if (array_key_exists($name, $this->properties)) {
      return $this->properties[$name];
    }
  }

  public function __set($name, $value) {
    $setter = Str::camel("set_$name");
    if (method_exists($this, $setter)) {
      $value = $this->$setter($this->app, $value);
    }
    $this->properties[$name] = $value;
  }

}