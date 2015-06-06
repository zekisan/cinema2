<?php include('cabecalho_user.php'); ?>
<?php include('navbar_user.php'); ?>

<h2>Filmes em Cartaz</h2>
<?php 

$filmes_db = new FilmesDB();
if ($filmes = $filmes_db->buscaFilmesEmCartaz()){
?>
<div class="row">
<?php 
	for ($i = 0; $i < sizeof($filmes); $i++) {
		echo "<div class='col-md-4'>";
		file_put_contents($filmes[$i]->getTitulo().".jpg",$filmes[$i]->getCartaz());
		echo "<p><a href='sessoes_venda.php?data_sessao=".date('d/m/Y')."&filme_id=".$filmes[$i]->getId()."'><img src='imagens/".$filmes[$i]->getCartaz()."' /></a></p>";
		echo "<p>";
		echo "<a href='sessoes_venda.php?data_sessao=".date('d/m/Y')."&filme_id=".$filmes[$i]->getId()."'>".$filmes[$i]->getTitulo()."</a>";
		echo "</p>";
	}
?>
</div>
<?php
}

?>
<?php include('rodape.php'); ?>