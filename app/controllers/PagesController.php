<?php

use Pep\Routing\Controller;
use Pep\Http\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Pep\Session\Session as PepSession;

class PagesController extends Controller {

  public function home() {
    return $this->render('pages/home.twig.php');
  }

  public function login() {
    return $this->render('pages/login.twig.php', [
      'isLoggedIn' => Session::isLoggedIn($this->app),
      'forceLogin' => PepSession::get('forceLogin'),
    ]);
  }

  public function register() {
    return $this->render('pages/register.twig.php', [
      'isLoggedIn' => Session::isLoggedIn($this->app),
    ]);
  }

  public function search() {
    if (Session::isLoggedIn($this->app)) {
      return $this->render('pages/search.twig.php');
    } else {
      PepSession::set('forceLogin', true);
      return Redirect::route($this->app, 'pages.login');
    }
  }

}