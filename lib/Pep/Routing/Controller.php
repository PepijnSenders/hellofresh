<?php

namespace Pep\Routing;

use Pep\Foundation\Application;
use Pep\View\ViewFactory;
use Pep\Http\Response;
use Pep\Database\ORM\Model;

class Controller {

  protected $app;

  public function __construct(Application $app) {
    $this->app = $app;
  }

  public function input($name) {
    $request = $this->app->getRouter()->getRequest();

    return $request->get($name);
  }

  public function render($template, $arguments = []) {
    $view = $this->app->getViewFactory()->create();

    $response = Response::view($view->render($template, $arguments));

    return $response;
  }

}