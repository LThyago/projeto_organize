<?php
$baseModel = new BaseModel();
$baseModel.setDataCriacao("TesteHoje");
$baseModel.setDataAlteracao("TesteNovamenteHoje");
$baseModel.setCriadoPor("Mais um teste criado por");
$baseModel.setAlteradoPor("Outro teste alterado por");
$baseModel.setDeletado(false);

print_r($baseModel);

?>