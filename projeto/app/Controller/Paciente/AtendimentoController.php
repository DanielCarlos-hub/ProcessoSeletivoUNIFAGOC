<?php 

namespace App\Controller\Paciente;

use App\Core\Controller;
use App\Model\Atendimento;
use App\Model\Medico;
use App\Model\Paciente;
use App\Model\User;

class AtendimentoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authenticated();
        if(user()->role != "paciente")
            redirect(user()->role."/home");
    }

    public function medicos()
    {
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){

            $medicos = [];
            $medics = (new Medico())->find()->fetch(true);


            foreach($medics as $medic){
                $medicos[] = [
                    'id' => $medic->id,
                    'crm' => $medic->crm,
                    'agente' => [
                        'id' => $medic->agente()->id,
                        'nome' => $medic->agente()->nome,
                        'cpf' => $medic->agente()->cpf,
                    ]
                ];
            }
            
            $this->response->setContent(json_encode(['data' => $medicos]));
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function solicitar()
    {

        $token = $this->tokenVerify();
        
        if($token['http'] == 200){

            $user = (new User())->findById($this->request->get('user_id'));
            $paciente = (new Paciente())->findByAgente($user->agente_id);
            $medico = (new Medico())->findById($this->request->get('medico_id'));

            $atendimento = new Atendimento();

            $atendimento->bootstrap(
                $medico->id,
                $paciente->id,
                null,
                null,
                null,
                null,
            );

            if(!$atendimento->save()){
                $this->response->setContent($atendimento->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            }

            $this->response->setContent('Atendimento registrado! Aguarde o retorno do Médico');
            $this->response->setStatusCode(200);
            $this->response->send();
            
        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }

    }

    public function confirmados()
    {

        $token = $this->tokenVerify();

        if($token['http'] == 200){

            $confirmados = [];
            $paciente_id = user()->agente()->paciente()->id;
            $atendimentos = (new Atendimento())->find("paciente_id = :paciente_id AND disponibilidade = true", "paciente_id={$paciente_id}")->fetch(true);

            foreach($atendimentos as $atendimento){
                $confirmados[] = [
                    'medico' => [
                        'nome' => $atendimento->medico()->agente()->nome,
                        'crm' => $atendimento->medico()->crm,
                    ],
                    'data_atendimento' => $atendimento->data_atendimento,
                    'start_at' => $atendimento->start_at,
                    'end_at' => $atendimento->end_at,
                    'created_at' => $atendimento->created_at,
                    'id' => $atendimento->id
                ];
            }

            $this->response->setContent(json_encode(['data' => $confirmados]));
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function recusados()
    {

        $token = $this->tokenVerify();
        
        if($token['http'] == 200){

            $recusados = [];
            $paciente_id = user()->agente()->paciente()->id;
            $atendimentos = (new Atendimento())->find("paciente_id = :paciente_id AND disponibilidade = false", "paciente_id={$paciente_id}")->fetch(true);

            foreach($atendimentos as $atendimento){
                $recusados[] = [
                    'medico' => [
                        'nome' => $atendimento->medico()->agente()->nome,
                        'crm' => $atendimento->medico()->crm,
                    ],
                    'updated_at' => $atendimento->updated_at,
                    'id' => $atendimento->id
                ];
            }
            $this->response->setContent(json_encode(['data' => $recusados]));
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{

            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function finalizados()
    {
        $token = $this->tokenVerify();

        if($token['http'] == 200){

            $finalizados = [];
            $paciente_id = user()->agente()->paciente()->id;
            $atendimentos = (new Atendimento())->find("paciente_id = :paciente_id AND disponibilidade = 2", "paciente_id={$paciente_id}")->fetch(true);

            foreach($atendimentos as $atendimento){
                $finalizados[] = [
                    'medico' => [
                        'nome' => $atendimento->medico()->agente()->nome,
                        'crm' => $atendimento->medico()->crm,
                    ],
                    'updated_at' => $atendimento->updated_at,
                    'id' => $atendimento->id
                ];
            }
            $this->response->setContent(json_encode(['data' => $finalizados]));
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }
}