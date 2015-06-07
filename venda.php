<?php include('cabecalho_user.php'); ?>
<?php include('navbar_user.php'); ?>
<?php include('mensagem.php'); ?>
<h3>Venda de ingressos</h3>

<?php 

$sessao_db = new SessaoDB();
if ($sessao = $sessao_db->buscaSessaoPorId((int)$_GET['sessao_id'])){
?>
<div class="row">
	<div class="col-md-3">
		<b>Filme: </b> <?php echo $sessao->getFilme()->getTitulo(); ?>
		<br>
		<b>Data: </b> <?php echo date("d/m/Y", strtotime($sessao->getDataSessao())); ?>
		<br>
		<b>Horário: </b> <?php echo $sessao->getHorario(); ?>
		<br>
		<b>Sala: </b> <?php echo $sessao->getSala()->getNome(); ?>
		<br>
		<b>Ingressos disponíveis: </b> <?php echo (200 - $sessao->getQtdIngressos()); ?>
	</div>
	<div class="col-md-5">
		<form action="funcoes_formularios/efetua_venda.php" method="POST" class="form-inline">
			<div class="form-group">
		    	<label for="qtd_ingressos">Qtd. Ingressos</label>
		    	<input type="number" class="form-control" id="qtd_ingressos" name="qtd_ingressos">
		    	<input type="hidden" name="sessao_id" id="sessao_id" value="<?php echo $sessao->getId(); ?>" >
		    	<input type="hidden" name="qtd_atual" id="qtd_atual" value="<?php echo $sessao->getQtdIngressos(); ?>" >
		  	</div>
			<button type="submit" class="btn btn-success">Finalizar</button>
		</form>
	</div>
</div>
<?php
}

?>

<?php include('rodape.php'); ?>