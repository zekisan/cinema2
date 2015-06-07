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

if (((int)$_POST['qtd_ingressos'] < (200-(int)$_POST['qtd_atual'])) && $sessao_db->vendaIngressos((int)$_POST['sessao_id'], (int)$_POST['qtd_ingressos'], (int)$_POST['qtd_atual'])){
	header('location:../user.php');
}else{
	SessaoSite::setMensagem(array('tipo' => 'danger', 'msg' => 'Quantidade inválida! Verifique a quantidade de ingressos disponíveis para esta sessão.'));
	header('location:../venda.php?sessao_id='.(int)$_POST['sessao_id']);
}

?>