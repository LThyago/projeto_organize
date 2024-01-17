<?php

require_once __DIR__ . '/../basemodel/BaseException.php';

class DataBaseUtils {

    private $servidor = "localhost:3306";
    private $usuario = "root";
    private $senha = "";
    private $banco = "lpp_organize";

    public function __construct() {
    }

    public function executarConsultaSelectBanco($query) {

        $conexao = new mysqli($this -> servidor, $this -> usuario, $this -> senha, $this -> banco);

        if ($conexao->connect_error) {
            throw new ExcecaoBase("Conexão falhou: " . $conexao->connect_error);
        }

        $resultado = $conexao->query($query);

        if ($resultado === false) {
            throw new ExcecaoBase("Erro na consulta: " . $conexao->error);
        }

        $listaResultados = array();
        while ($linha = $resultado->fetch_assoc()) {
            $listaResultados[] = $linha;
        }

        $conexao->close();

        return $listaResultados;
    }

    function executarConsultaInsertUpdateOuDeleteBanco($query) {

        $conexao = new mysqli($this -> servidor, $this -> usuario, $this -> senha, $this -> banco);

        if ($conexao->connect_error) {
            throw new ExcecaoBase("Conexão falhou: " . $conexao->connect_error);
        }

        $resultado = $conexao->query($query);

        if ($resultado === false) {
            throw new ExcecaoBase("Erro na execução da query no banco: " . $conexao->error);
        }

        $conexao->close();
    }

}

?>