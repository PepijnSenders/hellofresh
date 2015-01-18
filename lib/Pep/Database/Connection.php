<?php

namespace Pep\Database;

use Monolog\Logger;

use mysqli;

class Connection {

  private $connection;
  private $log;

  public function __construct(Logger $log, $host, $user, $password, $database) {
    $this->log = $log;

    $this->connection = new mysqli($host, $user, $password, $database);

    if ($this->connection->connect_errno) {
      throw new DatabaseException("Failed to connect to MySQL: ({$this->connection->connect_errno}) {$this->connection->connect_error}");
    }
  }

  public function save($table, $properties) {
    $insertQuery = "INSERT INTO {$table} (`";
    $insertQuery .= implode('`, `', array_keys($properties)) . '`) VALUES (\'';

    $connection = $this->connection;
    $escapedProperties = array_map(function($value) use ($connection) {
      return mysqli_real_escape_string($connection, $value);
    }, $properties);
    $insertQuery .= implode('\', \'', $escapedProperties) . '\')';

    $this->log->addDebug("QUERY: $insertQuery");
    $result = $connection->query($insertQuery);

    if ($connection->error) {
      throw new DatabaseException("Failed to insert into $table, $connection->error");
    }
  }

  private function select($table, $properties) {
    $selectQuery = "SELECT * FROM $table WHERE ";

    foreach ($properties as $property => $value) {
      $selects[] = "`$property` = '". mysqli_real_escape_string($this->connection, $value) . "'";
    }

    $selectQuery .= implode(' OR ', $selects);

    $this->log->addDebug($selectQuery);
    $result = $this->connection->query($selectQuery);

    if ($this->connection->error) {
      throw new DatabaseException("Failed to select from $table, $this->connection->error");
    }

    return $result;
  }

  public function findAll($table, $properties) {
    $result = $this->select($table, $properties);

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function find($table, $properties) {
    $result = $this->select($table, $properties);
    $model = $result->fetch_assoc();

    if (!$model) {
      throw new DatabaseException("Model not found.");
    }

    return $model;
  }

}