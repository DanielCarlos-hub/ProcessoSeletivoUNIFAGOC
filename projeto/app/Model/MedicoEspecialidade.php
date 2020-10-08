<?php

namespace App\Model;

use App\Core\Model;

class MedicoEspecialidade extends Model
{
/**
     * User construtor
     */
    public  function __construct()
    {
        parent::__construct(
            "especialidade_medico",
            ["id"],
            ["especialidade_id", "medico_id"]
        );
    }

    /**
     * @param int $agente_id
     * @param string $username
     * @param string $password
     * @param string $role
     * @return User|null
     */
    public function bootstrap(int $especialidade_id, int $medico_id): ?MedicoEspecialidade
    {
        $this->especialidade_id = $especialidade_id;
        $this->medico_id = $medico_id;
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
     * @return iterable|null
     */
    public function findByEspecialidade(int $id, string $columns = "*"): ?iterable
    {
        $find = $this->find("especialidade_id = :especialidade_id", "especialidade_id={$id}", $columns);
        return $find->fetch(true);
    }   

    
    /**
     * @param int $id
     * @param string $columns
     * 
     * @return iterable|null
     */
    public function findByMedico(int $id, string $columns = "*"): ?iterable
    {
        $find = $this->find("medico_id = :medico_id", "medico_id={$id}", $columns);
        return $find->fetch(true);
    }   

    /**
     * @return Especialidade|null
     */
    public function especialidade(): ?Especialidade
    {
        if($this->especialidade_id)
            return (new Especialidade())->findByID($this->especialidade_id);
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
            $medicoEspecialidadeId = $this->id;

            $this->update($this->safe(), "id = :id", "id={$medicoEspecialidadeId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {

            $medicoEspecialidadeId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($medicoEspecialidadeId))->data();
        return true;
    }

}