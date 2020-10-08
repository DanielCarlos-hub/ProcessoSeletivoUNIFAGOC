<?php

namespace App\Model;

use App\Core\Model;

class User extends Model
{
   
    /**
     * User construtor
     */
    public  function __construct()
    {
        parent::__construct(
            "users",
            ["id"],
            ["agente_id", "username", "password", "role"]
        );
    }

    /**
     * @param int $agente_id
     * @param string $username
     * @param string $password
     * @param string $role
     * @return User|null
     */
    public function bootstrap(int $agente_id, string $username, string $password, string $role): ?User
    {
        $this->agente_id = $agente_id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
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
     * @return User|null
     */
    public function findByAgenteId(int $id, string $columns = "*"): ?User
    {
        $find = $this->find("agente_id = :agente_id", "agente_id={$id}", $columns);
        return $find->fetch();
    }

    /**
     * @param string $username
     * @param string $columns
     * 
     * @return User|null
     */
    public function findByUsername(string $username, string $columns = "*"): ?User
    {
        $find = $this->find("username = :username", "username={$username}", $columns);
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
    
    /**
     * @return bool
     */
    public function save(): bool
    {

        /** User Update */
        if (!empty($this->id)) {

            $userId = $this->id;

            $checkUser = $this->find("username = :u AND id != :i", "u={$this->username}&i={$userId}");

            if($checkUser->count()){
                $this->message->warning("O username informado já está cadastrado");
                return false;
            }
            
            $this->update($this->safe(), "id = :id", "id={$userId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->findByUsername($this->username, "id")) {
                $this->message->warning("O username informado já está cadastrado");
                return false;
            }

            $userId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($userId))->data();
        return true;
    }

}