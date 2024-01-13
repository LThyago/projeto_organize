<?php
class CategoriaModel extends BaseModel implements JsonSerializable {
    private $id;
    private $titulo;
    private $descricao;
    private $idUsuario;
    private $ordem;

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

    public function getIdUsuario() {
        return $this -> idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this -> idUsuario = $idUsuario;
    }

    public function getOrdem() {
        return $this -> ordem;
    }

    public function setOrdem ($ordem) {
        $this -> ordem = $ordem;
    }

    public function jsonSerialize() {
        return [
            'id' => $this -> getId(),
            'titulo' => $this -> getTitulo(),
            'descricao' => $this -> getDescricao(),
            'id_usuario' => $this -> getIdUsuario(),
            'ordem' => $this -> getOrdem(),
            'base_info' => parent::jsonSerialize()
        ];
    }
}
?>