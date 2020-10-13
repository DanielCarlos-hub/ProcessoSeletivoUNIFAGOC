<?php 

namespace App\Controller\Medico;

use App\Core\Controller;
use App\Model\Atendimento;

class AtendimentoController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->authenticated();
        if(user()->role != "medico")
            redirect(user()->role."/home");
    }

    public function espera()
    {
        $token = $this->tokenVerify();

        if($token['http'] == 200){
            $espera = [];
            $medico_id = user()->agente()->medico()->id;
            $atendimentos = (new Atendimento())->find("medico_id = :medico_id AND disponibilidade is null", "medico_id={$medico_id}")->fetch(true);

            foreach($atendimentos as $atendimento){
                $espera[] = [
                    'paciente' => [
                        'nome' => $atendimento->paciente()->agente()->nome,
                        'cpf' => $atendimento->paciente()->agente()->cpf,
                    ],
                    'created_at' => $atendimento->created_at,
                    'id' => $atendimento->id
                ];
            }

            $this->response->setContent(json_encode(['data' => $espera]));
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
            $medico_id = user()->agente()->medico()->id;
            $atendimentos = (new Atendimento())->find("medico_id = :medico_id AND disponibilidade = true", "medico_id={$medico_id}")->order('data_atendimento')->fetch(true);

            foreach($atendimentos as $atendimento){
                $confirmados[] = [
                    'paciente' => [
                        'nome' => $atendimento->paciente()->agente()->nome,
                        'cpf' => $atendimento->paciente()->agente()->cpf,
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
            $medico_id = user()->agente()->medico()->id;
            $atendimentos = (new Atendimento())->find("medico_id = :medico_id AND disponibilidade = false", "medico_id={$medico_id}")->fetch(true);

            foreach($atendimentos as $atendimento){
                $recusados[] = [
                    'paciente' => [
                        'nome' => $atendimento->paciente()->agente()->nome,
                        'cpf' => $atendimento->paciente()->agente()->cpf,
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
            $medico_id = user()->agente()->medico()->id;
            $atendimentos = (new Atendimento())->find("medico_id = :medico_id AND disponibilidade = 2", "medico_id={$medico_id}")->fetch(true);

            foreach($atendimentos as $atendimento){
                $finalizados[] = [
                    'paciente' => [
                        'nome' => $atendimento->paciente()->agente()->nome,
                        'cpf' => $atendimento->paciente()->agente()->cpf,
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

    public function getAtendimento($id)
    {
        $id = array_shift($id);
        $token = $this->tokenVerify();

        if($token['http'] == 200){
            $atend = (new Atendimento())->findById($id);
            $atendimento = [
                'id' => $atend->id,
                'paciente' => [
                    'nome' => $atend->paciente()->agente()->nome,
                    'cpf' => $atend->paciente()->agente()->cpf,
                ]
            ];
            $this->response->setContent(json_encode($atendimento));
            $this->response->setStatusCode(200);
            $this->response->send();
            
        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function confirmar()
    {

        $token = $this->tokenVerify();
        
        if($token['http'] == 200){

            $atendimento = (new Atendimento())->findById($this->request->get('atendimento_id'));
            
            if(!isset($atendimento)){
                $this->response->setContent('Atendimento não encontrado');
                $this->response->setStatusCode(404);
                $this->response->send();
            }

            $atendimento->disponibilidade = 1;
            $atendimento->data_atendimento = dataUS($this->request->get('data_atendimento'));
            $atendimento->start_at = $this->request->get('start_at');
            $atendimento->end_at = $this->request->get('end_at');

            if(!$atendimento->save()){
                $this->response->setContent($atendimento->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            };

            $this->response->setContent('O atendimento foi confirmado');
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function recusar()
    {
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){

            $atendimento = (new Atendimento())->findById($this->request->get('atendimento_id'));
            
            if(!isset($atendimento)){
                $this->response->setContent('Atendimento não encontrado');
                $this->response->setStatusCode(404);
                $this->response->send();
            }

            $atendimento->disponibilidade = 0;

            if(!$atendimento->save()){
                $this->response->setContent($atendimento->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            };

            $this->response->setContent('O atendimento foi recusado');
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function finalizar()
    {
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){

            $atendimento = (new Atendimento())->findById($this->request->get('atendimento_id'));
            
            if(!isset($atendimento)){
                $this->response->setContent('Atendimento não encontrado');
                $this->response->setStatusCode(404);
                $this->response->send();
            }

            $atendimento->disponibilidade = 2;

            if(!$atendimento->save()){
                $this->response->setContent($atendimento->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            };

            $this->response->setContent('O atendimento foi finalizado');
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    

}