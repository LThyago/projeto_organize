<?php
class BaseModel implements JsonSerializable {
    private $dataCriacao;
    private $dataAlteracao;
    private $criadoPor;
    private $alteradoPor;
    private $deletado;

    public function __construct() {
    }

    public function getDataCriacao() {
        return $this -> dataCriacao;
    }
    
    public function setDataCriacao($dataCriacaoParam) {
        $this -> dataCriacao = $dataCriacaoParam;
    }

    public function getDataAlteracao() {
        return $this -> dataAlteracao;
    }

    public function setDataAlteracao($dataAlteracaoParam) {
        $this -> dataAlteracao = $dataAlteracaoParam;
    }

    public function getCriadoPor() {
        return $this -> criadoPor;
    }

    public function setCriadoPor($criadoPorParam) {
        $this -> criadoPor = $criadoPorParam;
    }

    public function getAlteradoPor() {
        return $this -> alteradoPor;
    }

    public function setAlteradoPor($alteradoPorParam) {
        $this -> alteradoPor = $alteradoPorParam;
    }

    public function getDeletado() {
        return $this -> deletado;
    }

    public function setDeletado($deletadoParam) {
        $this -> deletado = $deletadoParam;
    }

    public function jsonSerialize() {
        return [
            'dataCriacao' => $this -> getDataCriacao(),
            'dataAlteracao' => $this -> getDataAlteracao(),
            'criadoPor' => $this -> getCriadoPor(),
            'alteradoPor' => $this -> getAlteradoPor(),
            'deletado' => $this -> getDeletado()
        ];
    }
}
?>