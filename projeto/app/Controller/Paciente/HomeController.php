<?php 

namespace App\Controller\Paciente;
use App\Core\Controller;
use App\Model\Atendimento;
use App\Model\Medico;
use App\Model\Paciente;
use App\Model\User;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authenticated();
        if(user()->role != "paciente")
            redirect(user()->role."/home");
    }

    public function showHome()
    {
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
                    ]
                ];
            }
        }
        
        $this->load("paciente/home", [
            'medicos' => $medicos
        ]);
    }

    public function solicitar()
    {
        
        $user = (new User())->findById($this->request->get('user_id'));
        $medico = (new Medico())->findById($this->request->get('medico_id'));
        $paciente = (new Paciente())->findByAgente($user->agente_id);

        $atendimento = new Atendimento();

        $atendimento->bootstrap(
            $medico->id,
            $paciente->id,
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
            
        

    }
}