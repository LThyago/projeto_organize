<?php
require_once __DIR__ . '/../basemodel/BaseException.php';

function obterInformacoesCabecalhoAutorizacao(){
    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        list($usuario, $senha) = explode(':', base64_decode(str_replace('Basic ', '', $_SERVER['HTTP_AUTHORIZATION'])));
        return ['login' => $usuario, 'senha' => $senha];
    } else {
        throw new ExcecaoBase("Cabeçalho de autorização não encontrado");
    }
}

?>