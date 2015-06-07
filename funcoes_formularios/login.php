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

if ($usuario_db->login($_POST['usuario'], $_POST['senha'])){
	switch (SessaoSite::getUsuario()->getPapel()->getNome()) {
		case 'Administrador':
			header('location:../admin.php');
		break;
		case 'Usuário':
			header('location:../user.php');
		break;
	}
}
else{
	header('location:../index.php');
}
?>