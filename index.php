<?php 
function __autoload($arquivo)
{
	if (file_exists("classes/".$arquivo.".php")) {
		include_once("classes/".$arquivo.".php");
	}else if(file_exists("db/".$arquivo.".php")){
		include_once("db/".$arquivo.".php");
		die();
	}
	else{
		throw new Exception('Unable to load class named $arquivo');
	}
}
?>
<?php include('cabecalho.php'); ?>
<?php include('navbar_admin.php'); ?>
<?php include('rodape.php'); ?>