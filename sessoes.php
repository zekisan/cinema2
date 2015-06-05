<?php include('cabecalho.php'); ?>
<?php include('navbar_admin.php'); ?>
<script type="text/javascript">
	$(document).ready(function () {
	    $('#sessoes').addClass('active');
	})
</script>
<h2>Sessões</h2>
<a class="btn btn-primary" href="nova_sessao.php" role="button">Nova Sessao</a>

<?php 
	$filmes_db = new FilmesDB();
	
	if ($filmes = $filmes_db->buscaTodosFilmes()){
	?>
<table class="table table-hover">
  <thead>
  	<th>Filme</th>
  	<th>Data estréia</th>
  	<th>Data término</th>
  </thead>
  <tbody>
  	<?php
		for ($i = 0; $i < sizeof($filmes); $i++){
			echo "<tr>";
			echo "<td>";
			echo "<a href='/cinema2/visualiza_sessoes.php?filme_id=".$filmes[$i]->getId()."'>";
			echo $filmes[$i]->getTitulo();
			echo "</a>";
			echo "</td>";
			echo "<td>";
			echo date("d/m/Y", strtotime($filmes[$i]->getDataEstreia()));
			echo "</td>";
			echo "<td>";
			echo date("d/m/Y", strtotime($filmes[$i]->getDataTermino()));
			echo "</td>";
			echo "</tr>"; 
		}
  	?>
  </tbody>
</table>
<?php } ?>
<?php include('rodape.php'); ?>