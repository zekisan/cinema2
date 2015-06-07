<?php 
function __autoload($arquivo)
{
	if (file_exists("classes/".$arquivo.".php")) {
		include_once("classes/".$arquivo.".php");
	}else if(file_exists("db/".$arquivo.".php")){
		include_once("db/".$arquivo.".php");
	}
	else{
		throw new Exception('Unable to load class named $arquivo');
	}
}

if (SessaoSite::isLogado()){
	switch (SessaoSite::getUsuario()->getPapel()->getNome()) {
		case 'Administrador':
		header('location:admin.php');
		break;
		case 'Usuário':
		header('location:user.php');
		break;
	}
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" context="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <title>Cinema</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="js/jqueryui/jquery-ui.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="js/jqueryui/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
    	body {
		  padding-top: 40px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}
		
		.form-login {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-login .form-login-cabecalho,
		.form-login .checkbox {
		  margin-bottom: 10px;
		}
		.form-login .checkbox {
		  font-weight: normal;
		}
		.form-login .form-control {
		  position: relative;
		  height: auto;
		  -webkit-box-sizing: border-box;
		     -moz-box-sizing: border-box;
		          box-sizing: border-box;
		  padding: 10px;
		  font-size: 16px;
		}
		.form-login .form-control:focus {
		  z-index: 2;
		}
		.form-login input[type="text"] {
		  margin-bottom: -1px;
		  border-bottom-right-radius: 0;
		  border-bottom-left-radius: 0;
		}
		.form-login input[type="password"] {
		  margin-bottom: 10px;
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		}	
    </style>
</head>
<body>
  <div class="container">
  	<form class="form-login" method="POST" action="funcoes_formularios/login.php">
        <h2 class="form-login-cabecalho">Login</h2>
        <label for="usuario" class="sr-only">Usuário</label>
        <input type="text" id="usuario" class="form-control" placeholder="Usuário" required="" autofocus="" name="usuario">
        <label for="senha" class="sr-only">Senha</label>
        <input type="password" id="senha" class="form-control" placeholder="Senha" required="" name="senha">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>
  </div>
 </body>
 </html>