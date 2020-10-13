{% extends "templates/admin.twig.php" %}
{% set page = 'users' %}

{% block title %} SAMED - ADMIN DASHBOARD - LISTA DE MÉDICOS {% endblock %}

{% block body %}
<div class="page-wrapper">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
        <li class="breadcrumb-item"><a href="/admin/users/menu">Usuários</a></li>
        <li class="breadcrumb-item active">Médicos</li>
    </ol>
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <div id="msg">
                </div>
                <div class="card pt-3 pb-3 pr-3 pl-3">
                    <div class="card-header bg-dark">
                        <button class="btn btn-info btn-sm m-1" role="button" onClick="addMedico()">Adicionar Médico</button>
                    </div>
                    <div class="card-body pl-0 pr-0">
                        <table id="medicos" class="display data-table responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="all">Nome Completo</th>
                                    <th class="all">CPF</th>
                                    <th class="desktop">Usuário</th>
                                    <th class="desktop">CRM</th>
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
<div class="modal fade right" tabindex="-1" role="dialog" id="addMedico">
    <div class="modal-dialog modal-xlg">
        <div class="modal-content">
            <form class="form-horizontal" id="formMedico" method="post" autocomplete="off">
                <input type="hidden" id="medico_id">
                <div class="modal-header p-1">
                    <h5 class="modal-title">Cadastrar novo Médico</h5>
                    <i class="fas fa-window-close close" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body p-0">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-center pb-0">
                                        <div class="col-12 col-sm-6 col-lg-5">
                                            <label for="nome" class="control-label col-form-label" style="padding-left: 15px;">Nome Completo</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="nome" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="cpf"class="control-label col-form-label" style="padding-left: 15px;">CPF</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control cpf" id="cpf" required autofocus autocomplete="off">
                                                <div id="cpfValidate"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-3">
                                            <label for="crm"class="control-label col-form-label" style="padding-left: 15px;">CRM</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="crm" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pt-0">
                                        <div class="col-12 col-sm-6 col-lg-5">
                                            <label for="username"class="control-label col-form-label" style="padding-left: 15px;">Usuário</label>
                                            <div class="col-sm-12">
                                                <input id="username" type="text" class="form-control" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-5">
                                            <label for="password"class="control-label col-form-label" style="padding-left: 15px;">Senha</label>
                                            <div class="col-sm-12">
                                                <input id="password" type="password" class="form-control" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pt-0">
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="especialidades" class="control-label col-form-label" style="padding-left: 15px;">Especialidades</label>
                                                    <div class="col-sm-12">
                                                           
                                                        <select class="form-control select2" name="especialidades[]" id="especialidades" multiple="multiple" required>
                                                        {% for especialidade in especialidades %}
                                                            <option value="{{especialidade.id}}">{{especialidade.espec}}</option>
                                                        {% endfor %}
                                                        </select>
                                                        <div class="pt-2">
                                                            <span class="btn btn-info btn-xs deselect-all">Limpar</span>
                                                        </div>
                                                    </div>
                                                </div>
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

