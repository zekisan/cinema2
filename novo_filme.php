<?php include('cabecalho.php'); ?>
<?php include('navbar_admin.php'); ?>
<script>
	$(document).ready(function () {
    	$('#filmes').addClass('active');
	})
  $(function() {
    $( "#data_estreia, #data_termino" ).datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
  });

  function visualizarImagem() {
    var leitorArquivo = new FileReader();
    leitorArquivo.readAsDataURL(document.getElementById("cartaz").files[0]);

    leitorArquivo.onload = function (eventoArquivo) {
      document.getElementById("cartaz_filme").src = eventoArquivo.target.result;
    };
  };
</script>
<h2>Novo Filme</h2>
<div class="col-md-8">
  <form enctype="multipart/form-data" method="POST" action="funcoes_formularios/cadastro_filme.php">
    <div class="row">
      <div class="col-md-9">
        <div class="form-group">
          <label for="titulo">Título</label>
          <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="genero">Gênero</label>
          <select class="form-control" name="genero">
          	<?php $generos_db = new GenerosDB(); ?>
            <?php $generos = $generos_db->buscaTodosGeneros(); ?>
            <?php for ($i=0; $i < sizeof($generos); $i++) { 
              echo "<option value='".$generos[$i]["id"]."'>";
              echo $generos[$i]["nome"];
              echo "</option>";
            } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="duracao">Duração</label>
          <input type="text" class="form-control" id="duracao" name="duracao" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="data_estreia">Data de estréia</label>
          <input type="text" class="form-control" id="data_estreia" name="data_estreia" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="data_termino">Data de término</label>
          <input type="text" class="form-control" id="data_termino" name="data_termino" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="ator_principal">Ator principal</label>
          <input type="text" class="form-control" id="ator_principal" name="ator_principal">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="atriz_principal">Atriz principal</label>
          <input type="text" class="form-control" id="atriz_principal" name="atriz_principal">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="ator_coadjuvante">Ator coadjuvante</label>
          <input type="text" class="form-control" id="ator_coadjuvante" name="ator_coadjuvante">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="atriz_coadjuvante">Atriz coadjuvante</label>
          <input type="text" class="form-control" id="atriz_coadjuvante" name="atriz_coadjuvante">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="cartaz">Cartaz</label>
          <input type="file" id="cartaz" name="cartaz" required onchange="visualizarImagem();">
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-success">Cadastrar</button>
  </form>
</div>
<div class="col-md-4">
  <img id="cartaz_filme" src="">
</div>
<?php include('rodape.php'); ?>