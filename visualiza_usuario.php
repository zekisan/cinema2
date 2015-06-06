<?php include('cabecalho.php'); ?>
<?php include('navbar_admin.php'); ?>

<?php 
$usuario_db = new UsuarioDB();
$usuario = $usuario_db->buscaUsuarioPorId($_GET['id']);

?>

<h2><?php echo $usuario->getNome(); ?></h2>
<div class="col-md-6">
  <p><b>Papel: </b><?php echo $usuario->getPapel()->getNome(); ?></p>
  <p><b>Usuário: </b><?php echo $usuario->getLogin(); ?></p>
</div>
<?php include('rodape.php'); ?>