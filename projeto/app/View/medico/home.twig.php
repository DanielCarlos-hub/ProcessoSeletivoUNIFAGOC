{% extends "templates/medic.twig.php" %}
{% set page = 'home' %}

{% block title %} SAMED - AREA DO MÉDICO {% endblock %}

{% block body %}
<div class="page-wrapper">
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <div id="msg">
                </div>
                <div class="card border-info pt-3 pb-3 pr-3 pl-3">
                    <div class="card-header text-white text-center mb-2 bg-primary">
                        <h4>Atendimentos</h4>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="card m-b-0 p-3">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="row">
                                            <div class="col-10 col-md-11 col-lg-11">
                                                <span>Atendimentos aguardando resposta</span>
                                            </div>
                                            <div class="col-2 col-md-1 col-lg-1">
                                                <i class="fas fa-angle-down" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show " aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <table id="espera" class="display responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="all">Paciente</th>
                                                <th class="desktop">CPF</th>
                                                <th class="desktop">Data</th>
                                                <th class="desktop"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card m-b-0 p-3">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <div class="row">
                                            <div class="col-10 col-md-11 col-lg-11">
                                                <span>Atendimentos confirmados</span>
                                            </div>
                                            <div class="col-2 col-md-1 col-lg-1">
                                                <i class="fas fa-angle-down" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse show p-3" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <table id="confirmados" class="display responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="all">Paciente</th>
                                            <th class="desktop">CPF</th>
                                            <th class="desktop">Data</th>
                                            <th class="desktop">Inicio</th>
                                            <th class="desktop">Fim</th>
                                            <th class="desktop"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card m-b-0 p-3">
                            <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div class="row">
                                        <div class="col-10 col-md-11 col-lg-11">
                                            <span>Atendimentos recusados</span>
                                        </div>
                                        <div class="col-2 col-md-1 col-lg-1">
                                            <i class="fas fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </a>
                            </h5>
                            </div>
                            <div id="collapseThree" class="collapse show p-3" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <table id="recusados" class="display responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="all">Paciente</th>
                                            <th class="desktop">CPF</th>
                                            <th class="desktop">Data</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card m-b-0 p-3">
                            <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <div class="row">
                                        <div class="col-10 col-md-11 col-lg-11">
                                            <span>Atendimentos finalizados</span>
                                        </div>
                                        <div class="col-2 col-md-1 col-lg-1">
                                            <i class="fas fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </a>
                            </h5>
                            </div>
                            <div id="collapseFour" class="collapse show p-3" aria-labelledby="headingFour" data-parent="#accordionExample">
                                <table id="finalizados" class="display responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="all">Paciente</th>
                                            <th class="desktop">CPF</th>
                                            <th class="desktop">Data</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal de Cadastro de Usuarios -->
<div class="modal fade right" tabindex="-1" role="dialog" id="confirmar">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="formConfirmar" method="post" autocomplete="off">
                <input type="hidden" id="atendimento_id">
                <div class="modal-header p-1">
                    <h5 class="modal-title">Confirmar atendimento</h5>
                    <i class="fas fa-window-close close" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body p-0">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-center pb-0">
                                        <div class="col-12 col-sm-12 col-lg-12">
                                            <label for="nome_paciente" class="control-label col-form-label" style="padding-left: 15px;">Nome Completo</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="nome_paciente" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pb-0">
                                        <div class="col-12 col-sm-12 col-lg-12">
                                            <label for="cpf_paciente" class="control-label col-form-label" style="padding-left: 15px;">CPF</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control cpf" id="cpf_paciente" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pt-3">
                                        <div class="col-12 col-sm-12 col-lg-12">
                                            <label for="start_at" class="control-label col-form-label" style="padding-left: 15px;">Data/Horário do Atendimento</label>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pb-0">
                                        <div class="col-12 col-sm-12 col-lg-12">
                                            <label for="cpf_paciente" class="control-label col-form-label" style="padding-left: 15px;">Data</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control date-inputmask" id="data_atendimento" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pt-0">
                                        <div class="col-12 col-sm-12 col-lg-12">
                                            <label for="start_at" class="control-label col-form-label" style="padding-left: 15px;">Inicio</label>
                                            <div class="col-sm-12">
                                                <input id="start_at" type="time" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pt-0">
                                        <div class="col-12 col-sm-12 col-lg-12">
                                            <label for="end_at" class="control-label col-form-label" style="padding-left: 15px;">Fim</label>
                                            <div class="col-sm-12">
                                                <input id="end_at" type="time" class="form-control" required >
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

