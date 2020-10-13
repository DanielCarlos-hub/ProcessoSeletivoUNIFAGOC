<?php

namespace App\Model;

use App\Core\Model;
use App\Model\Paciente;
use App\Model\Medico;


class Atendimento extends Model
{
   
    /**
     * Agente construtor
     */
    public  function __construct()
    {
        parent::__construct(
            "atendimentos",
            ["id"],
            ["paciente_id", "medico_id"]
        );
    }

    /**
     * @param string $cpf
     * @param string $nome
     * 
     * @return Atendimento|null
     */
    public function bootstrap(int $medico_id, int $paciente_id, ?bool $disponibilidade, ?string $data_atendimento, ?string $start_at, ?string $end_at): ?Atendimento
    {
        $this->medico_id = $medico_id;
        $this->paciente_id = $paciente_id;
        $this->disponibilidade = $disponibilidade;
        $this->data_atendimento = $data_atendimento;
        $this->start_at = $start_at;
        $this->end_at = $end_at;
        return $this;
    }

    /**
     * @param string|null $terms
     * @param string|null $params
     * @param string $columns
     * 
     * @return Model
     */
    public function find(?string $terms = null, ?string $params = null, string $columns = "*"): Model
    {
        return parent::find($terms, $params, $columns);
    }

    /**
     * @return Medico|null
     */
    public function medico() :?Medico
    {
        return (new Medico())->findById($this->medico_id);
    }

    /**
     * @return Paciente|null
     */
    public function paciente() :?Paciente
    {
        return (new Paciente())->findById($this->paciente_id);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if(!isset($this->id)){
            $checkOcioso = (new Atendimento())->find("medico_id = :medico_id AND disponibilidade is null", "medico_id={$this->medico_id}");
            
            if ($checkOcioso->count()) {
                $this->message->warning("O Médico escolhido está com uma solicitação pendente!");
                return false;
            }

            $checkSolicitacao = (new Atendimento())->find("paciente_id = :paciente_id AND disponibilidade is null", "paciente_id={$this->paciente_id}");

            if ($checkSolicitacao->count()) {
                $this->message->warning("Você já possui uma solicitação em andamento! Aguarde a resposta do médico");
                return false;
            }

            $checkAtendimento = (new Atendimento())->find("medico_id = :medico_id AND paciente_id = :paciente_id AND disponibilidade = true", "medico_id={$this->medico_id}&paciente_id={$this->paciente_id}");

            if($checkAtendimento->count()){
                $this->message->warning("Você já possui um atendimento agendado com esse médico");
                return false;
            }
        }

        return parent::save();
    }
}