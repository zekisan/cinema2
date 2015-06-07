<?php 
if (SessaoSite::possuiMensagem()) {
	$msg = SessaoSite::getMensagem();
	echo "<div class='alert alert-".$msg['tipo']."' role='alert'>".$msg['msg']."</div>";
	SessaoSite::deletaMensagem();
}
?>