{% endblock %}

{% block javascript %}

<script>
    $(document).ready(function(){
        $('#espera').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: {
                url: 'http://localhost/medico/atendimentos/espera',
                beforeSend: function (request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                error: function (xhr){
                    if(xhr.status == 401){
                        $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                        setTimeout(function(){
                            window.location.href = '/logout';
                        }, 4000);
                    }
                    $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                    setTimeout(function(){
                        $(".alert").alert('close');
                    }, 4000);
                    
                } 
            },
            "bLengthChange": false,
            "bInfo" : false,
            "bPaginate": false,
            "dom":"lrtip",
            "pageLength": 10,
            "ordering": false,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                $(nRow).addClass('table-info');
            },
            "columnDefs": [
                {
                    "targets": 0,
                    "width": "100px",
                    "data": "paciente.nome",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 1,
                    "width": "50px",
                    "data": "paciente.cpf",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 2,
                    "width": "50px",
                    "data": "created_at",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return datetimePTBR(data);
                    }
                },
                {
                    "targets": 3,
                    "width": "50px",
                    "data": "id",
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return '<button title="Confirmar" role="button" class="btn btn-sm btn-success mr-1" onClick="confirmar(' + data + ')"><i class="fas fa-check"></i></button>'+'<button title="Recusar" role="button" class="btn btn-sm btn-danger mr-1" onClick="recusar(' + data + ')"><i class="fas fa-times"></i></button>';
                    }
                }
            ],
        });

        $('#confirmados').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: {
                url: 'http://localhost/medico/atendimentos/confirmados',
                beforeSend: function (request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                error: function (xhr){
                    if(xhr.status == 401){
                        $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                        setTimeout(function(){
                            window.location.href = '/logout';
                        }, 4000);
                    }
                    $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                    setTimeout(function(){
                        $(".alert").alert('close');
                    }, 4000);
                    
                } 
            },
            "bLengthChange": false,
            "bInfo" : false,
            "bPaginate": false,
            "dom":"lrtip",
            "pageLength": 10,
            "ordering": false,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                $(nRow).addClass('table-success');
            },
            "columnDefs": [
                {
                    "targets": 0,
                    "width": "150px",
                    "data": "paciente.nome",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 1,
                    "width": "60px",
                    "data": "paciente.cpf",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 2,
                    "width": "60px",
                    "data": "data_atendimento",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return datePTBR(data);
                    }
                },
                {
                    "targets": 3,
                    "width": "60px",
                    "data": "start_at",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 4,
                    "width": "60px",
                    "data": "end_at",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 5,
                    "width": "150px",
                    "data": "id",
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return '<button title="Finalizar" role="button" class="btn btn-sm btn-warning mr-1" onClick="finalizar(' + data + ')"><i class="fas fa-hourglass-end"></i></button>'+'<button title="Remarcar" role="button" class="btn btn-sm btn-info mr-1" onClick="confirmar(' + data + ')"><i class="fas fa-history"></i></button>'+'<button title="Cancelar" role="button" class="btn btn-sm btn-danger mr-1" onClick="recusar(' + data + ')"><i class="fas fa-times"></i></button>';
                    }
                }
            ],
        });

        $('#recusados').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: {
                url: 'http://localhost/medico/atendimentos/recusados',
                beforeSend: function (request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                error: function (xhr){
                    if(xhr.status == 401){
                        $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                        setTimeout(function(){
                            window.location.href = '/logout';
                        }, 4000);
                    }
                    $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                    setTimeout(function(){
                        $(".alert").alert('close');
                    }, 4000);
                    
                } 
            },
            "bLengthChange": false,
            "bInfo" : false,
            "bPaginate": false,
            "dom":"lrtip",
            "pageLength": 10,
            "ordering": false,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                $(nRow).addClass('table-warning');
            },
            "columnDefs": [
                {
                    "targets": 0,
                    "width": "100px",
                    "data": "paciente.nome",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 1,
                    "width": "50px",
                    "data": "paciente.cpf",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 2,
                    "width": "50px",
                    "data": "updated_at",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return datetimePTBR(data);
                    }
                },
            ],
        });

        $('#finalizados').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: {
                url: 'http://localhost/medico/atendimentos/finalizados',
                beforeSend: function (request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                error: function (xhr){
                    if(xhr.status == 401){
                        $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                        setTimeout(function(){
                            window.location.href = '/logout';
                        }, 4000);
                    }
                    $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                    setTimeout(function(){
                        $(".alert").alert('close');
                    }, 4000);
                    
                } 
            },
            "bLengthChange": false,
            "bInfo" : false,
            "bPaginate": false,
            "dom":"lrtip",
            "pageLength": 10,
            "ordering": false,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                $(nRow).addClass('table-primary');
            },
            "columnDefs": [
                {
                    "targets": 0,
                    "width": "100px",
                    "data": "paciente.nome",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 1,
                    "width": "50px",
                    "data": "paciente.cpf",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 2,
                    "width": "50px",
                    "data": "updated_at",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return datetimePTBR(data);
                    }
                },
            ],
        });
    });

    function confirmar(id)
    {
        $.ajax({
            url: "http://localhost/medico/atendimento/"+id,
            type: "GET",
            dataType: "json",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(data){
                $('#atendimento_id').val(data.id);
                $('#nome_paciente').val(data.paciente.nome);
                $('#cpf_paciente').val(data.paciente.cpf);
                $('#confirmar').modal('show');
            },
            error: function (xhr){
                if(xhr.status == 401){
                    $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                    setTimeout(function(){
                        window.location.href = '/logout';
                    }, 4000);
                }
                $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 4000);
            }
        });

        $("#formConfirmar").submit( function(event){
            event.preventDefault();
            atendimento = {
                atendimento_id: $('#atendimento_id').val(),
                nome: $('#nome_paciente').val(),
                cpf: $('#cpf_paciente').val(),
                data_atendimento: $('#data_atendimento').val(),
                start_at: $('#start_at').val(),
                end_at: $('#end_at').val()
            };

            $.ajax({
                url: "http://localhost/medico/atendimento/confirmar",
                data: atendimento,
                type: "PUT",
                beforeSend: function (request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                success: function(response){
                    $("#confirmar").modal('hide');
                    $('#espera').DataTable().ajax.reload();
                    $('#confirmados').DataTable().ajax.reload();
                    $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-fixed alert-info'>"+response+"</div>");
                    setTimeout(function(){
                        $(".alert").alert('close');
                    }, 5000);
                },
                error: function (xhr){
                    if(xhr.status == 401){
                        $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                        setTimeout(function(){
                            window.location.href = '/logout';
                        }, 4000);
                    }
                    $("#espera").modal('hide');

                    $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                    setTimeout(function(){
                        $(".alert").alert('close');
                    }, 4000);
                }
            });

            $("#espera").modal('hide');
            $("#formConfirmar")[0].reset()
        });
        $('#espera').on('hide.bs.modal', function (event) {
            $('#atendimento_id').val('')
            $('#formConfirmar')[0].reset()
        });
    }

    function recusar(id)
    {
        atendimento = {
            atendimento_id: id,
        };

        $.ajax({
            url: "http://localhost/medico/atendimento/recusar",
            data: atendimento,
            type: "PUT",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                
                $('#espera').DataTable().ajax.reload();
                $('#confirmados').DataTable().ajax.reload();
                $('#recusados').DataTable().ajax.reload();
                $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-info'>"+response+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 5000);
            },
            error: function (xhr){
                if(xhr.status == 401){
                    $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                    setTimeout(function(){
                        window.location.href = '/logout';
                    }, 4000);
                }
                $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 4000);
            }
        });
    }

    function finalizar(id)
    {
        atendimento = {
            atendimento_id: id,
        };

        $.ajax({
            url: "http://localhost/medico/atendimento/finalizar",
            data: atendimento,
            type: "PUT",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                $('#confirmados').DataTable().ajax.reload();
                $('#finalizados').DataTable().ajax.reload();
                $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-info'>"+response+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 5000);
            },
            error: function (xhr){
                if(xhr.status == 401){
                    $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                    setTimeout(function(){
                        window.location.href = '/logout';
                    }, 4000);
                }
                $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 4000);
            }
        });
    }
</script>

{% endblock %}