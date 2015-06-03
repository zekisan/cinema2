<?php include('db/filmes_db.php'); ?>
<?php include('db/generos_db.php'); ?>
<?php include('cabecalho.php'); ?>
<?php include('navbar_admin.php'); ?>

<?php $filme = buscaFilmePorId($_GET['id']); ?>
<?php $genero = buscaGeneroPorId($filme->getGenero()); ?>

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
  <?php echo $filme->getCartaz(); ?>
</div>

<?php include('rodape.php'); ?>