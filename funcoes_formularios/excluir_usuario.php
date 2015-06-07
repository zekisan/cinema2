<?php 
function __autoload($arquivo)
{
	if (file_exists("../classes/".$arquivo.".php")) {
		include_once("../classes/".$arquivo.".php");
	}else if(file_exists("../db/".$arquivo.".php")){
		include_once("../db/".$arquivo.".php");
	}
	else{
		throw new Exception('Unable to load class named $arquivo');
	}
}

$usuario_db = new UsuarioDB();

if ($usuario_db->excluirUsuario((int)$_POST['id_usuario'])){
	header('location:../usuarios.php');
}
?>