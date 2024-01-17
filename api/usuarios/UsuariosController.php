<?php
require_once __DIR__ . '/UsuariosService.php';
require_once __DIR__ . '/../utils/ModelValidadorUtils.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $usuariosService = new UsuariosService();
        $ultimaParteCaminho = end(explode('/', trim($_SERVER['REQUEST_URI'], '/')));
        $modelRequest = json_decode(file_get_contents("php://input"));
        if($ultimaParteCaminho == 'criar') {
            validarCorpoRequisicaoRegistro($modelRequest);
            $usuariosService -> registrarUsuario($modelRequest);
        }else {
            validarCorpoRequisicaoLogin($modelRequest);
            return $usuariosService -> autenticarUsuario($modelRequest);
        }
        break;
    default:
        http_response_code(401);
        return json_encode("Método não permitido");
}

?>