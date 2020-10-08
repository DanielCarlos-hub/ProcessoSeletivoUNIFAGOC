{% extends "templates/admin.twig.php" %}
{% set page = 'users' %}

{% block title %} SAMED - ADMIN DASHBOARD - LISTA DE PACIENTES {% endblock %}

{% block body %}
<div class="page-wrapper">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
        <li class="breadcrumb-item"><a href="/admin/users/menu">Usuários</a></li>
        <li class="breadcrumb-item active">Pacientes</li>
    </ol>
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <div class="card pt-3 pb-3 pr-3 pl-3">
                    <div class="card-header bg-dark">
                        <button class="btn btn-info btn-sm m-1" role="button" onClick="addPaciente()">Adicionar Paciente</button>
                    </div>
                    <div class="card-body pl-0 pr-0">
                        <table id="pacientes" class="display data-table responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="all">Nome Completo</th>
                                    <th class="all">CPF</th>
                                    <th class="desktop">Usuário</th>
                                    <th class="desktop">Telefone</th>
                                    <th class="desktop">Cadastrado em</th>
                                    <th class="desktop">Ações</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Cadastro de Pacientes -->
<div class="modal fade right" tabindex="-1" role="dialog" id="addPaciente">
    <div class="modal-dialog modal-xlg">
        <div class="modal-content">
            <form class="form-horizontal" id="formPaciente" method="post" autocomplete="off">
                <input type="hidden" id="paciente_id">
                <div class="modal-header p-1">
                    <h5 class="modal-title">Cadastrar novo Paciente</h5>
                    <i class="fas fa-window-close close" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body p-0">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-center pb-0">
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <label for="nome"class="control-label col-form-label" style="padding-left: 15px;">Nome Completo</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="nome" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-2">
                                            <label for="idade"class="control-label col-form-label" style="padding-left: 15px;">Idade</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" maxlength="3" name="idade" id="idade" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="cpf"class="control-label col-form-label" style="padding-left: 15px;">CPF</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control cpf" id="cpf" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pt-0">
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="username"class="control-label col-form-label" style="padding-left: 15px;">Usuário</label>
                                            <div class="col-sm-12">
                                                <input id="username" type="text" class="form-control" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="password"class="control-label col-form-label" style="padding-left: 15px;">Senha</label>
                                            <div class="col-sm-12">
                                                <input id="password" type="password" class="form-control" required autocomplete="off">
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
                                                <input type="text" class="form-control cep" id="end_cep" required autofocus autocomplete="off">
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
                                                <input type="text" class="form-control telefone" id="telefone" autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-3">
                                            <label for="celular" class="control-label col-form-label" style="padding-left: 15px;">Celular</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control celular" id="celular" autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade right" tabindex="-1" role="dialog" id="verPaciente">
    <div class="modal-dialog modal-xlg">
        <div class="modal-content">
            <div class="modal-header p-1">
                <h5 class="modal-title">Dados do Paciente</h5>
                <i class="fas fa-window-close close" data-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
                <table id="dados" class="table table-striped table-bordered">

                </table>
            </div>
        </div>
    </div>
</div>

{% endblock %}

