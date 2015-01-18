<?php

namespace Pep\Config;

use Pep\Foundation\Application;

class Config {

  public static function get(Application $app, $key) {
    $exploded = explode('.', $key);

    $file = $exploded[0];
    $key = $exploded[1];
    $path = $app['APP'] . "/config/$file.php";

    if (file_exists($path)) {
      $config = require $path;

      if (array_key_exists($key, $config)) {
        return $config[$key];
      }
    }
  }

}