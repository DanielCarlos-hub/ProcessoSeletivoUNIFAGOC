{% extends "templates/pacient.twig.php" %}
{% set page = 'cadastro' %}

{% block title %} SAMED - AREA DO PACIENTE {% endblock %}

{% block body %}
<div class="page-wrapper">
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <div id="msg">
                </div>

                <table id="dados" class="table table-striped table-bordered">
                    <thead>
                        <th colspan='2' class='text-center' id="paciente_nome"></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class='text-right font-weight-bold' style='width: 50%;'>CPF</td>
                            <td class='text-left' id="paciente_cpf"></td>
                        </tr>
                        <tr>
                            <td class='text-right font-weight-bold' style='width: 50%;'>Idade</td>
                            <td class='text-left' id="paciente_idade"></td>
                        </tr>
                        <tr>
                            <td class='text-right font-weight-bold' style='width: 50%;'>Telefone</td>
                            <td class='text-left' id="paciente_telefone"></td>
                        </tr>
                        <tr>
                            <td class='text-right font-weight-bold' style='width: 50%;'>Celular</td>
                            <td class='text-left' id="paciente_celular"></td>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <table class='table table-striped mb-0'>
                                    <thead>
                                        <tr class='text-center font-weight-bold'>
                                            <th colspan='2'>Endereço</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - Rua</td>
                                            <td style='border: 0;' id="paciente_end_rua"></td>
                                        </tr>
                                        <tr>
                                            <td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - Nº</td>
                                            <td style='border: 0;' id="paciente_end_num"></td>
                                        </tr>
                                        <tr>
                                            <td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - Bairro</td>
                                            <td style='border: 0;' id="paciente_end_bairro"></td>
                                        </tr>
                                        <tr>
                                            <td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - Cidade</td>
                                            <td style='border: 0;' id="paciente_end_cidade"></td>
                                        </tr>
                                        <tr>
                                            <td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - UF</td>
                                            <td style='border: 0;' id="paciente_end_uf"></td>
                                        </tr>
                                        <tr>
                                            <td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - Complemento</td>
                                            <td style='border: 0;' id="paciente_end_complemento"></td>
                                        </tr>
                                        <tr>
                                            <td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - CEP</td>
                                            <td style='border: 0;' id="paciente_end_cep"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#anonimizar"> Anonimizar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Cadastro de Pacientes -->
<div class="modal fade right" tabindex="-1" role="dialog" id="anonimizar">
    <div class="modal-dialog modal-xlg">
        <div class="modal-content">
            <form class="form-horizontal" id="formAnonimizar" method="post" autocomplete="off">
                <input type="hidden" id="paciente_id">
                <div class="modal-header p-1">
                    <h5 class="modal-title">Anonimizar seus dados do Cadastro</h5>
                    <i class="fas fa-window-close close" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body p-0">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="alert alert-sm alert-info">Atenção! Não será possível desfazer após confirmação</div>
                                    <div class="row justify-content-center pb-0">
                                        <div class="col-12 col-sm-6 col-lg-10">
                                            <label for="nome"class="control-label col-form-label" style="padding-left: 15px;">Nome Completo</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="nome" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <label for="end_rua"class="control-label col-form-label" style="padding-left: 15px;">Endereço</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="end_rua" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-2">
                                            <label for="end_num"class="control-label col-form-label" style="padding-left: 15px;">Nº</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" maxlength="8" id="end_num" required autofocus autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="end_bairro"class="control-label col-form-label" style="padding-left: 15px;">Bairro</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="end_bairro" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-sm-6 col-lg-5">
                                            <label for="end_cidade"class="control-label col-form-label" style="padding-left: 15px;">Cidade</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="end_cidade" required autofocus autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-3">
                                            <label for="end_uf"class="control-label col-form-label" style="padding-left: 15px;">UF</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" maxlength="2" id="end_uf" required autofocus autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="end_cep"class="control-label col-form-label" style="padding-left: 15px;">CEP</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="end_cep" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <label for="end_complemento"class="control-label col-form-label" style="padding-left: 15px;">Complemento</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control"  id="end_complemento" autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3 col-lg-3">
                                            <label for="telefone"class="control-label col-form-label" style="padding-left: 15px;">Telefone</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="telefone" autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-3">
                                            <label for="celular" class="control-label col-form-label" style="padding-left: 15px;">Celular</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="celular" autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
{% endblock %}

