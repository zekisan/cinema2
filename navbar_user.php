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
      <a class="navbar-brand" href="user.php">Cinema</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" id="menu">
        <li id="usuarios"><a href="usuarios.php">Usuários <span class="sr-only">(current)</span></a></li>
        <li id="filmes" ><a href="filmes.php">Filmes</a></li>
        <li id="sessoes" ><a href="sessoes.php">Sessões</a></li>
        <li id="relatorios" ><a href="#">Relatórios</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Olá, <?php echo SessaoSite::getUsuario()->getNome(); ?></a></li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span></a>
        	<ul class="dropdown-menu" role="menu">
            <li><a href="#">Editar perfil<span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span></a></li>
            <li class="divider"></li>
            <li><a href="funcoes_formularios/logout.php">Logout<span class="glyphicon glyphicon-off pull-right" aria-hidden="true"></span></a></li>
          </ul>
      	</li>
      </ul>
    </div>
  </div>
</nav>