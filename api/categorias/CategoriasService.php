<?php

require_once __DIR__ . '/../utils/DatabaseUtils.php';
require_once __DIR__ . '/CategoriaModel.php';

class CategoriasService {

    private $bancoUtils;

    public function __construct() {
        $this -> bancoUtils = new DatabaseUtils();
    }

    public function cadastrarCategoria($modelCategoria, $autorizacaoModel) {
        $categoriaCriacao = new CategoriaModel($modelCategoria -> titulo, 
        $modelCategoria -> descricao, $autorizacaoModel['idUsuario'], $this -> obterUltimaOrdem(), 
        date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $autorizacaoModel['login'], $autorizacaoModel['login'], 0);
        $this -> salvarCategoriaNovaNoBanco($categoriaCriacao);
    }

    public function listarCategoriasDoUsuario($autorizacaoModel) {
        $query = "SELECT * FROM categorias WHERE id_usuario = '" . $autorizacaoModel['idUsuario'] . "' AND deletado = 0 ORDER BY ordem ASC;";
        $listaCategoriasUsuario = $this -> bancoUtils -> executarConsultaSelectBanco($query);
        return $listaCategoriasUsuario;
    }

    public function atualizarCategoria($modelCategoria, $autorizacaoModel) {
        $query = "UPDATE categorias SET titulo = '" . $modelCategoria -> titulo . "', descricao = '" . $modelCategoria -> descricao . "', data_alteracao = '" . date('Y-m-d H:i:s') . "', alterado_por = '" . $autorizacaoModel['login'] . "' WHERE id = ".$modelCategoria -> id.";";
        $this -> bancoUtils -> executarConsultaInsertUpdateOuDeleteBanco($query);
    }

    public function deletarCategoria($id, $autorizacaoModel) {
        $query = "UPDATE categorias SET deletado = 1, data_alteracao = '".date('Y-m-d H:i:s')."', alterado_por = '".$autorizacaoModel['login']."' WHERE id = '$id';";
        $this -> bancoUtils -> executarConsultaInsertUpdateOuDeleteBanco($query);
    }

    private function salvarCategoriaNovaNoBanco($model) {
        $query = "SELECT * FROM categorias WHERE titulo = '".$model -> getTitulo()."' AND deletado = 0;";
        $categoriasBanco = $this -> bancoUtils -> executarConsultaSelectBanco($query);
        if (!empty($usuariosBanco)) throw new ExcecaoBase("Categoria com o nome informado já existe");
        $query = "INSERT INTO categorias(titulo, descricao, id_usuario, ordem, data_criacao, data_alteracao, criado_por, alterado_por, deletado) VALUES('".$model -> getTitulo()."', '".$model -> getDescricao()."', '".$model -> getIdUsuario()."', ".$model -> getOrdem().", '".$model -> getDataCriacao()."', '".$model -> getDataAlteracao()."', '".$model -> getCriadoPor()."', '".$model -> getAlteradoPor()."', ".$model -> getDeletado().");";
        $this -> bancoUtils -> executarConsultaInsertUpdateOuDeleteBanco($query);
    }

    private function obterUltimaOrdem(){
        $query = "SELECT MAX(ordem) AS max_ordem FROM categorias;";
        $ordensBanco = $this -> bancoUtils -> executarConsultaSelectBanco($query);
        if (empty($ordensBanco)) return 1;
        return ($ordensBanco[0]['max_ordem']+1);
    }
}
?>