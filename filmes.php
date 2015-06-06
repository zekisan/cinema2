<?php include('cabecalho_admin.php'); ?>
<?php include('navbar_admin.php'); ?>
<script type="text/javascript">
	$(document).ready(function () {
	    $('#filmes').addClass('active');
	})
</script>
<h2>Filmes</h2>
<a class="btn btn-primary" href="novo_filme.php" role="button">Novo Filme</a>
<table class="table table-hover">
  <thead>
  	<th>Título</th>
  	<th>Data estréia</th>
  	<th>Data término</th>
  </thead>
  <tbody>
  	<?php 
  		$filmes_db = new FilmesDB();
		$filmes = $filmes_db->buscaTodosFilmes();
		for ($i = 0; $i < sizeof($filmes); $i++){
			echo "<tr>";
			echo "<td>";
			echo "<a href='/cinema2/visualiza_filme.php?id=".$filmes[$i]->getId()."'>";
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
<?php include('rodape.php'); ?>