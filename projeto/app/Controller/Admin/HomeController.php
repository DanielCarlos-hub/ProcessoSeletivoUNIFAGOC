<?php 

namespace App\Controller\Admin;

use App\Core\Controller;
use App\Model\Medico;
use App\Model\Paciente;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->authenticated();
        if(user()->role != "admin")
            redirect(user()->role."/home");
    }

    public function showHome()
    {   
        $this->load('admin/home');
    }

    public function usersMenu()
    {
        $this->load('admin/users/menu');
    }
}