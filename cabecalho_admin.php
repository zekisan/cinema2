<?php 
function __autoload($arquivo)
{
	if (file_exists("classes/".$arquivo.".php")) {
		include_once("classes/".$arquivo.".php");
	}else if(file_exists("db/".$arquivo.".php")){
		include_once("db/".$arquivo.".php");
	}
	else{
		throw new Exception('Unable to load class named $arquivo');
	}
	date_default_timezone_get();
}

if(!SessaoSite::isLogado() || SessaoSite::getUsuario()->getPapel()->getNome() != 'Administrador'){
	header('location:index.php');
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" context="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <title>Cinema - Administração</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="js/jqueryui/jquery-ui.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="js/jqueryui/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">