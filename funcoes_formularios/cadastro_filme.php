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

$arqError = $_FILES['cartaz']['error'];
if (!empty($_FILES) && $arqError == 0) {
	$arqTemp = $_FILES['cartaz']['tmp_name'];
	$arqName = $_FILES['cartaz']['name'];
	$pasta = '../imagens/';
	$updload = move_uploaded_file($arqTemp, $pasta.$arqName);

	$filmes_db = new FilmesDB();
	
	$id = $filmes_db->cadastraFilme($_POST['titulo'], $_POST['data_estreia'], $_POST['data_termino'],
			$_POST['genero'], $arqName, $_POST['duracao'], $_POST['ator_principal'],
			$_POST['atriz_principal'], $_POST['ator_coadjuvante'], $_POST['atriz_coadjuvante']);
	
	header('location:../visualiza_filme.php?id='.$id);
}
?>