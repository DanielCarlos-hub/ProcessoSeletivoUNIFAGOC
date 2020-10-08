<?php

namespace App\Model;

use App\Core\Model;

class Paciente extends Model
{

    /**
     * Paciente construtor
     */
    public  function __construct()
    {
        parent::__construct(
            "pacientes",
            ["id"],
            ["agente_id", "end_rua", "end_num", "end_bairro", "end_cidade", "end_uf"]
        );
    }

    /**
     * @param int $agente_id
     * @param int $idade
     * @param string $end_rua
     * @param string $end_num
     * @param string $end_bairro
     * @param string $end_cidade
     * @param string $end_uf
     * @param string $end_cep
     * @param string $end_complemento
     * @param string $telefone
     * @param string $celular
     * 
     * @return Paciente|null
     */
    public function bootstrap(int $agente_id, int $idade, string $end_rua, string $end_num, string $end_bairro, string $end_cidade, string $end_uf, string $end_cep, string $end_complemento, string $telefone, string $celular): ?Paciente
    {
        $this->agente_id = $agente_id;
        $this->idade = $idade;
        $this->end_rua = $end_rua;
        $this->end_num = $end_num;
        $this->end_bairro = $end_bairro;
        $this->end_cidade = $end_cidade;
        $this->end_uf = $end_uf;
        $this->end_cep = $end_cep;
        $this->end_complemento = $end_complemento;
        $this->telefone = $telefone;
        $this->celular = $celular;
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
     * @param int $id
     * @param string $columns
     * 
     * @return Paciente|null
     */
    public function findByAgente(int $id, string $columns = "*"): ?Paciente
    {
        $find = $this->find("agente_id = :agente_id", "agente_id={$id}", $columns);
        return $find->fetch();
    }

    /**
     * @return Agente|null
     */
    public function agente(): ?Agente
    {
        if($this->agente_id){
            return (new Agente())->findById($this->agente_id);
        }
        return null;
    }

}