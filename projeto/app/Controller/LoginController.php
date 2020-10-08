<?php 

namespace App\Controller;
use App\Core\Controller;
use App\Model\Auth;


class LoginController extends Controller
{

    public function showLogin()
    {
        if(Auth::user()){
            redirect(Auth::user()->role."/home");
        }
        $this->load('auth/login');
    }

    public function login()
    {
        
        if (empty($this->request->get('username')) || empty($this->request->get('password'))) {
            echo json_encode(['message' => 'Informe seu email e senha para entrar']);
            exit;
        }

        $auth = new Auth();
        $login = $auth->login($this->request->get('username'), $this->request->get('password'));

        if ($login) {

            echo $auth->jwt_encode();
            
        } else {
            echo json_encode(['message' => 'Não foi possível autenticar, usuário e senha não conferem']);
        }

    }

    public function logout()
    {
        Auth::logout();
        redirect("/");
    }
}