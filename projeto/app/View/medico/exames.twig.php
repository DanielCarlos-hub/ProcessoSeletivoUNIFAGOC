{% extends "templates/medic.twig.php" %}
{% set page = 'exames' %}

{% block title %} SAMED - AREA DO MÉDICO {% endblock %}

{% block body %}
<div class="page-wrapper">
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <div id="msg">
                </div>
                <div class="card pt-3 pb-3 pr-3 pl-3">
                    <div class="card-header bg-dark">
                        <button class="btn btn-info btn-sm m-1" role="button" onClick="addExame()">Adicionar Exame</button>
                    </div>
                    <div class="card-body pl-0 pr-0">
                        <table id="exames" class="display data-table responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="all">Paciente</th>
                                    <th class="all">CPF</th>
                                    <th class="desktop">Descrição</th>
                                    <th class="desktop">Data do exame</th>
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
<div class="modal fade right" tabindex="-1" role="dialog" id="exame">
    <div class="modal-dialog modal-xlg">
        <div class="modal-content">
            <form class="form-horizontal" id="formExame" method="post" autocomplete="off">
                <input type="hidden" id="exame_id">
                <div class="modal-header p-1">
                    <h5 class="modal-title" id="title"></h5>
                    <i class="fas fa-window-close close" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body p-0">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-center pt-0">
                                        <div class="col-12 col-sm-8 col-lg-7">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="especialidades" class="control-label col-form-label" style="padding-left: 15px;">Referente a qual atendimento?</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control" id="atendimento" required>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4 col-lg-5">
                                            <label for="nome_paciente" class="control-label col-form-label" style="padding-left: 15px;">Paciente</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="nome_paciente" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pt-1">
                                        <div class="col-12 col-sm-12 col-lg-12">
                                            <label class="control-label col-form-label" style="padding-left: 15px;">Exame</label>
                                        </div>
                                    </div>
                                    <div class="row pt-0">
                                        <div class="col-12 col-sm-6 col-lg-8">
                                            <label for="descricao" class="control-label col-form-label" style="padding-left: 15px;">Descrição</label>
                                            <div class="col-sm-12">
                                                <input id="descricao" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="start_at" class="control-label col-form-label" style="padding-left: 15px;">Data do Exame</label>
                                            <div class="col-sm-12">
                                                <input id="data_exame" type="text" class="form-control date-inputmask" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pt-0">
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <label for="resultado" class="control-label col-form-label" style="padding-left: 15px;">Resultados</label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" id="resultado" rows="5" placeholder="Resultados do Exame" maxlength="500" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <label for="observacao" class="control-label col-form-label" style="padding-left: 15px;">Observações</label>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" id="observacao" rows="5" placeholder="Observações sobre o Exame" maxlength="500" ></textarea>
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

