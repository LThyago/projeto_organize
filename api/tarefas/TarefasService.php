<?php

require_once __DIR__ . '/../utils/DatabaseUtils.php';
require_once __DIR__ . '/TarefaModel.php';

class TarefasService {

    private $bancoUtils;

    public function __construct() {
        $this -> bancoUtils = new DatabaseUtils();
    }

    public function cadastrarTarefa($modelTarefa, $autorizacaoModel) {
        $tarefaCriacao = new TarefaModel($modelTarefa -> titulo, 
        $modelTarefa -> descricao, $modelTarefa -> dataLimite, $modelTarefa -> status, $modelTarefa -> idCategoria, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $autorizacaoModel['login'], $autorizacaoModel['login'], 0);
        $this -> salvarTarefaBanco($tarefaCriacao);
    }

    public function listarTarefasPorCategoria($idCategoria) {
        $query = "SELECT * FROM tarefas WHERE id_categoria = $idCategoria AND deletado = 0 ORDER BY id ASC;";
        $listaTarefasPorCategoria = $this -> bancoUtils -> executarConsultaSelectBanco($query);
        return $listaTarefasPorCategoria;
    }

    public function atualizarTarefa($modelTarefa, $autorizacaoModel) {
        $query = "UPDATE tarefas SET titulo = '" . $modelTarefa -> titulo . "', descricao = " . (isset($modelTarefa -> descricao) ? "'" . $modelTarefa -> descricao . "'" : "null") . ", data_limite = " . (isset($modelTarefa -> dataLimite) ? "'" . $modelTarefa -> dataLimite . "'" : "null") . ", status = " . $modelTarefa -> status . ", data_alteracao = '" . date('Y-m-d H:i:s') . "', alterado_por = '" . $autorizacaoModel['login'] . "' WHERE id = ".$modelTarefa -> id.";";
        $this -> bancoUtils -> executarConsultaInsertUpdateOuDeleteBanco($query);
    }

    public function deletarTarefa($id, $autorizacaoModel) {
        $query = "UPDATE tarefas SET deletado = 1, data_alteracao = '".date('Y-m-d H:i:s')."', alterado_por = '".$autorizacaoModel['login']."' WHERE id = '$id';";
        $this -> bancoUtils -> executarConsultaInsertUpdateOuDeleteBanco($query);
    }

    private function salvarTarefaBanco($model) {
        $query = "INSERT INTO tarefas(titulo, descricao, data_limite, status, id_categoria, data_criacao, data_alteracao, criado_por, alterado_por, deletado) VALUES('".$model -> getTitulo()."', ".(($model -> getDescricao() != null) ? "'" . $model -> getDescricao() . "'" : "null").", ".(($model -> getDataLimite() != null) ? "'" . $model -> getDataLimite() . "'" : "null").", 0, ".$model -> getIdCategoria().", '".$model -> getDataCriacao()."', '".$model -> getDataAlteracao()."', '".$model -> getCriadoPor()."', '".$model -> getAlteradoPor()."', ".$model -> getDeletado().");";
        $this -> bancoUtils -> executarConsultaInsertUpdateOuDeleteBanco($query);
    }
}
?>