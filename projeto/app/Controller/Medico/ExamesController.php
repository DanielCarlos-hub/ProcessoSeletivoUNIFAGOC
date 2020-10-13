<?php 

namespace App\Controller\Medico;
use App\Core\Controller;
use App\Model\Atendimento;
use App\Model\User;
use App\Model\Exame;

class ExamesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authenticated();
        if(user()->role != "medico")
            redirect(user()->role."/home");
    }

    public function index()
    {
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){
            $exames = [];
            $medico_id = (new User())->findById(user()->id)->agente()->medico()->id;
            $exams = (new Exame())->find("medico_id = :medico_id", "medico_id={$medico_id}")->order('data_exame')->fetch(true);

            foreach($exams as $exam){
                $exames[] = [
                    'id' => $exam->id,
                    'data_exame' => $exam->data_exame,
                    'descricao' => $exam->descricao,
                    'paciente' => [
                        'nome' => $exam->paciente()->agente()->nome,
                        'cpf' => $exam->paciente()->agente()->cpf,
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
                'paciente' => [
                    'nome' => $exam->paciente()->agente()->nome,
                    'cpf' => $exam->paciente()->agente()->cpf,
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
    public function atendimentos()
    {
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){

            $medico_id = (new User())->findById(user()->id)->agente()->medico()->id;
            $atends = (new Atendimento())->find("medico_id = :medico_id AND disponibilidade = 1", "medico_id={$medico_id}")->order('data_atendimento')->fetch(true);

            $atendimentos = [];

            foreach($atends as $atend){
                $atendimentos[] = [
                    'id' => $atend->id,
                    'paciente_id' => $atend->paciente_id,
                    'medico_id' =>$atend->medico_id,
                    'paciente' => $atend->paciente()->agente()->nome,
                    'data_atendimento' => $atend->data_atendimento,
                    'start_at' => $atend->start_at,
                    'end_at' => $atend->end_at,
                ];
            }

            $this->response->setContent(json_encode(['atendimentos' => $atendimentos]));
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function salvar()
    {
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){
        
            $atendimento = (new Atendimento())->findById($this->request->get('atendimento_id'));

            $exame = new Exame();

            $exame->bootstrap(
                $this->request->get('atendimento_id'),
                $atendimento->paciente_id,
                $atendimento->medico_id,
                $this->request->get('descricao'),
                $this->request->get('resultado'),
                $this->request->get('observacao'),
                dataUS($this->request->get('data_exame'))
            );

            if(!$exame->save()){
                $this->response->setContent($exame->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            };
            
            
            $this->response->setContent('Exame registrado com sucesso');
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function update()
    {
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){

            $exame = (new Exame())->findById($this->request->get('exame_id'));
            $atendimento = (new Atendimento())->findById($this->request->get('atendimento_id'));

            if(!isset($exame)){
                $this->response->setContent('Exame não encontrado');
                $this->response->setStatusCode(404);
                $this->response->send();
            }

            $exame->atendimento_id = $this->request->get('atendimento_id');
            $exame->medico_id = $atendimento->medico_id;
            $exame->paciente_id = $atendimento->paciente_id;
            $exame->descricao = $this->request->get('descricao');
            $exame->resultado = $this->request->get('resultado');
            $exame->observacoes = $this->request->get('observacao');
            $exame->data_exame = dataUS($this->request->get('data_exame'));

            if(!$exame->save()){
                $this->response->setContent($exame->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            };

            $this->response->setContent('Exame atualizado com sucesso');
            $this->response->setStatusCode(200);
            $this->response->send();
            
        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }
}