{% extends "templates/pacient.twig.php" %}
{% set page = 'exames' %}

{% block title %} SAMED - AREA DO PACIENTE {% endblock %}

{% block body %}
<div class="page-wrapper">
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <div id="msg">
                </div>
                <div class="card pt-3 pb-3 pr-3 pl-3">
                    <div class="card-header text-white text-center mb-2 bg-primary">
                        <h4>Resultados dos exames</h4>
                    </div>
                    <div class="card-body pl-0 pr-0">
                        <table id="exames" class="display data-table responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="all">Medico</th>
                                    <th class="all">CRM</th>
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

    $(document).ready(function(){
        $('#exames').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: {
                url: 'http://localhost/paciente/exames/index',
                beforeSend: function (request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                error: function (xhr){
                    if(xhr.status == 401){
                        $('#msg').append("<div class='text-center mx-auto alert alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
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
                        return '<button title="Visualizar" role="button" class="btn btn-sm btn-success mr-1" onClick="verExame(' + data + ')"><i class="fas fa-eye"></i></button>';
                    }
                }
            ],
        });
    });

    function verExame(id){
        $.ajax({
            url: "http://localhost/paciente/exames/exame/"+id,
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
                    $('#msg').append("<div class='text-center mx-auto alert alert-danger'>Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!</div>");
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

    function buildTable(e) {
        var tabela =
            "<thead>"+
                "<th colspan='2' class='text-center'> Nome do Médico: " + e.medico.nome+ "</th>"+
            "</thead>"+
            "<tbody>"+
            "<tr>" +
                    "<td class='text-right font-weight-bold' style='width: 30%;'>CRM do Médico</td>" +
                    "<td class='text-left'>" + e.medico.crm + "</td>" +
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
