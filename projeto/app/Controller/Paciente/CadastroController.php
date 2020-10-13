<?php 

namespace App\Controller\Paciente;

use App\Core\Connection;
use App\Core\Controller;
use App\Model\Agente;
use App\Model\Paciente;
use App\Model\User;

class CadastroController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->authenticated();
        if(user()->role != "paciente")
            redirect(user()->role."/home");
    }

    public function dados()
    {
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){

            $user = (new User())->findById($this->request->get('user_id'));

            $cadastro = [
                'nome' => $user->agente()->nome,
                'cpf' => $user->agente()->cpf,
                'idade' => $user->agente()->paciente()->idade,
                'telefone' => $user->agente()->paciente()->telefone,
                'celular' => $user->agente()->paciente()->celular,
                'end_rua' => $user->agente()->paciente()->end_rua,
                'end_num' => $user->agente()->paciente()->end_num,
                'end_bairro' => $user->agente()->paciente()->end_bairro,
                'end_cidade' => $user->agente()->paciente()->end_cidade,
                'end_uf' => $user->agente()->paciente()->end_uf,
                'end_complemento' => $user->agente()->paciente()->end_complemento,
                'end_cep' => $user->agente()->paciente()->end_cep,
            ];

            $this->response->setContent(json_encode($cadastro));
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function anonimizar()
    {
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){

            $user = (new User())->findById($this->request->get('user_id'));

            $cadastro = [
                'paciente_id' => $user->agente()->paciente()->id,
                'nome' => bin2hex(openssl_random_pseudo_bytes(32)),
                'end_rua' => bin2hex(openssl_random_pseudo_bytes(32)),
                'end_num' => bin2hex(openssl_random_pseudo_bytes(4)),
                'end_bairro' => bin2hex(openssl_random_pseudo_bytes(32)),
                'end_cidade' => bin2hex(openssl_random_pseudo_bytes(32)),
                'end_uf' => bin2hex(openssl_random_pseudo_bytes(1)),
                'end_complemento' => bin2hex(openssl_random_pseudo_bytes(32)),
                'end_cep' => bin2hex(openssl_random_pseudo_bytes(4)),
                'telefone' => bin2hex(openssl_random_pseudo_bytes(7)),
                'celular' => bin2hex(openssl_random_pseudo_bytes(8)),
            ];

            $this->response->setContent(json_encode($cadastro));
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent($token['message']);
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

    public function anonimizacao()
    {
        $token = $this->tokenVerify();
        
        if($token['http'] == 200){
            
            $paciente = (new Paciente())->findById($this->request->get("paciente_id"));
            $agente = (new Agente())->findById($paciente->agente_id);

            if(!isset($paciente)){
                $this->response->setContent('Paciente não encontrado');
                $this->response->setStatusCode(404);
                $this->response->send();
            }
            
            Connection::beginTransaction();

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

            $agente->nome = $this->request->get('nome');

            if(!$agente->save()){ //metodo save para salvar os dados do objeto no banco de dados
                Connection::rollback();
                $this->response->setContent($agente->message()->getText());
                $this->response->setStatusCode(400);
                $this->response->send();
            } 
            
            Connection::commit();
            $this->response->setContent('Seus dados foram anonimizados');
            $this->response->setStatusCode(200);
            $this->response->send();

        }else{
            $this->response->setContent(json_encode(['error' => $token['message']]));
            $this->response->setStatusCode($token['http']);
            $this->response->send();
        }
    }

}