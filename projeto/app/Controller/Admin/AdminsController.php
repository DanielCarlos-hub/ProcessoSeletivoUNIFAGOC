<?php

namespace App\Controller\Admin;

use App\Core\Connection;
use App\Core\Controller;

use App\Model\Agente;
use App\Model\User;

class AdminsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authenticated();
        if(user()->role != "admin")
            redirect(user()->role."/home");
        
    }

    public function index()
    {
       $this->load('admin/users/admins');
    }

    public function showAdmins()
    {

        $token = $this->tokenVerify();
        if($token['http'] == 200){

            $admins = [];
            $users = (new User())->find("role = :role", "role=admin")->fetch(true);
            if($users){
                foreach($users as $user){
                    $admins[] = [
                        'id' => $user->id,
                        'username' => $user->username,
                        'agente' => [
                            'id' => $user->agente()->id,
                            'nome' => $user->agente()->nome,
                            'cpf' => $user->agente()->cpf,
                            'created_at' => $user->agente()->created_at,
                        ]
                    ];
                }
            }
            $this->response->setContent(json_encode(['data' => $admins]));
            $this->response->setStatusCode(200);
            $this->response->send();
        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }

    }

    public function getAdmin($id)
    {

        $id = array_shift($id);
        $token = $this->tokenVerify();

        if($token['http'] == 200){
            $user = (new User())->findById($id);
            $admin = [
                'id' => $user->id,
                'username' => $user->username,
                'agente' => [
                    'id' => $user->agente()->id,
                    'nome' => $user->agente()->nome,
                    'cpf' => $user->agente()->cpf,
                    'created_at' => $user->agente()->created_at,
                ]
            ];
            $this->response->setContent(json_encode($admin));
            $this->response->setStatusCode(200);
            $this->response->send();
            
        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }

    }

    public function createAdmin()
    {

        $token = $this->tokenVerify();
        
        if($token['http'] == 200){
        
            Connection::beginTransaction();

            $agente = new Agente();
            $agente->bootstrap(  //bootstrap para vincular os dados ao objeto.
                $this->request->get("cpf"),
                $this->request->get("nome"),
            );
            if(!$agente->save()){ //metodo save para salvar os dados do objeto no banco de dados
                Connection::rollback();
                $this->response->setContent($agente->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            } 
            
            $user = new User();
            $user->bootstrap(
                $agente->id,
                $this->request->get('username'),
                hash_password($this->request->get('password')),
                $this->request->get('role')
            );
            if(!$user->save()){
                Connection::rollback();
                $this->response->setContent($user->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            };
            
            Connection::commit();
            $this->response->setContent('Administrador cadastrado com sucesso');
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function updateAdmin()
    {
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){
            
            $user = (new User())->findById($this->request->get('admin_id'));
            $agente = (new Agente())->findById($user->agente_id);

            if(!isset($user)){
                $this->response->setContent('Administrador não encontrado');
                $this->response->setStatusCode(404);
                $this->response->send();
            }
            
            Connection::beginTransaction();

            $agente->cpf = $this->request->get('cpf');
            $agente->nome = $this->request->get('nome');
            
            if(!$agente->save()){ //metodo save para salvar os dados do objeto no banco de dados
                Connection::rollback();
                $this->response->setContent($agente->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            } 
            
            $user->username = $this->request->get('username');
            if($this->request->get('password') != '')
                $user->password = hash_password($this->request->get('password'));

            if(!$user->save()){
                Connection::rollback();
                $this->response->setContent($user->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            };

            
            Connection::commit();
            $this->response->setContent('Administrador atualizado com sucesso');
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

}