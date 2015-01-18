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
  {% if forceLogin %}
  <legend>
    Please login
  </legend>
  {% endif %}
  <form action="{{ route('users.login') }}" method="POST">
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="text" name="email" id="email" />
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" type="password" name="password" id="password" />
    </div>
    <input type="submit" value="Submit">
  </form>
{% endif %}
{% endblock %}