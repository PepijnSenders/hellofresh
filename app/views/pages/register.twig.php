{% extends 'layouts/default.twig.php' %}

{% block content %}
{% if isLoggedIn %}
  <p class="text-danger">You are already logged in</p>
{% else %}
  {% if error %}
  <p class="text-danger">
    {{ error }}
  </p>
  {% endif %}
  <form action="{{ route('users.register') }}" method="POST">
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="text" name="email" id="email" />
    </div>
    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" id="name" />
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" type="password" name="password" id="password" />
    </div>
    <div class="form-group">
      <label for="password_repeat">Repeat Password</label>
      <input class="form-control" type="password" name="password_repeat" id="password_repeat" />
    </div>
    <input type="submit" value="Submit">
  </form>
{% endif %}
{% endblock %}