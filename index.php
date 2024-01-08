<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request){
    case '/api/usuarios/criar':
        require __DIR__ . '/api/usuarios/UsuariosController.php';
        break;
    case '/api/usuarios/login':
        require __DIR__ . '/api/usuarios/UsuariosController.php';
        break;
    case '/api/usuarios/deletar':
        require __DIR__ . '/api/usuarios/UsuariosController.php';
        break;
    case '/api/tarefas/criar':
        require __DIR__ . '/api/tarefas/TarefasController.php';
        break;
    case '/api/tarefas/listar-por-categoria':
        require __DIR__ . '/api/tarefas/TarefasController.php';
        break;
    case '/api/tarefas/atualizar':
        require __DIR__ . '/api/tarefas/TarefasController.php';
        break;
    case '/api/tarefas/deletar':
        require __DIR__ . '/api/tarefas/TarefasController.php';
        break;
    case '/api/categorias/criar':
        require __DIR__ . '/api/categorias/CategoriasController.php';
        break;
    case '/api/categorias/listar':
        require __DIR__ . '/api/categorias/CategoriasController.php';
        break;
    case '/api/categorias/atualizar':
        require __DIR__ . '/api/categorias/CategoriasController.php';
        break;
    case '/api/categorias/deletar':
        require __DIR__ . '/api/categorias/CategoriasController.php';
        break;
    default:
        http_response_code(404);
        return json_encode("Recurso não encontrado");
}

?>