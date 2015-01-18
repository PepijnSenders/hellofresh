<?php

namespace Pep\Http;

use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;
use Pep\Foundation\Application;

class Redirect extends SymfonyRedirectResponse {

  public static function route(Application $app, $name) {
    $router = $app->getRouter();
    $route = $router->getRouteByName($name);

    return $redirectResponse = new self($router->getBaseUrl() . $route->getPath());
  }

}