<div class="modal fade right" tabindex="-1" role="dialog" id="verExame">
    <div class="modal-dialog modal-xlg">
        <div class="modal-content">
            <div class="modal-header p-1">
                <h5 class="modal-title">Informações do Exame</h5>
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

    function addExame(){
        $('#title').text('Lançar novo exame');
        $('#exame').modal('show');
    }

    $(document).ready(function(){
        $('#exames').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: {
                url: 'http://localhost/medico/exames/index',
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
                    "width": "100px",
                    "data": "descricao",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    "targets": 3,
                    "width": "50px",
                    "data": "data_exame",
                    "searchable": true,
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return datePTBR(data);
                    }
                },
                {
                    "targets": 4,
                    "width": "50px",
                    "data": "id",
                    "orderable": false,
                    "render": function ( data, type, row, meta ) {
                        return '<button title="Visualizar" role="button" class="btn btn-sm btn-success mr-1" onClick="verExame(' + data + ')"><i class="fas fa-eye"></i></button>'+'<button title="Visualizar" role="button" class="btn btn-sm btn-warning mr-1" onClick="editarExame(' + data + ')"><i class="fas fa-pencil-alt"></i></button>';
                    }
                }
            ],
        });

        $.ajax({
            url: "http://localhost/medico/exames/atendimentos",
            type: "GET",
            dataType: "json",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                if (response.atendimentos.length > 0){
                    var option = '<option value="">Escolher um Atendimento</option>';
                    $.each(response.atendimentos, function(i, obj){
                        option += '<option value="'+obj.id+'">'+datePTBR(obj.data_atendimento)+' - '+obj.start_at+'-'+obj.end_at+' - '+obj.paciente+'</option>';
                    });
                    $('#atendimento').html(option).show();
                }
                else{
                    $('#atendimento').empty().append('<option value="">Nenhum atendimento encontrado</option>');
                }
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
                }, 5000);
            }
        });
    })

    $('#atendimento').on("change", function(){
        $.ajax({
            url: "http://localhost/medico/exames/atendimentos",
            type: "GET",
            dataType: "json",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                for(i = 0; i < response.atendimentos.length; i++){
                    
                    if(response.atendimentos[i].id == $('#atendimento').val()){
                        $('#nome_paciente').val(response.atendimentos[i].paciente);
                        break;
                    }
                }
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
                }, 5000);
            }
        });
    })

    function createExame(){
        exame = {
            atendimento_id: $('#atendimento').val(),
            descricao: $('#descricao').val(),
            data_exame: $('#data_exame').val(),
            resultado: $('#resultado').val(),
            observacao: $('#observacao').val(),
        };

        $.ajax({
            url: "http://localhost/medico/exames/salvar",
            data: exame,
            type: "POST",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                $("#exame").modal('hide');
                $('#exames').DataTable().ajax.reload();
                $('#msg').append("<div class='alert alert-fixed alert-info'>"+response+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 5000);
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
                }, 5000);
            }
        });
    }

    function editarExame(id){

        $.ajax({
            url: "http://localhost/medico/exames/exame/"+id,
            type: "GET",
            dataType: "json",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(data){
                $('#exame_id').val(data.id);
                $('#atendimento').val(data.atendimento_id).trigger('change');
                $('#descricao').val(data.descricao);
                $('#data_exame').val(datePTBR(data.data_exame));
                $('#resultado').val(data.resultado);
                $('#observacao').val(data.observacao);
                $('#title').text('Editar exame');
                $('#exame').modal('show');
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
                }, 5000);
            }
        });

    }
    function updateExame() {
        exame = {
            exame_id: $('#exame_id').val(),
            atendimento_id: $('#atendimento').val(),
            descricao: $('#descricao').val(),
            data_exame: $('#data_exame').val(),
            resultado: $('#resultado').val(),
            observacao: $('#observacao').val()
        };
        $.ajax({
            url: "http://localhost/medico/exames/update",
            data: exame,
            type: "PUT",
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(response){
                $("#exame").modal('hide');
                $('#exames').DataTable().ajax.reload();
                $('#msg').append("<div class='alert alert-fixed alert-info'>"+response+"</div>");
                setTimeout(function(){
                    $(".alert").alert('close');
                }, 5000);
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
                }, 5000);
                $("#exame").modal('hide');
            }
        });
    }

    $("#formExame").submit( function(event){
        event.preventDefault();
        if($('#exame_id').val() != '')
            updateExame($('#exame_id').val())
        else
            createExame()

        $("#exame").modal('hide');
        $("#formExame")[0].reset()
    });
    $('#exame').on('hide.bs.modal', function (event) {
        $('#exame_id').val('')
        $('#formExame')[0].reset()
    });

    function verExame(id){
        $.ajax({
            url: "http://localhost/medico/exames/exame/"+id,
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
                $('#verExame').modal('show');
                
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
                }, 5000);
            }
        });
    }

    function buildTable(e) {
        var tabela =
            "<thead>"+
                "<th colspan='2' class='text-center'>" + e.paciente.nome+ "</th>"+
            "</thead>"+
            "<tbody>"+
            "<tr>" +
                    "<td class='text-right font-weight-bold' style='width: 30%;'>CPF do Paciente</td>" +
                    "<td class='text-left'>" + e.paciente.cpf + "</td>" +
                "</tr>"+
                "<tr>" +
                    "<td class='text-right font-weight-bold' style='width: 30%;'>Descrição</td>" +
                    "<td class='text-left'>" + e.descricao + "</td>" +
                "</tr>"+
                "<tr>" +
                    "<td class='text-right font-weight-bold' style='width: 30%;'>Data do Exame</td>" +
                    "<td class='text-left'>" + datePTBR(e.data_exame) + "</td>" +
                "</tr>"+
                "<tr>" +
                    "<td class='text-right font-weight-bold' style='width: 30%;'>Resultados</td>" +
                    "<td class='text-left'>" + e.resultado + "</td>" +
                "</tr>"+
                "<tr>" +
                    "<td class='text-right font-weight-bold' style='width: 30%;'>Observações</td>" +
                    "<td class='text-left'>" + e.observacao + "</td>" +
                "</tr>"+
            "</tbody>";
        return tabela;
    }

</script>
{% endblock %}
