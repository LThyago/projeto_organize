<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request){
    case '/api/usuarios/criar':
        require_once __DIR__ . '/api/usuarios/UsuariosController.php';
        break;
    case '/api/usuarios/login':
        require_once __DIR__ . '/api/usuarios/UsuariosController.php';
        break;
    case '/api/tarefas/criar':
        require_once __DIR__ . '/api/tarefas/TarefasController.php';
        break;
    case '/api/tarefas/listar-por-categoria':
        require_once __DIR__ . '/api/tarefas/TarefasController.php';
        break;
    case '/api/tarefas/atualizar':
        require_once __DIR__ . '/api/tarefas/TarefasController.php';
        break;
    case '/api/tarefas/deletar':
        require_once __DIR__ . '/api/tarefas/TarefasController.php';
        break;
    case '/api/categorias/criar':
        require_once __DIR__ . '/api/categorias/CategoriasController.php';
        break;
    case '/api/categorias/listar':
        require_once __DIR__ . '/api/categorias/CategoriasController.php';
        break;
    case '/api/categorias/atualizar':
        require_once __DIR__ . '/api/categorias/CategoriasController.php';
        break;
    case '/api/categorias/deletar':
        require_once __DIR__ . '/api/categorias/CategoriasController.php';
        break;
    default:
        http_response_code(404);
        return json_encode("Recurso não encontrado");
}

?>