<?php

namespace App\Model;

use App\Core\Model;

class Especialidade extends Model
{
   
    /**
     * User construtor
     */
    public  function __construct()
    {
        parent::__construct(
            "especialidades",
            ["id"],
            ["espec", "descricao"]
        );
    }

    /**
     * @param int $agente_id
     * @param string $username
     * @param string $password
     * @param string $role
     * @return User|null
     */
    public function bootstrap(string $espec, string $descricao): ?Especialidade
    {
        $this->espec = $espec;
        $this->descricao = $descricao;
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

    public function findByEspec(string $espec, string $columns = "*"): ?Especialidade
    {
        $find = $this->find("espec = :espec", "espec={$espec}", $columns);
        return $find->fetch();
    }

    public function medicos(): ?MedicoEspecialidade
    {
        return (new MedicoEspecialidade())->findByEspecialidade($this->id);
    }
    
    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Preencha os campos obrigatórios");
            return false;
        }

        /** User Update */
        if (!empty($this->id)) {
            $especialidadeId = $this->id;

            $this->update($this->safe(), "id = :id", "id={$especialidadeId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->findByEspec($this->espec, "id")) {
                $this->message->warning("A especialidade informada já está cadastrada");
                return false;
            }

            $especialidadeId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($especialidadeId))->data();
        return true;
    }

}