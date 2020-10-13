<?php

namespace App\Controller\Admin;

use App\Core\Controller;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authenticated();
        if(user()->role != "admin")
            redirect(user()->role."/home");   
    }

    public function validarCPF()
    {
        $cpf = new \Bissolli\ValidadorCpfCnpj\CPF($this->request->get('cpf'));
        
        if(!$cpf->isValid()){
            $this->response->setContent('CPF Inválido');
            $this->response->setStatusCode(200);
            $this->response->send();
        }
    }

}