<?php 

namespace App\Controller\Paciente;
use App\Core\Controller;

use App\Model\User;
use App\Model\Exame;

class ExamesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authenticated();
        if(user()->role != "paciente")
            redirect(user()->role."/home");
    }

    public function index()
    {
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){
            $exames = [];
            $paciente_id = (new User())->findById(user()->id)->agente()->paciente()->id;
            $exams = (new Exame())->find("paciente_id = :paciente_id", "paciente_id={$paciente_id}")->order('data_exame')->fetch(true);

            foreach($exams as $exam){
                $exames[] = [
                    'id' => $exam->id,
                    'data_exame' => $exam->data_exame,
                    'descricao' => $exam->descricao,
                    'medico' => [
                        'nome' => $exam->medico()->agente()->nome,
                        'crm' => $exam->medico()->crm,
                    ]
                ];
            }

            $this->response->setContent(json_encode(['data' => $exames]));
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function getExame($id)
    {
        $id = array_shift($id);
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){
            $exam = (new Exame())->findById($id);

            $exame = [
                'id' => $exam->id,
                'atendimento_id' => $exam->atendimento_id,
                'medico' => [
                    'nome' => $exam->medico()->agente()->nome,
                    'crm' => $exam->medico()->crm,
                ],
                'descricao' => $exam->descricao,
                'resultado' => $exam->resultado,
                'observacao' => $exam->observacoes,
                'data_exame' => $exam->data_exame,
            ];

            
            $this->response->setContent(json_encode($exame));
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }
}