{% block javascript %}

<script>
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "http://localhost/paciente/user/dados",
            data: {user_id: "{{user.id}}"},
            dataType: "json",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                $('#paciente_nome').text(response.nome);
                $('#paciente_cpf').text(response.cpf);
                $('#paciente_idade').text(response.idade);
                $('#paciente_telefone').text(response.telefone);
                $('#paciente_celular').text(response.celular);

                $('#paciente_end_rua').text(response.end_rua);
                $('#paciente_end_num').text(response.end_num);
                $('#paciente_end_cidade').text(response.end_cidade);
                $('#paciente_end_uf').text(response.end_uf);
                $('#paciente_end_complemento').text(response.end_complemento);
                $('#paciente_end_cep').text(response.end_cep);

            },
            error: function (xhr){
                if(xhr.status == 401){
                    $('#msg').append("<div class='alert alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                    setTimeout(function(){
                        window.location.href = '/logout';
                    }, 4000);
                }
                $('#msg').append("<div class='alert alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
            } 
        });
    })


    $('#anonimizar').on('shown.bs.modal', function () {
        $.ajax({
            type: "GET",
            url: "http://localhost/paciente/user/anonimizar",
            data: {user_id: "{{user.id}}"},
            dataType: "json",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                $('#paciente_id').val(response.paciente_id);
                $('#nome').val(response.nome);
                $('#telefone').val(response.telefone);
                $('#celular').val(response.celular);

                $('#end_rua').val(response.end_rua);
                $('#end_num').val(response.end_num);
                $('#end_bairro').val(response.end_bairro);
                $('#end_cidade').val(response.end_cidade);
                $('#end_uf').val(response.end_uf);
                $('#end_complemento').val(response.end_complemento);
                $('#end_cep').val(response.end_cep);

            },
            error: function (xhr){
                if(xhr.status == 401){
                    $('#msg').append("<div class='alert alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                    setTimeout(function(){
                        window.location.href = '/logout';
                    }, 4000);
                }
                $('#msg').append("<div class='alert alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
            } 
        });
    })

    $('#anonimizar').on('hide.bs.modal', function () {
        $('#paciente_id').val('');
        $('#formAnonimizar')[0].reset();
    });

    $('#formAnonimizar').submit(function(){
        event.preventDefault();
        paciente = {
            paciente_id: $('#paciente_id').val(),
            nome: $('#nome').val(),
            cpf: $('#cpf').val(),
            telefone: $('#telefone').val(),
            celular: $('#celular').val(),
            end_rua: $('#end_rua').val(),
            end_num: $('#end_num').val(),
            end_bairro: $('#end_bairro').val(),
            end_cidade: $('#end_cidade').val(),
            end_uf: $('#end_uf').val(),
            end_complemento: $('#end_complemento').val(),
            end_cep: $('#end_cep').val(),
        };
        $.ajax({
            url: "http://localhost/paciente/user/anonimizar",
            data: paciente,
            type: "PUT",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                $("#anonimizar").modal('hide');
                $('#msg').append("<div class='alert alert-success'>"+response+"</div>");
                setTimeout(function(){
                    location.reload();
                }, 4000);
            },
            error: function (xhr){
                if(xhr.status == 401){
                    $('#msg').append("<div class='alert alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                    setTimeout(function(){
                        window.location.href = '/logout';
                    }, 4000);
                }
                $('#msg').append("<div class='alert alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
            }
        });
    })
</script>
{% endblock %}