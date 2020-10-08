{% extends "templates/admin.twig.php" %}
{% set page = 'users' %}

{% block title %} SAMED - ADMIN DASHBOARD - LISTA DE ADMINISTRADORES {% endblock %}

{% block body %}
<div class="page-wrapper">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
        <li class="breadcrumb-item"><a href="/admin/users/menu">Usuários</a></li>
        <li class="breadcrumb-item active">Administradores</li>
    </ol>
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <div class="card pt-3 pb-3 pr-3 pl-3">
                    <div class="card-header bg-dark">
                        <button class="btn btn-info btn-sm m-1" role="button" onClick="addAdmin()">Adicionar Administrador</button>
                    </div>
                    <div class="card-body pl-0 pr-0">
                        <table id="administradores" class="display data-table responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="all">Nome Completo</th>
                                    <th class="all">CPF</th>
                                    <th class="desktop">Nome de Usuário</th>
                                    <th class="desktop">Data de Cadastro</th>
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

<!-- Modal de Cadastro de Usuarios -->
<div class="modal fade right" tabindex="-1" role="dialog" id="addAdmin">
    <div class="modal-dialog modal-xlg">
        <div class="modal-content">
            <form class="form-horizontal" id="formAdmin" method="post" autocomplete="off">
                <input type="hidden" id="admin_id">
                <div class="modal-header p-1">
                    <h5 class="modal-title">Cadastrar novo Administrador</h5>
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
                                        <div class="col-12 col-sm-6 col-lg-5">
                                            <label for="cpf" class="control-label col-form-label" style="padding-left: 15px;">CPF</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control cpf" id="cpf" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pt-0">
                                        <div class="col-12 col-sm-6 col-lg-5">
                                            <label for="username" class="control-label col-form-label" style="padding-left: 15px;">Usuário</label>
                                            <div class="col-sm-12">
                                                <input id="username" type="text" class="form-control" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-5">
                                            <label for="password" class="control-label col-form-label" style="padding-left: 15px;">Senha</label>
                                            <div class="col-sm-12">
                                                <input id="password" type="password" class="form-control" required autocomplete="off">
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


<div class="modal fade right" tabindex="-1" role="dialog" id="verAdmin">
    <div class="modal-dialog modal-xlg">
        <div class="modal-content">
            <div class="modal-header p-1">
                <h5 class="modal-title">Dados do Administrador</h5>
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
                url: 'http://localhost/admin/users/administradores/index',
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
                    "data": "username",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 3,
                    "width": "50px",
                    "data": "agente.created_at",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 4,
                    "width": "50px",
                    "data": "id",
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return '<button title="Visualizar" role="button" class="btn btn-sm btn-success mr-1" onClick="verAdmin(' + data + ')"><i class="fas fa-eye"></i></button>'+'<button title="Visualizar" role="button" class="btn btn-sm btn-warning mr-1" onClick="editarAdmin(' + data + ')"><i class="fas fa-pencil-alt"></i></button>'+'<button title="Deletar" role="button" class="btn btn-sm btn-danger mr-1" onClick="deletarAdmin(' + data + ')"><i class="fas fa-trash"></i></button>';
                    }
                }
            ],
        });
    });
    
    
    $('#cpf').on("blur", function(){
        validarCPF(this.value);
    })

    function addAdmin(){
        $('#addAdmin').modal('show');
    }

    function createAdmin() {
        admin = {
            nome: $('#nome').val(),
            cpf: $('#cpf').val(),
            username: $('#username').val(),
            password: $('#password').val(),
            role: "admin"
        };
        $.ajax({
            type: "POST",
            url: "http://localhost/admin/users/administradores/store",
            data: admin,

            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },

            success: function(response){
                $("#addAdmin").modal('hide')
                $('#administradores').DataTable().ajax.reload()
            },
            error: function (xhr){
                if(xhr.status == 401){
                    alert("Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!");
                    window.location.href = '/logout';
                }
                $("#addAdmin").modal('hide');
                alert("Error: "+xhr.responseText);
            } 
        });
    }
    function editarAdmin(id){

        $.ajax({
            url: "http://localhost/admin/users/administrador/"+id,
            type: "GET",
            dataType: "json",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(data){
                $('#admin_id').val(data.id);
                $('#nome').val(data.agente.nome);
                $('#cpf').val(data.agente.cpf);
                $('#username').val(data.username);
                $('#password').prop('required', false);
                $('#addAdmin').modal('show');
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
    function updateAdmin() {
        admin = {
            admin_id: $('#admin_id').val(),
            nome: $('#nome').val(),
            cpf: $('#cpf').val(),
            username: $('#username').val(),
            password: $('#password').val()
        };
        $.ajax({
            url: "http://localhost/admin/users/administradores/update",
            data: admin,
            type: "PUT",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                $("#addAdmin").modal('hide');
                $('#administradores').DataTable().ajax.reload();
            },
            error: function (xhr){
                if(xhr.status == 401){
                    alert("Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!");
                    window.location.href = '/logout';
                }
                $("#addAdmin").modal('hide');
                alert("Error: "+xhr.responseText);
            }
        });
    }
    $("#formAdmin").submit( function(event){
        event.preventDefault();
        if($('#admin_id').val() != '')
            updateAdmin($('#admin_id').val())
        else
            createAdmin()

        $("#addAdmin").modal('hide');
        $("#formAdmin")[0].reset()
    });
    $('#addAdmin').on('hide.bs.modal', function (event) {
        $('#admin_id').val('')
        $('#formAdmin')[0].reset()
    });

    function verAdmin(id){
        console.log(id);
        $.ajax({
            url: "http://localhost/admin/users/administrador/"+id,
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
                $('#verAdmin').modal('show');
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
                    "<td class='text-right font-weight-bold' style='width: 50%;'>CPF</td>" +
                    "<td class='text-left'>" + e.agente.cpf + "</td>" +
                "</tr>"+
                "<tr>" +
                    "<td class='text-right font-weight-bold' style='width: 50%;'>Nome de Usuário</td>" +
                    "<td class='text-left'>" + e.username + "</td>" +
                "</tr>"+
                "<tr>" +
                    "<td class='text-right font-weight-bold' style='width: 50%;'>Data de Cadastro</td>" +
                    "<td class='text-left'>" + datetimePTBR(e.agente.created_at) + "</td>" +
                "</tr>"+
            "</tbody>";
        return tabela;
    }
</script>

{% endblock %}