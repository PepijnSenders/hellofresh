{% extends 'layouts/default.twig.php' %}

{% block content %}
{% if users %}
  <table class="table">
    <thead>
      <tr>
        <th>Email</th>
        <th>Name</th>
      </tr>
    </thead>
    <tbody>
    {% for user in users %}
      <tr>
        <td>{{ user.email }}</td>
        <td>{{ user.name }}</td>
      </tr>
    {% endfor %}
    </tbody>
  </table>
{% else %}
  <p class="text-danger">No results</p>
{% endif %}
{% endblock %}