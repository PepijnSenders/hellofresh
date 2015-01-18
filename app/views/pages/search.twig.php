{% extends 'layouts/default.twig.php' %}

{% block content %}
{% if error %}
<p class="text-danger">
  {{ error }}
</p>
{% endif %}
<form action="{{ route('users.search') }}" method="POST">
  <div class="form-group">
    <label for="query">Query</label>
    <input class="form-control" type="text" name="query" id="query" />
  </div>
  <input type="submit" value="Submit">
</form>
{% endblock %}