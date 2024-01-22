<?php
require_once __DIR__ . '/../basemodel/BaseException.php';

function obterInformacoesCabecalhoAutorizacao(){
    $headers = getallheaders();
    if (isset($headers['Authorization'])) {
        list($usuario, $senha) = explode(':', base64_decode(str_replace('Basic ', '', $headers['Authorization'])));
        return ['login' => $usuario, 'senha' => $senha];
    } else {
        throw new ExcecaoBase("Cabeçalho de autorização não encontrado");
    }
}

?>