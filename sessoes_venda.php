<?php include('cabecalho_user.php'); ?>
<?php include('navbar_user.php'); ?>
<script>
$(function() {
    $( "#data_sessao" ).datepicker({
    	minDate: 0,
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
  });
</script>
<?php 
$filme_db = new FilmesDB();
$filme = $filme_db->buscaFilmePorId($_GET['filme_id']);

if(isset($_GET['data_sessao'])){
	$data_sessao = $_GET['data_sessao'];
}
?>
<div class="row">
	<div class="col-md-12">
		<h3>Sessões de <?php echo $filme->getTitulo(); if(isset($data_sessao)) echo " - ".$data_sessao; ?></h3>
		<form method="GET" action="<?php $_SERVER['PHP_SELF'] ?>" class="form-inline">
			<div class="form-group">
		       	<label for="data_sessao">Data</label>
		    	<input type="text" class="form-control" id="data_sessao" name="data_sessao" value="<?php if(isset($data_sessao)) echo $data_sessao; ?>" >
		    	<input type="hidden" class="form-control" id="filme_id" name="filme_id" value="<?php echo $filme->getId(); ?>">
		    </div>
		    <button type="submit" class="btn btn-success">Pesquisar</button>
		</form>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-10">
		<div class="col-md-3">
			<img src="imagens/<?php echo $filme->getCartaz(); ?>" />
		</div>
		<?php 
				
			if(isset($data_sessao)){
				$sessoes_db = new SessaoDB();
				if ($sessoes = $sessoes_db->buscaTodasSessoesPorFilmeData((int)$_GET['filme_id'], $data_sessao)){		
		?>
		<div class="col-md-4">
			<table class="table table-hover">
				<?php
					for ($i = 0; $i < sizeof($sessoes); $i++) {
						echo "<tr>";
						echo "<td>";
						echo $sessoes[$i]->getSala()->getNome();
						echo "</td>";
						echo "<td>";
						if ($sessoes[$i]->getDataSessao() == date('Y-m-d') && (int)($sessoes[$i]->getHorario()) < (int)(date('H:i:s'))){
							echo $sessoes[$i]->getHorario();
						}else{
							echo "<a href='venda.php?sessao_id=".$sessoes[$i]->getId()."'>".$sessoes[$i]->getHorario()."</a>";
						}
						echo "<span class='badge pull-right'>". (200 - $sessoes[$i]->getQtdIngressos()) ."</span>";
						echo "</td>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
		<?php 
			}
		}
		?>
	</div>
</div>

<?php include('rodape.php'); ?>