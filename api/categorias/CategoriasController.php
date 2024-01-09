<?php

include '../basemodel/BaseModel.php';

$baseModel = new BaseModel();
$baseModel -> setDataCriacao("TesteHoje");
$baseModel -> setDataAlteracao("TesteNovamenteHoje");
$baseModel -> setCriadoPor("Mais um teste criado por");
$baseModel -> setAlteradoPor("Outro teste alterado por");
$baseModel -> setDeletado(false);

echo json_encode($baseModel);

?>