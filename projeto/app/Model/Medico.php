<?php

namespace App\Model;

use App\Core\Model;

class Medico extends Model
{
   
    /**
     * Medico construtor
     */
    public  function __construct()
    {
        parent::__construct(
            "medicos",
            ["id"],
            ["agente_id", "crm"]
        );
    }

    /**
     * @param int $agente_id
     * @param string $crm
     * 
     * @return Medico|null
     */
    public function bootstrap(int $agente_id, string $crm): ?Medico
    {
        $this->agente_id = $agente_id;
        $this->crm = $crm;
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
     * @return Agente|null
     */
    public function agente(): ?Agente
    {
        if($this->agente_id){
            return (new Agente())->findById($this->agente_id);
        }
        return null;
    }

    /**
     * @return iterable|null
     */
    public function especialidades(): ?iterable
    {
        return (new MedicoEspecialidade())->findByMedico($this->id);
    }

    /**
     * @return iterable|null retornar todos os atendimentos de um medico
     */
    public function atendimentos() :?iterable
    {
        return (new Atendimento())->find("medico_id = :medico_id", "especialidade_id={$this->id}")->fetch(true);
    }

    /**
     * @param string $crm
     * @param string $columns
     * 
     * @return Medico|null
     */
    public function findByCrm(string $crm, string $columns = "*"): ?Medico
    {
        $find = $this->find("crm = :crm", "crm={$crm}", $columns);
        return $find->fetch();
    }

    public function save(): bool
    {

        /** Médico Update */
        if (!empty($this->id)) {
            $medicoId = $this->id;

            if ($this->find("crm = :c AND id != :i", "c={$this->crm}&i={$medicoId}", "id")->fetch()) {
                $this->message->warning("O CRM informado já está cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$medicoId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Médico Create */
        if (empty($this->id)) {

            if ($this->findByCrm($this->crm, "id")) {
                $this->message->warning("O CRM informado já está cadastrado");
                return false;
            }

            $medicoId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($medicoId))->data();
        return true;
    }

}