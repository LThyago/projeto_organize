<?php

require_once __DIR__ . '/../utils/DatabaseUtils.php';
require_once __DIR__ . '/UsuarioModel.php';

class UsuariosService {

    private $bancoUtils;

    public function __construct() {
        $this -> bancoUtils = new DatabaseUtils();
    }

    public function registrarUsuario($modelUsuario) {
        $usuarioCriacao = new UsuarioModel($modelUsuario -> nome, 
        $modelUsuario -> login, md5($modelUsuario -> senha), 
        date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), 'registro_usuario', 'registro_usuario', 0);
        $this -> salvarUsuarioNoBanco($usuarioCriacao);
    }

    public function autenticarUsuario($modelUsuario) {
        return $this -> obtemUsuarioLoginBanco($modelUsuario -> login, 
        md5($modelUsuario -> senha));
    }

    private function salvarUsuarioNoBanco($model) {
        $query = "SELECT * FROM usuarios WHERE login = '".$model -> getLogin()."' AND deletado = 0;";
        $usuariosBanco = $this -> bancoUtils -> executarConsultaSelectBanco($query);
        if (!empty($usuariosBanco)) throw new ExcecaoBase("Usuário já possui cadastro");
        $query = "INSERT INTO usuarios(nome, login, senha, data_criacao, data_alteracao, criado_por, alterado_por, deletado) VALUES('".$model -> getNome()."', '".$model -> getLogin()."', '".$model -> getSenha()."', '".$model -> getDataCriacao()."', '".$model -> getDataAlteracao()."', '".$model -> getCriadoPor()."', '".$model -> getAlteradoPor()."', ".$model -> getDeletado().");";
        $this -> bancoUtils -> executarConsultaInsertUpdateOuDeleteBanco($query);
    }

    private function obtemUsuarioLoginBanco($login, $senha) {
        $query = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha' AND deletado = 0;";
        $usuariosBanco = $this -> bancoUtils -> executarConsultaSelectBanco($query);
        if (empty($usuariosBanco)) throw new ExcecaoBase("Usuario ou senha inválidos");
        return $usuariosBanco[0];
    }

    public function validarCredenciaisUsuario($autorizacaoModel){
        $login = $autorizacaoModel['login'];
        $senha = md5($autorizacaoModel['senha']);
        $query = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha' AND deletado = 0;";
        $usuariosBanco = $this -> bancoUtils -> executarConsultaSelectBanco($query);
        if (empty($usuariosBanco)) throw new ExcecaoBase("Usuário não autorizado");
        return ['idUsuario' => $usuariosBanco[0]['id'], 'login' => $usuariosBanco[0]['login']];
    }
}
?>