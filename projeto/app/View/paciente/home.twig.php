{% extends "templates/pacient.twig.php" %}
{% set page = 'home' %}

{% block title %} SAMED - AREA DO PACIENTE {% endblock %}

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
                                                <span>Solicitar atendimento - Lista de Médicos</span>
                                            </div>
                                            <div class="col-2 col-md-1 col-lg-1">
                                                <i class="fas fa-angle-down" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <table id="medicos" class="display responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="all">Médico</th>
                                                <th class="desktop">CPF</th>
                                                <th class="desktop">CRM</th>
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
                                            <th class="all">Médico</th>
                                            <th class="desktop">CRM</th>
                                            <th class="desktop">Data</th>
                                            <th class="desktop">Inicio</th>
                                            <th class="desktop">Fim</th>
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
                                            <th class="all">Médico</th>
                                            <th class="desktop">CRM</th>
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
                                            <th class="all">Médico</th>
                                            <th class="desktop">CRM</th>
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
{% endblock %}

{% block javascript %}

<script>
    $(document).ready(function(){

        $('#medicos').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: {
                url: 'http://localhost/paciente/atendimento/medicos',
                beforeSend: function (request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                error: function (xhr){
                    console.log(xhr);
                    if(xhr.status == 401){
                        $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                        setTimeout(function(){
                            window.location.href = '/logout';
                        }, 5000);
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
                    "data": "crm",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 3,
                    "width": "50px",
                    "data": "id",
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return '<button title="Solicitar" role="button" class="btn btn-sm btn-success mr-1" onClick="solicitar(' + data + ')">Solicitar</button>'
                    }
                }
            ],
        });

        $('#confirmados').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: {
                url: 'http://localhost/paciente/atendimento/confirmados',
                beforeSend: function (request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                error: function (xhr){
                    if(xhr.status == 401){
                        $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                        setTimeout(function(){
                            window.location.href = '/logout';
                        }, 5000);
                        
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
                    "width": "100px",
                    "data": "medico.nome",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 1,
                    "width": "50px",
                    "data": "medico.crm",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 2,
                    "width": "50px",
                    "data": "data_atendimento",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 3,
                    "width": "50px",
                    "data": "start_at",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 4,
                    "width": "50px",
                    "data": "end_at",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
            ],
        });

        $('#recusados').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: {
                url: 'http://localhost/paciente/atendimento/recusados',
                beforeSend: function (request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                error: function (xhr){
                    if(xhr.status == 401){
                        $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                        setTimeout(function(){
                            window.location.href = '/logout';
                        }, 5000);
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
                    "data": "medico.nome",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 1,
                    "width": "50px",
                    "data": "medico.crm",
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
                url: 'http://localhost/paciente/atendimento/finalizados',
                beforeSend: function (request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                error: function (xhr){
                    if(xhr.status == 401){
                        $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                        setTimeout(function(){
                            window.location.href = '/logout';
                        }, 5000);
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
                    "data": "medico.nome",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 1,
                    "width": "50px",
                    "data": "medico.crm",
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

    function solicitar (id)
    {
        atendimento = {
            medico_id: id,
            user_id: "{{user.id}}",
        };
        $.ajax({
            type: "POST",
            url: "http://localhost/paciente/atendimento/solicitar",
            data: atendimento,
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-success'>"+response+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 5000);
            },
            error: function (xhr){
                if(xhr.status == 401){
                    $('#msg').append("<div class='text-center mx-auto alert alert-fixed alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
                    setTimeout(function(){
                        window.location.href = '/logout';
                    }, 5000);
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