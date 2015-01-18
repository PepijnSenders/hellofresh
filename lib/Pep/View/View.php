<?php

namespace Pep\View;

use Twig_Environment;

class View {

  private $twig;

  public function __construct(Twig_Environment $twig) {
    $this->twig = $twig;
  }

  public function render($template, $arguments = []) {
    $template = $this->twig->loadTemplate($template);

    return $template->render($arguments);
  }

}