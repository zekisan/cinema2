<?php include('cabecalho_admin.php'); ?>
<?php include('navbar_admin.php'); ?>
<?php include('mensagem.php'); ?>
<?php 
$filmes_db = new FilmesDB();
$generos_db = new GenerosDB();
$filme = $filmes_db->buscaFilmePorId($_GET['id']);
$genero = $generos_db->buscaGeneroPorId($filme->getGenero()); 

?>

<h2><?php echo $filme->getTitulo(); ?></h2>
<div class="col-md-6">
  <h4><?php echo $genero->getNome(); ?></h4>
  <p><b>Duração: </b><?php echo $filme->getDuracao(); ?></p>
  <p><b>Data de estréia: </b><?php echo date("d/m/Y", strtotime($filme->getDataEstreia())); ?></p>
  <p><b>Data de término: </b><?php echo date("d/m/Y", strtotime($filme->getDataTermino())); ?></p>
  <p><b>Ator principal: </b><?php echo $filme->getAtorPrincipal(); ?></p>
  <p><b>Atriz principal: </b><?php echo $filme->getAtrizPrincipal(); ?></p>
  <p><b>Ator coadjuvante: </b><?php echo $filme->getAtorCoadjuvante(); ?></p>
  <p><b>Atriz coadjuvante: </b><?php echo $filme->getAtrizCoadjuvante(); ?></p>
</div>
<div class="col-md-6">
  <img src="imagens/<?php echo $filme->getCartaz(); ?>" />
</div>

<?php include('rodape.php'); ?>