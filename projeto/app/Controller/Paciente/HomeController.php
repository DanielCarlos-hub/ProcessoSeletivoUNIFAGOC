<?php 

namespace App\Controller\Paciente;
use App\Core\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authenticated();
        if(user()->role != "paciente")
            redirect(user()->role."/home");
    }

    public function showHome()
    {
        $this->load("paciente/home");
    }

    public function cadastro()
    {
        $this->load("paciente/cadastro");
    }

    public function exames()
    {
        $this->load("paciente/exames");
    }
}