<?php

namespace App\Controller\Admin;

use App\Core\Connection;
use App\Core\Controller;

use App\Model\Agente;
use App\Model\Paciente;
use App\Model\User;

class PacientesController extends Controller
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
        $this->load('admin/users/pacientes');
    }


    public function showPacientes()
    {

        $token = $this->tokenVerify();
        if($token['http'] == 200){
            $pacientes = [];
            $users = (new Paciente())->find()->fetch(true);
            foreach($users as $user){
                $pacientes[] = [
                    'id' => $user->id,
                    'telefone' => $user->telefone,
                    'agente' => [
                        'id' => $user->agente()->id,
                        'nome' => $user->agente()->nome,
                        'cpf' => $user->agente()->cpf,
                        'created_at' => $user->agente()->created_at,
                        'user' => [
                            'username' => $user->agente()->user()->username,
                            'role' => $user->agente()->user()->role,
                        ]
                    ]
                ];
            }
            $this->response->setContent(json_encode(['data' => $pacientes]));
            $this->response->setStatusCode(200);
            $this->response->send();
        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function getPaciente($id)
    {
        $id = array_shift($id);
        $token = $this->tokenVerify();
        if($token['http'] == 200){
            $paciente = (new Paciente())->findById($id);
            $pac = [
                'id' => $paciente->id,
                'idade' => $paciente->idade,
                'end_rua' => $paciente->end_rua,
                'end_num' => $paciente->end_num,
                'end_bairro' => $paciente->end_bairro,
                'end_cidade' => $paciente->end_cidade,
                'end_uf' => $paciente->end_uf,
                'end_complemento' => $paciente->end_complemento,
                'end_cep' => $paciente->end_cep,
                'telefone' => $paciente->telefone,
                'celular' => $paciente->celular,
                'agente' => [
                    'id' => $paciente->agente()->id,
                    'nome' => $paciente->agente()->nome,
                    'cpf' => $paciente->agente()->cpf,
                    'created_at' => $paciente->agente()->created_at,
                    'user' => [
                        'username' => $paciente->agente()->user()->username,
                        'role' => $paciente->agente()->user()->role,
                    ]
                ]
            ];
            $this->response->setContent(json_encode($pac));
            $this->response->setStatusCode(200);
            $this->response->send();
            
        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }

    }

    public function createPaciente()
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

            $paciente = new Paciente();
            $paciente->bootstrap(
                $agente->id,
                $this->request->get('idade'),
                $this->request->get('end_rua'),
                $this->request->get('end_num'),
                $this->request->get('end_bairro'),
                $this->request->get('end_cidade'),
                $this->request->get('end_uf'),
                $this->request->get('end_cep'),
                $this->request->get('end_complemento'),
                $this->request->get('telefone'),
                $this->request->get('celular')
            );
            if(!$paciente->save()){ //metodo save para salvar os dados do objeto no banco de dados
                Connection::rollback();
                $this->response->setContent($paciente->message()->getText());
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
            $this->response->setContent('Paciente cadastrado com sucesso');
            $this->response->setStatusCode(200);
            $this->response->send();
        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function updatePaciente()
    {

        $token = $this->tokenVerify();
        
        if($token['http'] == 200){
            
            $paciente = (new Paciente())->findById($this->request->get("paciente_id"));
            $agente = (new Agente())->findById($paciente->agente_id);
            $user = (new User())->findByAgenteId($agente->id);

            if(!isset($paciente)){
                $this->response->setContent('Paciente não encontrado');
                $this->response->setStatusCode(404);
                $this->response->send();
            }
            
            Connection::beginTransaction();

            $paciente->idade = $this->request->get('idade');
            $paciente->end_rua = $this->request->get('end_rua');
            $paciente->end_num = $this->request->get('end_num');
            $paciente->end_bairro = $this->request->get('end_bairro');
            $paciente->end_cidade = $this->request->get('end_cidade');
            $paciente->end_uf = $this->request->get('end_uf');
            $paciente->end_complemento = $this->request->get('end_complemento');
            $paciente->end_cep = $this->request->get('end_cep');
            $paciente->telefone = $this->request->get('telefone');
            $paciente->celular = $this->request->get('celular');

            if(!$paciente->save()){ //metodo save para salvar os dados do objeto no banco de dados
                Connection::rollback();
                $this->response->setContent($paciente->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            } 

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
            $this->response->setContent('Paciente atualizado com sucesso');
            $this->response->setStatusCode(200);
            $this->response->send();
        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }
    
}