<?php include('cabecalho_admin.php'); ?>
<?php include('navbar_admin.php'); ?>
<script type="text/javascript">
	$(document).ready(function () {
	    $('#usuarios').addClass('active');
	})
</script>
<?php include('mensagem.php'); ?>
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
  	<th></th>
  	<th></th>
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
  		echo "<td>";
  		echo "<a href='editar_usuario.php?id=".$usuarios[$i]->getId()."' class='btn btn-primary'>Editar</a>";
  		echo "</td>";
  		echo "<td>";
  		echo "<form method='POST' action='funcoes_formularios/excluir_usuario.php'>";
  		echo "<input type='hidden' value='".$usuarios[$i]->getId()."' name='id_usuario' id='id_usuario'>";
  		echo "<button type='submit' class='btn btn-primary'>Excluir</button>";
  		echo "</form>";
  		echo "</td>";
  		echo "</tr>";
  	}
  ?>
  </tbody>
</table>
<?php } ?>
<?php include('rodape.php'); ?>