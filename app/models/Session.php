<?php

use Pep\Database\ORM\Model;

use Pep\Foundation\Application;
use Pep\Session\Session as PepSession;
use Pep\Database\DatabaseException;

class Session extends Model {

  protected $table = 'sessions';

  public static function create(Application $app) {
    $session = new self($app);

    $session->key = md5(microtime() * rand());

    return $session;
  }

  public static function isLoggedIn(Application $app) {
    $session = new self($app);

    $session->key = PepSession::get('key');

    try {
      $session->find();
    } catch (DatabaseException $e) {
      return false;
    }

    return !!$session->user_id;
  }

}