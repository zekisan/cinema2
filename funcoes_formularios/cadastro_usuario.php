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

$id = $usuario_db->insereUsuario($_POST['nome'], $_POST['papel_id'], $_POST['login'], $_POST['senha']);

header('location:../visualiza_usuario.php?id='.$id);
?>