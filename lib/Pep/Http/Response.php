<?php

namespace Pep\Http;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Response extends SymfonyResponse {

  public static function view($view) {
    $response = new self($view, self::HTTP_OK, [
      'content-type' => 'text/html',
    ]);

    return $response;
  }

}