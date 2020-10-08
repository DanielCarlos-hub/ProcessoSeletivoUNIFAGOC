{% extends "templates/admin.twig.php" %}
{% set page = 'users' %}

{% block title %} SAMED - ADMIN DASHBOARD - USUÁRIOS {% endblock %}

{% block body %}
<div class="page-wrapper">
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <div class="card pt-3 pb-3 pr-3 pl-3">
                    <div class="card-header bg-dark">
                        <button class="btn btn-info btn-sm m-1" role="button" onClick="addPaciente()">Adicionar Paciente</button>
                        <button class="btn btn-info btn-sm m-1" role="button" onClick="addMedico()">Adicionar Médico</button>
                        <button class="btn btn-info btn-sm m-1" role="button" onClick="addAdmin()">Adicionar Administrador</button>
                    </div>
                    <div class="card-body pl-0 pr-0">
                        <table id="usuarios" class="display data-table responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="all">Nome de Usuário</th>
                                    <th class="all">Role</th>
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
                                            <label for="admin_nome" class="control-label col-form-label" style="padding-left: 15px;">Nome Completo</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="admin_nome" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-5">
                                            <label for="admin_cpf" class="control-label col-form-label" style="padding-left: 15px;">CPF</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control cpf" id="admin_cpf" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pt-0">
                                        <div class="col-12 col-sm-6 col-lg-5">
                                            <label for="admin_username" class="control-label col-form-label" style="padding-left: 15px;">Usuário</label>
                                            <div class="col-sm-12">
                                                <input id="admin_username" type="text" class="form-control" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-5">
                                            <label for="admin_password" class="control-label col-form-label" style="padding-left: 15px;">Senha</label>
                                            <div class="col-sm-12">
                                                <input id="admin_password" type="password" class="form-control" required autocomplete="off">
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
                                                <input type="text" class="form-control" id="nome_paciente" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-2">
                                            <label for="idade"class="control-label col-form-label" style="padding-left: 15px;">Idade</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" maxlength="3" name="idade" id="idade" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="nome"class="control-label col-form-label" style="padding-left: 15px;">CPF</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control cpf" id="paciente_cpf" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pt-0">
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="username"class="control-label col-form-label" style="padding-left: 15px;">Usuário</label>
                                            <div class="col-sm-12">
                                                <input id="paciente_username" type="text" class="form-control" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="password"class="control-label col-form-label" style="padding-left: 15px;">Senha</label>
                                            <div class="col-sm-12">
                                                <input id="paciente_password" type="password" class="form-control" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <label for="end_rua"class="control-label col-form-label" style="padding-left: 15px;">Endereço</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="end_rua" id="end_rua" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-2">
                                            <label for="end_num"class="control-label col-form-label" style="padding-left: 15px;">Nº</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="end_num" id="end_num" required autofocus autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="end_bairro"class="control-label col-form-label" style="padding-left: 15px;">Bairro</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="end_bairro" id="end_bairro" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-sm-6 col-lg-5">
                                            <label for="end_cidade"class="control-label col-form-label" style="padding-left: 15px;">Cidade</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="end_cidade" id="end_cidade" required autofocus autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-3">
                                            <label for="end_uf"class="control-label col-form-label" style="padding-left: 15px;">UF</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" maxlength="2" name="end_uf" id="end_uf" required autofocus autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="end_cep"class="control-label col-form-label" style="padding-left: 15px;">CEP</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="end_cep" id="end_cep" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <label for="end_complemento"class="control-label col-form-label" style="padding-left: 15px;">Cidade</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="end_complemento" id="end_complemento" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3 col-lg-3">
                                            <label for="telefone"class="control-label col-form-label" style="padding-left: 15px;">Telefone</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control telefone" name="telefone" id="telefone" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-3">
                                            <label for="celular"class="control-label col-form-label" style="padding-left: 15px;">Celular</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control celular" name="celular" id="celular" required autofocus autocomplete="off">
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
                                            <label for="medico_nome" class="control-label col-form-label" style="padding-left: 15px;">Nome Completo</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="medico_nome" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label for="medico_cpf"class="control-label col-form-label" style="padding-left: 15px;">CPF</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control cpf" id="medico_cpf" required autofocus autocomplete="off">
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
                                            <label for="medico_username"class="control-label col-form-label" style="padding-left: 15px;">Usuário</label>
                                            <div class="col-sm-12">
                                                <input id="medico_username" type="text" class="form-control" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-5">
                                            <label for="medico_password"class="control-label col-form-label" style="padding-left: 15px;">Senha</label>
                                            <div class="col-sm-12">
                                                <input id="medico_password" type="password" class="form-control" required autocomplete="off">
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

{% endblock %}

{% block javascript %}

    <script>
        $(document).ready(function(){
            $('.data-table').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                ajax: {
                    url: 'http://localhost/admin/users/index',
                    beforeSend: function (request) {
                        request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                    },
                    error: function (xhr){
                        alert("Error: "+xhr.status+ " - "+xhr.responseText+"\r\n"+"Efetue o login novamente!");
                        window.location.href = '/logout';
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
                        "width": "120px",
                        "data": "usuario",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 1,
                        "width": "70px",
                        "data": "role",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 2,
                        "width": "70px",
                        "data": "id",
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return '<button title="Visualizar" role="button" class="btn btn-sm btn-success mr-1" onClick="verUsuario(' + data + ')"><i class="fas fa-eye"></i></button>'+'<a href="'+'/admin/users/'+data+'/edit"'+'class="btn btn-sm btn-warning mr-1" title="Editar"><i class="fas fa-pencil-alt"></i></a>'+'<button title="Deletar" role="button" class="btn btn-sm btn-danger mr-1" onClick="deletarUsuario(' + data + ')"><i class="fas fa-trash"></i></button>';
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
        function addPaciente(){
            $('#addPaciente').modal('show');
        }
        function addMedico(){
            $('#addMedico').modal('show');
        }
    </script>

{% endblock %}