<div class="modal fade right" tabindex="-1" role="dialog" id="verMedico">
    <div class="modal-dialog modal-xlg">
        <div class="modal-content">
            <div class="modal-header p-1">
                <h5 class="modal-title">Dados do Médico</h5>
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
                url: 'http://localhost/admin/users/medicos/index',
                beforeSend: function (request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                error: function (xhr){
                    if(xhr.status == 401){
                        $('#msg').append("<div class='alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                        setTimeout(function(){
                            window.location.href = '/logout';
                        }, 4000);
                    }
                    $('#msg').append("<div class='alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                    setTimeout(function(){
                        $(".alert").alert('close');
                    }, 4000);
                    
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
                    "data": "crm",
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
                        return '<button title="Visualizar" role="button" class="btn btn-sm btn-success mr-1" onClick="verMedico(' + data + ')"><i class="fas fa-eye"></i></button>'+'<button title="Visualizar" role="button" class="btn btn-sm btn-warning mr-1" onClick="editarMedico(' + data + ')"><i class="fas fa-pencil-alt"></i></button>';
                    }
                }
            ],
        });
    });
    
    
    $('#cpf').on("blur", function(){
        validarCPF(this.value);
    })
    function addMedico(){
        $('#addMedico').modal('show');
    }
    function createMedico() {
        medico = {
            nome: $('#nome').val(),
            cpf: $('#cpf').val(),
            crm: $('#crm').val(),
            username: $('#username').val(),
            password: $('#password').val(),
            especialidades: $('#especialidades').val(),
            role: "medico"
        };
        $.ajax({
            type: "POST",
            url: "http://localhost/admin/users/medicos/store",
            data: medico,

            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },

            success: function(response){
                $("#addMedico").modal('hide')
                $('#medicos').DataTable().ajax.reload()
                $('#msg').append("<div class='alert alert-fixed alert-fixed alert-info'>"+response+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 5000);
            },
            error: function (xhr){
                $("#addMedico").modal('hide');
                if(xhr.status == 401){
                    $('#msg').append("<div class='alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                    setTimeout(function(){
                        window.location.href = '/logout';
                    }, 4000);
                }
                $('#msg').append("<div class='alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 4000);
            } 
        });
    }
    function editarMedico(id){

        $.ajax({
            url: "http://localhost/admin/users/medico/"+id,
            type: "GET",
            dataType: "json",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(data){
                $('#medico_id').val(data.id);
                $('#nome').val(data.agente.nome);
                $('#cpf').val(data.agente.cpf);
                $('#crm').val(data.crm);
                $('#username').val(data.agente.user.username);
                $('#password').prop('required', false);

                var especs = [];
                for(var i = 0; i < data.especialidades.length; i++)
                {
                    especs[i] = data.especialidades[i].id
                }
                $('#especialidades').val(especs);
                $('#especialidades').trigger("change");

                $('#addMedico').modal('show');
            },
            error: function (xhr){
                if(xhr.status == 401){
                    $('#msg').append("<div class='alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                    setTimeout(function(){
                        window.location.href = '/logout';
                    }, 4000);
                }
                $('#msg').append("<div class='alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 4000);
            }
        });

    }
    function updateMedico() {
        medico = {
            medico_id: $('#medico_id').val(),
            nome: $('#nome').val(),
            cpf: $('#cpf').val(),
            crm: $('#crm').val(),
            username: $('#username').val(),
            password: $('#password').val(),
            especialidades: $('#especialidades').val(),
        };
        $.ajax({
            url: "http://localhost/admin/users/medicos/update",
            data: medico,
            type: "PUT",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                $("#addMedico").modal('hide');
                $('#medicos').DataTable().ajax.reload();
                $('#msg').append("<div class='alert alert-fixed alert-fixed alert-info'>"+response+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 5000);
            },
            error: function (xhr){
                $("#addMedico").modal('hide');
                if(xhr.status == 401){
                    $('#msg').append("<div class='alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                    setTimeout(function(){
                        window.location.href = '/logout';
                    }, 4000);
                }
                $('#msg').append("<div class='alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 4000);
            }
        });
    }
    $("#formMedico").submit( function(event){
        event.preventDefault();
        if($('#medico_id').val() != '')
            updateMedico($('#medico_id').val())
        else
            createMedico()

        $("#addMedico").modal('hide');
        $("#formMedico")[0].reset()
    });
    $('#addMedico').on('hide.bs.modal', function (event) {
        $('#medico_id').val('')
        $('#especialidades').val('');
        $('#especialidades').trigger("change");
        $('#formMedico')[0].reset()
    });

    function verMedico(id){
        $.ajax({
            url: "http://localhost/admin/users/medico/"+id,
            type: "GET",
            dataType: "json",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(data){
                if(!$('#dados').empty()){
                    $('#dados').empty();
                    corpo = buildTable(data);
                    $('#dados').append(corpo);
                }
                else{
                    corpo = buildTable(data);
                    $('#dados').append(corpo);
                }
                $('#verMedico').modal('show');
            },
            error: function (xhr){
                if(xhr.status == 401){
                    $('#msg').append("<div class='alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                    setTimeout(function(){
                        window.location.href = '/logout';
                    }, 4000);
                }
                $('#msg').append("<div class='alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 4000);
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
                    "<td class='text-right font-weight-bold' style='width: 50%;'>CRM</td>" +
                    "<td class='text-left'>" + e.crm + "</td>" +
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
                    "<td class='text-right font-weight-bold' style='width: 20%;'>Especialidades</td>"+
                    "<td class='text-left'>";
                        for(i = 0; i < e.especialidades.length; i++){

                            tabela += e.especialidades[i].especialidade+"<br>";

                        }
                        tabela += "</td>"+
                "</tr>"+
            "</tbody>";
        return tabela;
    }
</script>

{% endblock %}