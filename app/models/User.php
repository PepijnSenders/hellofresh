<?php

use Pep\Database\ORM\Model;
use Pep\Foundation\Application;
use Pep\Config\Config;

class User extends Model {

  protected $table = 'users';

  protected $validations = [
    'email' => 'required|email',
    'name' => 'required',
    'password' => 'required',
  ];

  public function setPassword(Application $app, $value) {
    return md5($value . Config::get($app, 'app.salt'));
  }

}