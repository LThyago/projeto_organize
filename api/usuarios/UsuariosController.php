<?php
require_once __DIR__ . '/UsuariosService.php';
require_once __DIR__ . '/../utils/ModelValidadorUtils.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        try{
            $usuariosService = new UsuariosService();
            $ultimaParteCaminho = end(explode('/', trim($_SERVER['REQUEST_URI'], '/')));
            $modelRequest = json_decode(file_get_contents("php://input"));
            if($ultimaParteCaminho == 'criar') {
                validarCorpoRequisicaoRegistro($modelRequest);
                $usuariosService -> registrarUsuario($modelRequest);
                die();
            }else if($ultimaParteCaminho == 'login'){
                validarCorpoRequisicaoLogin($modelRequest);
                header('Content-Type: application/json');
                die(json_encode($usuariosService -> autenticarUsuario($modelRequest), JSON_UNESCAPED_UNICODE));
            }
        }catch(Exception $e){
            http_response_code(401);
            header('Content-Type: application/json');
            die(json_encode(['mensagem' => $e -> getMessage()], JSON_UNESCAPED_UNICODE));
        }
        break;
    default:
        header('Content-Type: application/json');
        http_response_code(401);
        die(json_encode(['mensagem' => "Método não permitido"], JSON_UNESCAPED_UNICODE));
}

header('Content-Type: application/json');
http_response_code(401);
die(json_encode(['mensagem' => "Endpoint não encontrado"], JSON_UNESCAPED_UNICODE));

?>