{% block javascript %}

    <script>
    $(document).ready(function(){
        $('.data-table').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: {
                url: 'http://localhost/admin/users/pacientes/index',
                beforeSend: function (request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                error: function (xhr){
                    if(xhr.status == 401){
                        alert("Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!");
                        window.location.href = '/logout';
                    }
                    alert("Error: "+xhr.responseText);
                } 
            },
            "pageLength": 10,
            "ordering": false,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "columnDefs": [
                {
                    "targets": 0,
                    "width": "100px",
                    "data": "agente.nome",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 1,
                    "width": "50px",
                    "data": "agente.cpf",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 2,
                    "width": "50px",
                    "data": "agente.user.username",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 3,
                    "width": "50px",
                    "data": "telefone",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 4,
                    "width": "50px",
                    "data": "agente.created_at",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return datetimePTBR(data);
                    }
                },
                {
                    "targets": 5,
                    "width": "50px",
                    "data": "id",
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return '<button title="Visualizar" role="button" class="btn btn-sm btn-success mr-1" onClick="verPaciente(' + data + ')"><i class="fas fa-eye"></i></button>'+'<button title="Visualizar" role="button" class="btn btn-sm btn-warning mr-1" onClick="editarPaciente(' + data + ')"><i class="fas fa-pencil-alt"></i></button>'+'<button title="Deletar" role="button" class="btn btn-sm btn-danger mr-1" onClick="deletarUsuario(' + data + ')"><i class="fas fa-trash"></i></button>';
                    }
                }
            ],
        });
    });
    
    
    $('#cpf').on("blur", function(){
        validarCPF(this.value);
    })
    function addPaciente(){
        $('#addPaciente').modal('show');
    }
    function createPaciente() {
        paciente = {
            nome: $('#nome').val(),
            cpf: $('#cpf').val(),
            idade: $('#idade').val(),
            end_rua: $('#end_rua').val(),
            end_num: $('#end_num').val(),
            end_bairro: $('#end_bairro').val(),
            end_cidade:  $('#end_cidade').val(),
            end_uf: $('#end_uf').val(),
            end_complemento: $('#end_complemento').val(),
            end_cep: $('#end_cep').val(),
            telefone: $('#telefone').val(),
            celular: $('#celular').val(),
            username: $('#username').val(),
            password: $('#password').val(),
            role: "paciente"
        };
        $.ajax({
            type: "POST",
            url: "http://localhost/admin/users/pacientes/store",
            data: paciente,

            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },

            success: function(response){
                console.log(response);
                $("#addPaciente").modal('hide')
                $('#pacientes').DataTable().ajax.reload()
            },

            error: function (xhr){
                if(xhr.status == 401){
                    alert("Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!");
                    window.location.href = '/logout';
                }
                $("#addPaciente").modal('hide');
                alert("Error: "+xhr.responseText);
            } 
        });
    }

    function editarPaciente(id){

        $.ajax({
            url: "http://localhost/admin/users/paciente/"+id,
            type: "GET",
            dataType: "json",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(data){
                $('#paciente_id').val(data.id);
                $('#nome').val(data.agente.nome);
                $('#cpf').val(data.agente.cpf);
                $('#idade').val(data.idade);
                $('#username').val(data.agente.user.username);
                $('#end_rua').val(data.end_rua);
                $('#end_num').val(data.end_num);
                $('#end_bairro').val(data.end_bairro);
                $('#end_cidade').val(data.end_cidade);
                $('#end_uf').val(data.end_uf);
                $('#end_cep').val(data.end_cep);
                $('#end_complemento').val(data.end_complemento);
                $('#telefone').val(data.telefone);
                $('#celular').val(data.celular);
                
                $('#password').prop('required', false);
                $('#addPaciente').modal('show');
            },
            error: function (xhr){
                if(xhr.status == 401){
                    alert("Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!");
                    window.location.href = '/logout';
                }
                alert("Error: "+xhr.responseText);
            }
        });

    }
    function updatePaciente() {
        paciente = {
            paciente_id: $('#paciente_id').val(),
            nome: $('#nome').val(),
            cpf: $('#cpf').val(),
            idade: $('#idade').val(),
            username: $('#username').val(),
            password: $('#password').val(),
            end_rua: $('#end_rua').val(),
            end_num: $('#end_num').val(),
            end_bairro: $('#end_bairro').val(),
            end_cidade: $('#end_cidade').val(),
            end_uf: $('#end_uf').val(),
            end_cep: $('#end_cep').val(),
            end_complemento: $('#end_complemento').val(),
            telefone: $('#telefone').val(),
            celular: $('#celular').val(),
        };
        $.ajax({
            url: "http://localhost/admin/users/pacientes/update",
            data: paciente,
            type: "PUT",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                console.log(response);
                $("#addPaciente").modal('hide');
                $('#pacientes').DataTable().ajax.reload();
            },
            error: function (xhr){
                if(xhr.status == 401){
                    alert("Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!");
                    window.location.href = '/logout';
                }
                $("#addPaciente").modal('hide');
                alert("Error: "+xhr.responseText);
            }
        });
    }
    $("#formPaciente").submit( function(event){
        event.preventDefault();
        if($('#paciente_id').val() != '')
            updatePaciente($('#paciente_id').val())
        else
            createPaciente();

        $("#addPaciente").modal('hide');
        $("#formPaciente")[0].reset();
    });
    $('#addPaciente').on('hide.bs.modal', function (event) {
        $('#paciente_id').val('');
        $('#formPaciente')[0].reset();
    });

    function verPaciente(id){
        $.ajax({
            url: "http://localhost/admin/users/paciente/"+id,
            type: "GET",
            dataType: "json",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(data){
                console.log(data);
                if(!$('#dados').empty()){
                    $('#dados').empty();
                    corpo = buildTable(data);
                    $('#dados').append(corpo);
                }
                else{
                    corpo = buildTable(data);
                    $('#dados').append(corpo);
                }
                $('#verPaciente').modal('show');
            },
            error: function (xhr){
                if(xhr.status == 401){
                    alert("Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!");
                    window.location.href = '/logout';
                }
                alert("Error: "+xhr.responseText);
            }
        });
    }

    function buildTable(e) {
        var tabela =
            "<thead>"+
                "<th colspan='2' class='text-center'>" + e.agente.nome+ "</th>"+
            "</thead>"+
            "<tbody>"+
                "<tr>" +
                    "<td class='text-right font-weight-bold' style='width: 50%;'>Idade</td>" +
                    "<td class='text-left'>" + e.idade + "</td>" +
                "</tr>"+
                "<tr>" +
                    "<td class='text-right font-weight-bold' style='width: 50%;'>CPF</td>" +
                    "<td class='text-left'>" + e.agente.cpf + "</td>" +
                "</tr>"+
                "<tr>" +
                    "<td class='text-right font-weight-bold' style='width: 50%;'>Nome de Usuário</td>" +
                    "<td class='text-left'>" + e.agente.user.username + "</td>" +
                "</tr>"+
                "<tr>" +
                    "<td class='text-right font-weight-bold' style='width: 50%;'>Data de Cadastro</td>" +
                    "<td class='text-left'>" + datetimePTBR(e.agente.created_at) + "</td>" +
                "</tr>"+
                "<tr>"+
                    "<td colspan='2'>"+
                        "<table class='table table-striped mb-0'>"+
                            "<thead>"+
                                "<tr class='text-center font-weight-bold'>"+
                                    "<th colspan='2'>Endereço</th>"+
                                "</tr>"+
                            "</thead>"+
                            "<tbody>"+
                                "<tr>"+
                                    "<td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - Rua</td>"+
                                    "<td style='border: 0;'>"+e.end_rua+"</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - Nº</td>"+
                                    "<td style='border: 0;'>"+e.end_num+"</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - Bairro</td>"+
                                    "<td style='border: 0;'>"+e.end_bairro+"</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - Cidade</td>"+
                                    "<td style='border: 0;'>"+e.end_cidade+"</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - UF</td>"+
                                    "<td style='border: 0;'>"+e.end_uf+"</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - Complemento</td>"+
                                    "<td style='border: 0;'>"+e.end_complemento+"</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<td class='text-right font-weight-bold' style='width: 50%; border: 0;'>Endereço - CEP</td>"+
                                    "<td style='border: 0;'>"+e.end_cep+"</td>"+
                                "</tr>"+
                            "</tbody>"+
                        "</table>"+
                    "</td>"+
                "</tr>"+
            "</tbody>";
        return tabela;
    }
</script>

{% endblock %}