<?php

namespace Pep\Session;

class Session {

  public static function create($values = []) {
    self::startSession();
    foreach ($values as $key => $value) {
      $_SESSION[$key] = $value;
    }
  }

  public static function set($key, $value) {
    self::startSession();
    $_SESSION[$key] = $value;
  }

  public static function get($key) {
    self::startSession();
    if (array_key_exists($key, $_SESSION)) {
      return $_SESSION[$key];
    }
  }

  public static function startSession() {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
  }

  public static function destroy($key) {
    self::startSession();
    unset($_SESSION[$key]);
  }

}