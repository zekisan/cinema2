<script type="text/javascript">
$(document).ready(function () {
	$("#menu li").removeClass("active");
})
</script>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Cinema</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" id="menu">
        <li id="usuarios"><a href="usuarios.php">Usuários <span class="sr-only">(current)</span></a></li>
        <li id="filmes" ><a href="filmes.php">Filmes</a></li>
        <li id="sessoes" ><a href="sessoes.php">Sessões</a></li>
        <li id="relatorios" ><a href="#">Relatórios</a></li>
      </ul>
    </div>
  </div>
</nav>