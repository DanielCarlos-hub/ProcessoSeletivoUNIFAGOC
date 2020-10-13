<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{% block title %} {% endblock %}</title>
    <link rel="shortcut icon" href="{{ASSET}}images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ASSET}}css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ASSET}}css/styles.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
    {% block head %}{% endblock %}
    
</head>
<body>
    {% include "partials/pacient_navbar.twig.php" %}
    <div id="main" class="max-width">
        <main>
            {% block body %}{% endblock %}
        </main>
    </div>
    <script src="{{ASSET}}js/jquery-3.5.1.min.js"></script>
    <script src="{{ASSET}}js/bootstrap.bundle.min.js"></script>
    <script src="{{ASSET}}js/jquery.inputmask.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="{{ASSET}}js/moment-with-locales.js"></script>
    <script src="{{ASSET}}js/custom.js"></script>

    {% block javascript %}{% endblock %}

    <script>
        $('#logout').on("click", function(){
            window.localStorage.clear();
        });

        moment.locale('pt-BR');
    </script>
</body>
</html>