<?php

$con = null;

function abreConexao(){
  global $con;
  // Conecta-se ao banco de dados MySQL
  $con = mysqli_connect('localhost', 'root', '', 'cinema');

  // Caso algo tenha dado errado, exibe uma mensagem de erro
  if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
  mysqli_query($con, "SET CHARACTER SET 'utf8'");
  return $con;
}

function fechaConexao(){
  global $con;
  mysqli_close($con);
}

?>