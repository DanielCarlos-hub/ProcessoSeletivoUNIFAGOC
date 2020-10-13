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
            $this->response->setContent('Informe seu email e senha para entrar');
            $this->response->setStatusCode(400);
            $this->response->send();
        }

        $auth = new Auth();
        $login = $auth->login($this->request->get('username'), $this->request->get('password'));

        
        if ($login) {
            
            $this->response->setContent($auth->jwt_encode());
            $this->response->setStatusCode(200);
            $this->response->send();

        } else {
            $this->response->setContent('Não foi possível autenticar, usuário e senha não conferem');
            $this->response->setStatusCode(400);
            $this->response->send();
        }

    }

    public function logout()
    {
        Auth::logout();
        redirect("/");
    }
}