<?php 

namespace App\Controller\Medico;
use App\Core\Controller;
use App\Model\Atendimento;
use App\Model\User;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authenticated();
        if(user()->role != "medico")
            redirect(user()->role."/home");
    }

    public function showHome()
    {
        $this->load("medico/home");
    }

    public function exames()
    {
        $this->load("medico/exames");
    }
}