<?php
require_once __DIR__ . '/../basemodel/BaseException.php';

function validarCorpoRequisicaoRegistro($model) {
    if(!(isset($model) && isset($model -> nome) 
    && isset($model -> login) 
    && isset($model -> senha)
    && $model -> nome !== null
    && $model -> login !== null
    && $model -> senha !== null)) throw new ExcecaoBase('O corpo da requisição não é válido');
}

function validarCorpoRequisicaoLogin($model) {
    if (!(isset($model) && isset($model -> login) 
    && isset($model -> senha) 
    && $model -> login !== null
    && $model -> senha !== null)) throw new ExcecaoBase('O corpo da requisição não é válido');
}
?>