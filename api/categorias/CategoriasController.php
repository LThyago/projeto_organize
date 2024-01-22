<?php
require_once __DIR__ . '/../usuarios/UsuariosService.php';
require_once __DIR__ . '/CategoriasService.php';
require_once __DIR__ . '/../utils/ModelValidadorUtils.php';
require_once __DIR__ . '/../utils/RequestUtils.php';
try {
    $usuariosService = new UsuariosService();
    $categoriasService = new CategoriasService();
    $usuarioRequisicaoModel = $usuariosService -> validarCredenciaisUsuario(obterInformacoesCabecalhoAutorizacao());
    $ultimaParteCaminho = end(explode('/', trim($_SERVER['REQUEST_URI'], '/')));
}catch(Exception $e) {
    http_response_code(401);
    header('Content-Type: application/json');
    die(json_encode(['mensagem' => $e -> getMessage()], JSON_UNESCAPED_UNICODE));
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        try{
            $modelRequest = json_decode(file_get_contents("php://input"));
            if($ultimaParteCaminho == 'criar') {
                validarCorpoRequisicaoCriacaoCategoria($modelRequest);
                $categoriasService -> cadastrarCategoria($modelRequest, $usuarioRequisicaoModel);
                die();
            }
        }catch(Exception $e){
            http_response_code(401);
            header('Content-Type: application/json');
            die(json_encode(['mensagem' => $e -> getMessage()], JSON_UNESCAPED_UNICODE));
        }
        break;
    case 'GET':
        try{
            if($ultimaParteCaminho == 'listar') {
                header('Content-Type: application/json');
                die(json_encode(["categorias" => $categoriasService -> listarCategoriasDoUsuario($usuarioRequisicaoModel)], JSON_UNESCAPED_UNICODE));
                die();
            }
        }catch(Exception $e){
            http_response_code(401);
            header('Content-Type: application/json');
            die(json_encode(['mensagem' => $e -> getMessage()], JSON_UNESCAPED_UNICODE));
        }
        break;
    case 'PUT':
        try{
            $modelRequest = json_decode(file_get_contents("php://input"));
            if($ultimaParteCaminho == 'atualizar') {
                validarCorpoRequisicaoAtualizacaoCategoria($modelRequest);
                $categoriasService -> atualizarCategoria($modelRequest, $usuarioRequisicaoModel);
                die();
            }
        }catch(Exception $e){
            http_response_code(401);
            header('Content-Type: application/json');
            die(json_encode(['mensagem' => $e -> getMessage()], JSON_UNESCAPED_UNICODE));
        }
        break;
    case 'DELETE':
        try{
            if($ultimaParteCaminho == 'deletar') {
                $idDeletar = $_GET['id'];
                validarPresencaVariavelQuery($idDeletar);
                $categoriasService -> deletarCategoria($idDeletar, $usuarioRequisicaoModel);
                die();
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