<?php include('cabecalho_admin.php'); ?>
<?php include('navbar_admin.php'); ?>
<script type="text/javascript">
	$(document).ready(function () {
	    $('#sessoes').addClass('active');
	})
</script>
<?php 
if (!empty($_GET)) {
	$filme_id = (int)$_GET['filme_id'];
  	$sessao_db = new SessaoDB();
	
	if ($sessoes = $sessao_db->buscaTodasSessoesPorFilme($filme_id)){
?>
<table class="table table-hover">
  <thead>
  	<th>Filme</th>
  	<th>Data</th>
  	<th>Horário</th>
  	<th>Ingressos Vendidos</th>
  	<th>Sala</th>
  </thead>
  <tbody>
<?php
		//var_dump($sessoes);
		for ($i = 0; $i < sizeof($sessoes); $i++) {
			echo "<tr>";
				echo "<td>";
				echo $sessoes[$i]->getFilme()->getTitulo();
				echo "</td>";
				echo "<td>";
				echo  date("d/m/Y", strtotime($sessoes[$i]->getDataSessao()));
				echo "</td>";
				echo "<td>";
				echo $sessoes[$i]->getHorario();
				echo "</td>";
				echo "<td>";
				echo $sessoes[$i]->getQtdIngressos();
				echo "</td>";
				echo "<td>";
				echo $sessoes[$i]->getSala()->getNome();
				echo "</td>";
			echo "</tr>";
		}//end for
?>
	</tbody>
</table>
<?php 
}//end if
}//end if
?>
<?php include('rodape.php'); ?>