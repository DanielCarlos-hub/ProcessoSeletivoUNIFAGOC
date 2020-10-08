{% extends "templates/admin.twig.php" %}
{% set page = 'users' %}

{% block title %} SAMED - ADMIN DASHBOARD - USUÁRIOS {% endblock %}

{% block body %}
<div class="page-wrapper">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
        <li class="breadcrumb-item active">Usuários</li>
    </ol>
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-body" style="padding: 1rem;">
                        <div class="row">
                            <div class="col-6 col-xs-6 col-sm-4 col-md-3">
                                <div class="text-center">
                                    <a class="nav-link waves-effect waves-dark pro-pic" href="pacientes" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ASSET}}/images/icons/admin/patient.png" alt="Pacientes" width="64" style="padding-bottom: 15px;">
                                    <h6>Pacientes</h6></a>
                                </div>
                            </div>
                            <div class="col-6 col-xs-6 col-sm-4 col-md-3">
                                <div class="text-center">
                                    <a class="nav-link waves-effect waves-dark pro-pic" href="medicos" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ASSET}}/images/icons/admin/doctor.png" class="rounded-circle" alt="Médicos" width="64" style="padding-bottom: 15px;">
                                    <h6>Médicos</h6></a>
                                </div>
                            </div>

                            <div class="col-6 col-xs-6 col-sm-4 col-md-3">
                                <div class="text-center">
                                    <a class="nav-link waves-effect waves-dark pro-pic" href="administradores" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ASSET}}/images/icons/admin/admin.png" class="rounded-circle" alt="Administradores" width="64" style="padding-bottom: 15px;">
                                    <h6>Administradores</h6></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



{% endblock %}
