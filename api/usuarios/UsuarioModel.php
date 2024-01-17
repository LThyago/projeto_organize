<?php

require_once __DIR__ . '/../basemodel/BaseModel.php';

class UsuarioModel extends BaseModel implements JsonSerializable {
    private $id;
    private $nome;
    private $login;
    private $senha;

    public function __construct($nome, $login, $senha, 
    $dataCriacao, $dataAlteracao, $criadoPor, $alteradoPor, $deletado) {
        $this -> nome = $nome;
        $this -> login = $login;
        $this -> senha = $senha;
        parent::setDataCriacao($dataCriacao);
        parent::setDataAlteracao($dataAlteracao);
        parent::setCriadoPor($criadoPor);
        parent::setAlteradoPor($alteradoPor);
        parent::setDeletado($deletado);
    }

    public function getId() {
        return $this -> id;
    }

    public function getNome() {
        return $this -> nome;
    }

    public function setNome($nome) {
        $this -> nome = $nome;
    }

    public function getLogin() {
        return $this -> login;
    }

    public function setLogin($login) {
        $this -> login = $login;
    }

    public function getSenha() {
        return $this -> senha;
    }

    public function setSenha($senha) {
        $this -> senha = $senha;
    }

    public function jsonSerialize() {
        return [
            'id' => $this -> getId(),
            'nome' => $this -> getNome(),
            'login' => $this -> getLogin(),
            'senha' => $this -> getSenha(),
            'base_info' => parent::jsonSerialize()
        ];
    }

}
?>