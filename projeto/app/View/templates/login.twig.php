<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{% block title %} {% endblock %}</title>
    <link rel="shortcut icon" href="{{ASSET}}images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ASSET}}css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ASSET}}css/login.css">
    {% block head %}{% endblock %}
    
</head>
<body>
    <div id="main" class="max-width">
        <main>
            {% block body %}{% endblock %}
        </main>
    </div>

    <script src="{{ASSET}}js/jquery-3.5.1.min.js"></script>
    <script src="{{ASSET}}js/bootstrap.bundle.min.js"></script>
    {% block javascript %}{% endblock %}    
</body>
</html>