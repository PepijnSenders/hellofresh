<?php

namespace Pep\Http;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest {

  public static function server($key) {
    if (array_key_exists($key, $_SERVER)) {
      return $_SERVER[$key];
    }
  }

}