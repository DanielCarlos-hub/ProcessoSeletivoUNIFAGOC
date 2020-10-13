<?php

namespace App\Controller\Admin;

use App\Core\Connection;
use App\Core\Controller;

use App\Model\Agente;
use App\Model\Especialidade;
use App\Model\Medico;
use App\Model\MedicoEspecialidade;
use App\Model\User;

class MedicosController extends Controller
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
        $especialidades = (new Especialidade())->find()->fetch(true);
        $this->load('admin/users/medicos',[
           'especialidades' => $especialidades
        ]);
    }

    public function showMedicos()
    {
        $token = $this->tokenVerify();
        if($token['http'] == 200){

            $medicos = [];
            $users = (new Medico())->find()->fetch(true);

            if($users){
                foreach($users as $user){
                    $medicos[] = [
                        'id' => $user->id,
                        'crm' => $user->crm,
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
            }
            $this->response->setContent(json_encode(['data' => $medicos]));
            $this->response->setStatusCode(200);
            $this->response->send();
        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }

    }

    public function getMedico($id)
    {
        $id = array_shift($id);
        $token = $this->tokenVerify();
        if($token['http'] == 200){
            $medico = (new Medico())->findById($id);

            $especs = [];
            foreach($medico->especialidades() as $especialidades){
                $especs[] = [
                    'id' => $especialidades->especialidade()->id,
                    'especialidade' => $especialidades->especialidade()->espec
                ];
            }
            $medic = [
                'id' => $medico->id,
                'crm' => $medico->crm,
                'especialidades' => $especs,
                'agente' => [
                    'id' => $medico->agente()->id,
                    'nome' => $medico->agente()->nome,
                    'cpf' => $medico->agente()->cpf,
                    'created_at' => $medico->agente()->created_at,
                    'user' => [
                        'username' => $medico->agente()->user()->username,
                        'role' => $medico->agente()->user()->role,
                    ]
                ]
            ];
            $this->response->setContent(json_encode($medic));
            $this->response->setStatusCode(200);
            $this->response->send();
            
        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }

    }

    public function createMedico()
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
            
            
            $medico = new Medico();
            $medico->bootstrap(
                $agente->id,
                $this->request->get('crm'),
            );
            if(!$medico->save()){
                Connection::rollback();
                $this->response->setContent($medico->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            };
            
            foreach($this->request->get('especialidades') as $espec){
                $especialidades = new MedicoEspecialidade();
                $especialidades->bootstrap(
                    $espec,
                    $medico->id

                );
                $especialidades->save();
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
            $this->response->setContent('Médico cadastrado com sucesso');
            $this->response->setStatusCode(200);
            $this->response->send();
        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function updateMedico()
    {

        $token = $this->tokenVerify();
        
        if($token['http'] == 200){
            
            $medico = (new Medico())->findById($this->request->get("medico_id"));
            $agente = (new Agente())->findById($medico->agente_id);
            $user = (new User())->findByAgenteId($agente->id);

            if(!isset($medico)){
                $this->response->setContent('Médico não encontrado');
                $this->response->setStatusCode(404);
                $this->response->send();
            }
            
            Connection::beginTransaction();
            try {
                $medico->crm = $this->request->get('crm');
                $medico->save();
    
                $agente->cpf = $this->request->get('cpf');
                $agente->nome = $this->request->get('nome');
                $agente->save();
                
                $user->username = $this->request->get('username');
                if($this->request->get('password') != '')
                    $user->password = hash_password($this->request->get('password'));
    
                $user->save();

                //recuperar especialidades atuais e remover antes de inserir as novas;
                if(!is_null($this->request->get('especialidades'))){

                    $especialidades = (new MedicoEspecialidade())->findByMedico($medico->id);
                    foreach($especialidades as $especialidade)
                    {
                        $especialidade->destroy();
                    }

                    foreach($this->request->get('especialidades') as $espec){

                        $especialidades = new MedicoEspecialidade();
                        $especialidades->bootstrap(
                            $espec,
                            $medico->id
                        );
                        $especialidades->save();
                    }
                }
                
                Connection::commit();
                $this->response->setContent('Médico atualizado com sucesso');
                $this->response->setStatusCode(200);
                $this->response->send();

            } catch (\Exception $e) {

                Connection::rollback();
                $this->response->setContent('Erro ao atualizar');
                $this->response->setStatusCode(400);
                $this->response->send();
            }
           

        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

}