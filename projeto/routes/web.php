<?php

use CoffeeCode\Router\Router;

use App\Core\Session;

$session = new Session();

$web = new Router(BASE, ":");

$web->namespace("App\Controller");
$web->get("/", "LoginController:showLogin");
$web->post("/login", "LoginController:login");
$web->get("/logout", "LoginController:logout");

$web->group("admin")->namespace("App\Controller\Admin");
$web->get("/home", "HomeController:showHome");
$web->get("/users/menu", "HomeController:usersMenu");
$web->get('/users/cpf/validar', "UsersController:validarCPF");

$web->get("/users/pacientes", "PacientesController:index");
$web->get("/users/pacientes/index", "PacientesController:showPacientes");
$web->get("/users/paciente/{id}", "PacientesController:getPaciente");
$web->post("/users/pacientes/store", "PacientesController:createPaciente");
$web->put("/users/pacientes/update", "PacientesController:updatePaciente");

$web->get("/users/medicos", "MedicosController:index");
$web->get("/users/medicos/index", "MedicosController:showMedicos");
$web->get("/users/medico/{id}", "MedicosController:getMedico");
$web->post("/users/medicos/store", "MedicosController:createMedico");
$web->put("/users/medicos/update", "MedicosController:updateMedico");

$web->get("/users/administradores", "AdminsController:index");
$web->get("/users/administradores/index", "AdminsController:showAdmins");
$web->get("/users/administrador/{id}", "AdminsController:getAdmin");
$web->post("/users/administradores/store", "AdminsController:createAdmin");
$web->put("/users/administradores/update", "AdminsController:updateAdmin");

$web->group("paciente")->namespace("App\Controller\Paciente");
$web->get("/home", "HomeController:showHome");
$web->get("/cadastro", "HomeController:cadastro");
$web->get("/exames", "HomeController:exames");
$web->get("/user/dados", "CadastroController:dados");
$web->get("/user/anonimizar", "CadastroController:anonimizar");
$web->put("/user/anonimizar", "CadastroController:anonimizacao");
$web->get("/atendimento/medicos", 'AtendimentoController:medicos');
$web->post("/atendimento/solicitar", "AtendimentoController:solicitar");
$web->get("/atendimento/confirmados", "AtendimentoController:confirmados");
$web->get("/atendimento/recusados", "AtendimentoController:recusados");
$web->get("/atendimento/finalizados", 'AtendimentoController:finalizados');
$web->get("/exames/index", "ExamesController:index");
$web->get("/exames/exame/{id}", "ExamesController:getExame");

$web->group("medico")->namespace("App\Controller\Medico");
$web->get("/home", "HomeController:showHome");
$web->get("/exames", "HomeController:exames");
$web->get("/atendimentos/espera", 'AtendimentoController:espera');
$web->get("/atendimentos/confirmados", 'AtendimentoController:confirmados');
$web->get("/atendimentos/recusados", 'AtendimentoController:recusados');
$web->get("/atendimentos/finalizados", 'AtendimentoController:finalizados');
$web->get("/atendimento/{id}", 'AtendimentoController:getAtendimento');
$web->put("/atendimento/confirmar", 'AtendimentoController:confirmar');
$web->put("/atendimento/recusar", 'AtendimentoController:recusar');
$web->put("/atendimento/finalizar", 'AtendimentoController:finalizar');
$web->get("/exames/index", "ExamesController:index");
$web->get("/exames/exame/{id}", "ExamesController:getExame");
$web->get("/exames/atendimentos", "ExamesController:atendimentos");
$web->post("/exames/salvar", "ExamesController:salvar");
$web->put("/exames/update", "ExamesController:update");

$web->dispatch();
