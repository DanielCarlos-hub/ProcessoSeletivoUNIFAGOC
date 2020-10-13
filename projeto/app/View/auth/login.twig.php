{% extends "templates/login.twig.php" %}

{% block title %} SAMED - LOGIN {% endblock %}
{% block body %}

<div class="page-wrapper">
    <div class="container-fluid pt-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div id="msg">
                </div>
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Login - SAMED</div>
                    <div class="card-body">
                        <form id="frmLogin"> 
                            <div class="form-group">
                                <label for="usuario">Usuário</label>
                                <input type="text" class="form-control" name="username" id="usuario" placeholder="Usuário">
                            </div>
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="save" id="save">
                                        <label class="form-check-label" for="save">
                                            Salvar?
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}

{% block javascript %}

    <script>
    $("#frmLogin").submit(function(e){
        e.preventDefault();
        $.post('http://localhost/login', $("#frmLogin").serialize(), function(data){
            console.log(data);
            localStorage.setItem('token', data.jwt);
            localStorage.setItem('user', JSON.stringify(data.user));
            switch (data.user.userRole) {
                case 'admin':
                    window.location.href = '/admin/home';
                    break;
                case 'paciente':
                    window.location.href = '/paciente/home';
                    break;
                case 'medico':
                    window.location.href = '/medico/home';
                default:
                    break;
            }
        }, "json").fail(function(xhr){
            $('#msg').append("<div class='alert alert-fixed alert-danger'>"+xhr.responseText+"</div>");
            setTimeout(function(){
                $(".alert").alert('close');
            }, 4000);
        });
    });
    </script>

{% endblock %}