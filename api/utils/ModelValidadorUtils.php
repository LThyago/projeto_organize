<?php
require_once __DIR__ . '/../basemodel/BaseException.php';

function validarCorpoRequisicaoRegistro($model) {
    if(!(isset($model) && isset($model -> nome) 
    && isset($model -> login) 
    && isset($model -> senha))) throw new ExcecaoBase('O corpo da requisição não é válido');
}

function validarCorpoRequisicaoLogin($model) {
    if (!(isset($model) && isset($model -> login) 
    && isset($model -> senha))) throw new ExcecaoBase('O corpo da requisição não é válido');
}

function validarCorpoRequisicaoCriacaoCategoria($model) {
    if (!(isset($model) && isset($model -> titulo) 
    && isset($model -> descricao))) throw new ExcecaoBase('O corpo da requisição não é válido');
}

function validarCorpoRequisicaoAtualizacaoCategoria($model) {
    if (!(isset($model) && isset($model -> id) 
    && isset($model -> titulo) 
    && isset($model -> descricao))) throw new ExcecaoBase('O corpo da requisição não é válido');
}

function validarPresencaVariavelQuery($var) {
    if(!isset($var)) Throw new ExcecaoBase('Variável de query não informada');
}

function validarCorpoRequisicaoCriacaoTarefa($model) {
    if (!(isset($model) && isset($model -> titulo) 
    && property_exists($model, 'descricao') 
    && property_exists($model, 'dataLimite') 
    && isset($model -> idCategoria))) throw new ExcecaoBase('O corpo da requisição não é válido');
}

function validarCorpoRequisicaoAtualizacaoTarefa($model) {
    if (!(isset($model) && isset($model -> id) 
    && isset($model -> titulo) 
    && property_exists($model, 'descricao') 
    && property_exists($model, 'dataLimite') 
    && isset($model -> status))) throw new ExcecaoBase('O corpo da requisição não é válido');
}

?>