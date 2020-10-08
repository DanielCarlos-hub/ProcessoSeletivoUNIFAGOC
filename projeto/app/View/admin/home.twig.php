{% extends "templates/admin.twig.php" %}
{% set page = 'home' %}

{% block title %} SAMED - ADMIN DASHBOARD {% endblock %}
{% block body %}
<div class="page-wrapper">
    <div class="container-fluid pt-2">

    </div>
</div>
{% endblock %}

{% block javascript %}

    <script>
        object = JSON.parse(localStorage.getItem('user'));
        console.log(object);
    </script>

{% endblock %}