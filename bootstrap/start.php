<?php

use Pep\Foundation\Application;

$app = new Application([
  'PUBLIC' =>  __DIR__ . '/../public',
  'APP' =>  __DIR__ . '/../app',
  'STORAGE' =>  __DIR__ . '/../app/storage',
  'VIEW' =>  __DIR__ . '/../app/views',
]);

require __DIR__ . '/../app/routes.php';

$app->run();