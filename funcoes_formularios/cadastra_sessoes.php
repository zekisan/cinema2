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

$sessao_db = new SessaoDB();

$sessao_db->cadastraSessao($_POST['filme_id'], $_POST['sala_id'], [$_POST['sessao1'],
		$_POST['sessao2'], $_POST['sessao3'], $_POST['sessao4']]);

header('location:../visualiza_sessoes.php?filme_id='.$_POST['filme_id']);
?>