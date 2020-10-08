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
$web->post("/home", "HomeController:solicitar");

$web->dispatch();
