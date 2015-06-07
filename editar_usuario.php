<?php include('cabecalho_admin.php'); ?>
<?php include('navbar_admin.php'); ?>
<script type="text/javascript">
	$(document).ready(function () {
	    $('#usuarios').addClass('active');
	})
</script>
<?php 
$usuario_db = new UsuarioDB();
$usuario = $usuario_db->buscaUsuarioPorId((int)$_GET['id']);
?>
<h2>Editar Usuário</h2>
<div class="row">
	<div class="col-md-8">
		<form method="POST" action="funcoes_formularios/editar_usuario.php" >
			<div class="row">
				<div class="col-md-9">
					<div class="form-group">
				    	<label for="nome">Nome</label>
				    	<input name="nome" id="nome" type="text" class="form-control" required value="<?php echo $usuario->getNome(); ?>" />
				    	<input name="id_usuario" id="id_usuario" type="hidden" value="<?php echo $usuario->getId(); ?>"/>
				    </div>
			    </div>
		    	<div class="col-md-3">
				    <div class="form-group">
				    	<label for="papel_id">Papel</label>
				        <select class="form-control" name="papel_id">
					        <?php $papeis_db = new PapelDB(); ?>
					        <?php if ($papeis = $papeis_db->buscaTodosPapeis()) { ?>
					        <?php for ($i=0; $i < sizeof($papeis); $i++) { 
					           echo "<option value='".$papeis[$i]->getId()."' ";
					           if ($usuario->getPapel()->getId() == ($i + 1))
					           	echo "selected='selected'";
					           echo ">";
					           echo $papeis[$i]->getNome();
					           echo "</option>";
					        } 
							}?>
				    	</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
				    	<label for="login">Usuário</label>
				    	<input name="login" id="login" type="text" class="form-control" required  value="<?php echo $usuario->getLogin(); ?>" />
				    </div>
				    <div class="form-group">
				    	<label for="senha">Senha</label>
				    	<input name="senha" id="senha" type="password" class="form-control" required value="<?php echo $usuario->getSenha(); ?>" />
				    </div>
			    </div>
		    </div>
		    <button type="submit" class="btn btn-success">Salvar</button>
		</form>
	</div>
</div>
<?php include('rodape.php'); ?>