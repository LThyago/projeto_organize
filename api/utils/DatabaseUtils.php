<?php

require __DIR__ . '/api/basemodel/BaseException.php';

class DataBaseUtils {

    private $servidor = "localhost";
    private $usuario = "root";
    private $senha = "123";
    private $banco = "lpp_organize";

    public function __construct() {
    }

    public function executarConsultaSelectBanco($query) {

        $conexao = new mysqli($this -> servidor, $this -> usuario, $this -> senha, $this -> banco);

        if ($conexao->connect_error) {
            throw new BaseException("Conexão falhou: " . $conexao->connect_error);
        }

        $resultado = $conexao->query($query);

        if ($resultado === false) {
            throw new BaseException("Erro na consulta: " . $conexao->error);
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
            throw new BaseException("Conexão falhou: " . $conexao->connect_error);
        }

        $resultado = $conexao->query($query);

        if ($resultado === false) {
            throw new BaseException("Erro na execução da query no banco: " . $conexao->error);
        }

        $conexao->close();
    }

}

?>