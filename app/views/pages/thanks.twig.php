{% extends 'layouts/default.twig.php' %}

{% block content %}
{% if error %}
<p class="text-danger">
  {{ error }}
</p>
{% endif %}
Thanks for registering, click <a href="{{ route('pages.login') }}">here</a> to login.
{% endblock %}