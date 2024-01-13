<?php
class TarefaModel extends BaseModel implements JsonSerializable {
    private $id;
    private $titulo;
    private $descricao;
    private $dataLimite;
    private $status;
    private $idCategoria;
    
    public function __construct() {  
    }

    public function getId() {
        return $this -> id;
    }

    public function getTitulo() {
        return $this -> titulo;
    }

    public function setTitulo($titulo) {
        $this -> titulo = $titulo;
    }

    public function getDescricao() {
        return $this -> descricao;
    }

    public function setDescricao($descricao) {
        $this -> descricao = $descricao;
    }

    public function getDataLimite() {
        return $this -> dataLimite;
    }

    public function setDataLimite($dataLimite) {
        $this -> dataLimite = $dataLimite;
    }

    public function getStatus() {
        return $this -> status;
    }

    public function setStatus($status) {
        $this -> status = $status;
    }

    public function getIdCategoria() {
        return $this -> idCategoria;
    }

    public function setIdCategoria($idCategoria) {
        $this -> idCategoria = $idCategoria;
    }

    public function jsonSerialize() {
        return [
            'id' => $this -> getId(),
            'titulo' => $this -> getTitulo(),
            'descricao' => $this -> getDescricao(),
            'data_limite' => $this -> getDataLimite(),
            'status' => $this -> getStatus(),
            'id_categoria' => $this -> getIdCategoria(),
            'base_info' => parent::jsonSerialize()
        ];
    }
}
?>