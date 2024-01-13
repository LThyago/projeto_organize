<?php

require __DIR__ . '/api/utils/DatabaseUtils.php';

class UsuariosService {

    private $bancoUtils;

    public function __construct() {
        $this -> bancoUtils = new DatabaseUtils();
    }

    public function registrarUsuario($modelUsuario) {
        $usuarioCriacao = new UsuarioModel($modelUsuario -> nome, 
        $modelUsuario -> login, password_hash($modelUsuario -> senha, PASSWORD_DEFAULT), 
        date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), 'registro_usuario', 'registro_usuario', 0);
        $this -> salvaUsuarioNoBanco($usuarioCriacao);
    }

    public function autenticarUsuario($modelUsuario) {
        return $this -> obtemUsuarioBanco($modelUsuario -> login, 
        password_hash($modelUsuario -> senha, PASSWORD_DEFAULT));
    }

    private function salvaUsuarioNoBanco($model) {
        $query = "SELECT * FROM usuarios WHERE login = '$login';";
        $usuariosBanco = $this -> bancoUtils -> executarConsultaSelectBanco($query);
        if (!empty($usuariosBanco)) throw new BaseException("Usuário já possui cadastro");
        $this -> bancoUtils -> executarConsultaInsertUpdateOuDeleteBanco($query);
    }

    private function obtemUsuarioLoginBanco($login, $senha) {
        $query = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha';";
        $usuariosBanco = $this -> bancoUtils -> executarConsultaSelectBanco($query);
        if (empty($usuariosBanco)) throw new BaseException("Usuario ou senha inválidos");
        return $usuariosBanco;
    }
}
?>