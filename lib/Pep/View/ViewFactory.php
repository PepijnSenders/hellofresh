<?php

namespace Pep\View;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_SimpleFunction;
use Pep\Routing\Router;
use Pep\Foundation\Application;

class ViewFactory {

  private $app;

  public function __construct(Application $app) {
    $loader = new Twig_Loader_Filesystem($app['VIEW']);

    $this->twig = new Twig_Environment($loader);
    $this->app = $app;

    $this->extendTwig();
  }

  public function extendTwig() {
    $baseUrl = $this->app->getRouter()->getBaseUrl();

    $this->twig->addGlobal('baseUrl', $baseUrl);

    $assetFunction = new Twig_SimpleFunction('asset', function($path) use ($baseUrl) {
      $filePath = "$baseUrl/$path";

      return $filePath;
    });

    $this->twig->addFunction($assetFunction);

    $router = $this->app->getRouter();
    $routeFunction = new Twig_SimpleFunction('route', function($name) use ($router, $baseUrl) {
      $route = $this->app->getRouter()->getRouteByName($name);

      $url = "$baseUrl{$route->getPath()}";

      return $url;
    });

    $this->twig->addFunction($routeFunction);
  }

  public function create() {
    return new View($this->twig);
  }

}