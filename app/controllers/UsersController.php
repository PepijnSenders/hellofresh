<?php

use Pep\Routing\Controller;
use Pep\Validation\ValidationException;
use Pep\Session\Session as PepSession;
use Pep\Database\DatabaseException;
use Pep\Http\Redirect;

class UsersController extends Controller {

  public function login() {
    $session = new Session($this->app);

    $session->key = PepSession::get('key');

    try {
      $session->find();
    } catch (DatabaseException $e) {
      $user = new User($this->app);

      $user->email = $this->input('email');
      $user->password = $this->input('password');

      try {
        $user->find();
      } catch (DatabaseException $e) {
        return $this->render('pages/login.twig.php', [
          'error' => $e->getMessage(),
        ]);
      }

      $session = Session::create($this->app);
      $session->user_id = $user->id;

      $session->save();

      PepSession::create([
        'key' => $session->key,
      ]);
      return Redirect::route($this->app, 'pages.search');
    }

    return Redirect::route($this->app, 'pages.search');
  }

  public function register() {
    $user = new User($this->app);

    $user->email = $this->input('email');
    $user->name = $this->input('name');

    if ($this->input('password') !== $this->input('password_repeat')) {
      return $this->render('pages/register.twig.php', [
        'error' => 'Passwords don\'t match.',
      ]);
    }

    $user->password = $this->input('password');

    try {
      $user->validate();
    } catch (ValidationException $e) {
      return $this->render('pages/register.twig.php', [
        'error' => $e->getMessage(),
      ]);
    }

    try {
      $user->save();
    } catch (DatabaseException $e) {
      return $this->render('pages/register.twig.php', [
        'error' => $e->getMessage(),
      ]);
    }

    return $this->render('pages/thanks.twig.php');
  }

  public function search() {
    $user = new User($this->app);

    $user->name = $this->input('query');
    $user->email = $this->input('query');

    $users = $user->findAll();

    return $this->render('pages/results.twig.php', [
      'users' => $users,
    ]);
  }

  public function logout() {
    PepSession::destroy('key');

    return Redirect::route($this->app, 'pages.login');
  }

}