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
    public function bootstrap(int $medico_id, int $paciente_id, ?bool $disponibilidade): ?Atendimento
    {
        $this->medico_id = $medico_id;
        $this->paciente_id = $paciente_id;
        $this->disponibilidade = $disponibilidade;
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
        $checkOcioso = (new Atendimento())->find("medico_id = :medico_id AND disponibilidade is null", "medico_id={$this->medico_id}");

        if ($checkOcioso->count()) {
            $this->message->warning("Médico com solicitação pendente");
            return false;
        }

        return parent::save();
    }
}