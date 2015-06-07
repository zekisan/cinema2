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

$filme_db = new FilmesDB();
$sessao_db = new SessaoDB();

if (!$sessao_db->jaPassou((int)$_POST['id_filme']) && $filme_db->excluirFilme((int)$_POST['id_filme'])){
	unlink("../imagens/".$_POST['cartaz']);
	header('location:../filmes.php');
}
header('location:../filmes.php');

?>