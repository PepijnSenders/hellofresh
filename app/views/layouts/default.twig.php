<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Hello Fresh</title>
  <meta name="description" content="">
  <base href="{{ baseUrl }}"></base>
  <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <nav class="navbar navbar-default">
    <ul class="nav navbar-nav">
      <li>
        <a href="{{ route('pages.home') }}">
          Home
        </a>
      </li>
      <li>
        <a href="{{ route('pages.login') }}">
          Login
        </a>
      </li>
      <li>
        <a href="{{ route('pages.register') }}">
          Register
        </a>
      </li>
      <li>
        <a href="{{ route('pages.search') }}">
          Search
        </a>
      </li>
      <li>
        <a href="{{ route('users.logout') }}">
          Logout
        </a>
      </li>
    </ul>
  </nav>
  <div class="container">
    {% block content %}{% endblock %}
  </div>
</body>
</html>