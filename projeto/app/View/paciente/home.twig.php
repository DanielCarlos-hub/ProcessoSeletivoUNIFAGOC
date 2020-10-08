{% extends "templates/pacient.twig.php" %}

{% block title %} SAMED - AREA DO PACIENTE {% endblock %}

{% block body %}
<div class="page-wrapper">
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <div id="msg">
                </div>
                <div class="card pt-3 pb-3 pr-3 pl-3">
                    <div class="card-header text-center">
                        Lista de médicos disponíveis para atendimento
                    </div>
                    <div class="card-body mx-auto">
                        <div class="row pb-2">
                            {% for medico in medicos %}
                                <div class="col-lg-3 d-flex flex-fill">
                                    <div class="card mx-auto">
                                        <img src="{{ASSET}}images/avatar.png" width="100%" height="128" class="" alt="capa">

                                        <div class="card-body ">
                                            <h5 class="card-title">
                                                {{ medico.agente.nome }}
                                            </h5>

                                            <p class="card-text">
                                                CPF: {{ medico.agente.cpf }}<br>
                                                CRM: {{ medico.crm }}
                                            </p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form class="atendimento" method="POST">
                                                        <input type="hidden" name="medico_id" value="{{medico.id}}">
                                                        <input type="hidden" name="user_id" value="{{user.id}}">
                                                        <button type="submit" class="btn btn-block btn-success" role="button">Solicitar Atendimento</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {% else %}
                                <div class="alert alert-info w-100">
                                    Nenhum Médico encontrado
                                </div>
                            {% endfor %}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}

{% block javascript %}

<script>
    
    function createAtendimento() {
        atendimento = {
            medico_id: $('#medico_id').val(),
            user_id: $('#user_id').val(),
        };
        $.ajax({
            type: "POST",
            url: "http://localhost/paciente/home",
            data: atendimento,

            success: function(response){
                $('#msg').append("<div class='alert alert-success'>"+response+"</div>");
                setTimeout(function(){
                    location.reload();
                }, 4000);
            },
            error: function (xhr){
                if(xhr.status == 401){
                    $('#msg').append("<div class='alert alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"<br>Efetue o login novamente!</div>");
                    window.location.href = '/logout';
                }
                $('#msg').append("<div class='alert alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
            } 
        });
    }

    $('form .atendimento').submit(function(e){
        e.preventDefault();
        if($('input[name ="medico_id"]').val() != '' && $('input[name ="paciente_id"]').val() != '' ){
            createAtendimento();
        }
    })
</script>

{% endblock %}