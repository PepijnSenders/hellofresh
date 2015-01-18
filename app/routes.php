<?php

$router = $app->getRouter();

$router->get('pages.home', '/', 'PagesController@home');
$router->get('pages.login', '/login', 'PagesController@login');
$router->get('pages.register', '/register', 'PagesController@register');
$router->get('pages.search', '/search', 'PagesController@search');

$router->get('users.logout', '/logout', 'UsersController@logout');
$router->post('users.login', '/login', 'UsersController@login');
$router->post('users.register', '/register', 'UsersController@register');
$router->post('users.search', '/search', 'UsersController@search');