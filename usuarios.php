<?php include('cabecalho_admin.php'); ?>
<?php include('navbar_admin.php'); ?>
<script type="text/javascript">
	$(document).ready(function () {
	    $('#usuarios').addClass('active');
	})
</script>
<h2>Usuários</h2>
<a class="btn btn-primary" href="novo_usuario.php" role="button">Novo Usuário</a>
<?php 
	$usuarios_db = new UsuarioDB();
	if ($usuarios = $usuarios_db->buscaTodosUsuarios()){
?>
<table class="table table-hover">
  <thead>
  	<th>Nome</th>
  	<th>Papel</th>
  	<th>Login</th>
  </thead>
  <tbody>
  <?php 
  	for ($i = 0; $i < sizeof($usuarios); $i++) {
  		echo "<tr>";
  		echo "<td>";
  		echo "<a href='visualiza_usuario.php?id=".$usuarios[$i]->getId()."'>";
  		echo $usuarios[$i]->getNome();
  		echo "</a>";
  		echo "</td>";
  		echo "<td>";
  		echo $usuarios[$i]->getPapel()->getNome();
  		echo "</td>";
  		echo "<td>";
  		echo $usuarios[$i]->getLogin();
  		echo "</td>";
  		echo "</tr>";
  	}
  ?>
  </tbody>
</table>
<?php } ?>
<?php include('rodape.php'); ?>