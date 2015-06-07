<?php include('cabecalho_admin.php'); ?>
<?php include('navbar_admin.php'); ?>
<script>
	$(document).ready(function () {
    	$('#sessoes').addClass('active');
	})
</script>
<h2>Cadastrar Sessões</h2>
<div class="row">
	<div class="col-md-8">
		<form method="POST" action="funcoes_formularios/cadastra_sessoes.php" >
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
				    	<label for="filme_id">Filme</label>
				        <select class="form-control" name="filme_id" id="filme_id">
					        <?php $filmes_db = new FilmesDB(); ?>
					        <?php if ($filmes = $filmes_db->buscaTodosFilmes()) {
						           for ($i=0; $i < sizeof($filmes); $i++) { 
						           echo "<option value='".$filmes[$i]->getId()."'>";
						           echo $filmes[$i]->getTitulo();
						           echo "</option>";
						        } 
							}?>
				        </select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
				    	<label for="sala_id">Sala</label>
				        <select class="form-control" name="sala_id">
					        <?php $salas_db = new SalasDB(); ?>
					        <?php if ($salas = $salas_db->buscaTodasSalas()) { ?>
					        <?php for ($i=0; $i < sizeof($salas); $i++) { 
					           echo "<option value='".$salas[$i]->getId()."'>";
					           echo $salas[$i]->getNome();
					           echo "</option>";
					        } 
							}?>
			        	</select>
			        </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
				    	<label for="sessao1">Sessão 1</label>
				    	<input name="sessao1" id="sessao1" type="text" class="form-control" />
				    </div>
			    </div>
			    <div class="col-md-3">
				    <div class="form-group">
				    	<label for="sessao2">Sessão 2</label>
				    	<input name="sessao2" id="sessao2" type="text" class="form-control" />
				    </div>
			    </div>
			    <div class="col-md-3">
				    <div class="form-group">
				    	<label for="sessao3">Sessão 3</label>
				    	<input name="sessao3" id="sessao3" type="text" class="form-control" />
				    </div>
			    </div>
			    <div class="col-md-3">
				    <div class="form-group">
				    	<label for="sessao4">Sessão 4</label>
				    	<input name="sessao4" id="sessao4" type="text" class="form-control" />
				    </div>
			    </div>
		    </div>
		    <button type="submit" class="btn btn-success">Cadastrar Sessões</button>
		</form>
	</div>
</div>
<?php include('rodape.php'); ?>