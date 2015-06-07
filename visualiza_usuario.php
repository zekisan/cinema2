<?php include('cabecalho_admin.php'); ?>
<?php include('navbar_admin.php'); ?>
<script type="text/javascript">
	$(document).ready(function () {
	    $('#usuarios').addClass('active');
	})
</script>
<?php 
$usuario_db = new UsuarioDB();
$usuario = $usuario_db->buscaUsuarioPorId($_GET['id']);

?>
<?php include('mensagem.php'); ?>
<h2><?php echo $usuario->getNome(); ?></h2>
<div class="col-md-6">
  <p><b>Papel: </b><?php echo $usuario->getPapel()->getNome(); ?></p>
  <p><b>Usuário: </b><?php echo $usuario->getLogin(); ?></p>
</div>
<?php include('rodape.php'); ?>