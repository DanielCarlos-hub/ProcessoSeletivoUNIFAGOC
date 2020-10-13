<?php

namespace App\Model;

use App\Core\Model;

class Exame extends Model
{
   
    /**
     * Exame construtor
     */
    public  function __construct()
    {
        parent::__construct(
            "exames",
            ["id"],
            ["atendimento_id", "paciente_id", "medico_id", "descricao", "resultado", "data_exame"]
        );
    }


    /**
     * @param int $atendimento_id
     * @param int $paciente_id
     * @param int $medico_id
     * @param string $descricao
     * @param string $resultado
     * @param string|null $observacoes
     * @param string $data_exame
     * 
     * @return Exame|null
     */
    public function bootstrap(int $atendimento_id, int $paciente_id, int $medico_id, string $descricao, string $resultado, ?string $observacoes, string $data_exame ): ?Exame
    {
        $this->atendimento_id = $atendimento_id;
        $this->paciente_id = $paciente_id;
        $this->medico_id = $medico_id;
        $this->descricao = $descricao;
        $this->resultado = $resultado;
        $this->observacoes = $observacoes;
        $this->data_exame = $data_exame;
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
     * @return Atendimento|null
     */
    public function atendimento() :?Atendimento
    {
        return (new Atendimento())->findById($this->atendimento_id);
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

}