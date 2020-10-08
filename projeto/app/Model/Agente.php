<?php

namespace App\Model;

use App\Core\Model;
use App\Model\Paciente;

class Agente extends Model
{
   
    /**
     * Agente construtor
     */
    public  function __construct()
    {
        parent::__construct(
            "agentes",
            ["id"],
            ["cpf", "nome"]
        );
    }

    /**
     * @param string $cpf
     * @param string $nome
     * 
     * @return Agente|null
     */
    public function bootstrap(string $cpf, string $nome): ?Agente
    {
        $this->cpf = $cpf;
        $this->nome = $nome;
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
     * @param string $cpf
     * @param string $columns
     * 
     * @return Agente|null
     */
    public function findByCPF(string $cpf, string $columns = "*"): ?Agente
    {
        $find = $this->find("cpf = :cpf", "cpf={$cpf}", $columns);
        return $find->fetch();
    }

    /**
     * @return User|null
     */
    public function user() :?User
    {
        return (new User())->findByAgenteId($this->id);
    }

    /**
     * @return Paciente|null
     */
    public function paciente() :?Paciente
    {
        return (new Paciente())->findByAgente($this->id);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        
        /** Agente Update */
        if (!empty($this->id)) {
            $agenteId = $this->id;

            if ($this->find("cpf = :c AND id != :i", "c={$this->cpf}&i={$this->id}", "id")->fetch()) {
                $this->message->warning("O cpf informado já está cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$agenteId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Agente Create */
        if (empty($this->id)) {

            if ($this->findByCPF($this->cpf, "id")) {
                $this->message->warning("O cpf informado já está cadastrado");
                return false;
            }

            $agenteId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($agenteId))->data();
        return true;
    }
}