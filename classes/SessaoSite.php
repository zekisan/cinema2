<?php
class SessaoSite {
	
	static function registrarSessao(Usuario $usuario) {
		if (isset($usuario)) {
			SessaoSite::iniciaSessao();
			$_SESSION['usuario'] = $usuario;
			$_SESSION['logado'] = true;
		}
	}
	
	static function isLogado() {
		SessaoSite::iniciaSessao();
		return isset($_SESSION['logado']);
	}
	
	static function getUsuario() {
		SessaoSite::iniciaSessao();
		return $_SESSION['usuario'];
	}
	
	static function encerrarSessao() {
		SessaoSite::iniciaSessao();
		unset($_SESSION['usuario']);
		unset($_SESSION['logado']);
		session_destroy("logado");
	}
	
	static private function iniciaSessao() {
		if(SessaoSite::sessao_foi_iniciada() === FALSE) {
			session_start("logado");
		}
	}
	
	static public function setMensagem($msg) {
		SessaoSite::iniciaSessao();
		$_SESSION['mensagem'] = $msg;
	}
	
	static public function deletaMensagem() {
		SessaoSite::iniciaSessao();
		unset($_SESSION['mensagem']);
	}
	
	static public function possuiMensagem() {
		SessaoSite::iniciaSessao();
		return isset($_SESSION['mensagem']);
	}
	
	static public function getMensagem() {
		SessaoSite::iniciaSessao();
		return $_SESSION['mensagem'];
	}
	
	static private function sessao_foi_iniciada() {
		if ( php_sapi_name() !== 'cli' ) {
			if ( version_compare(phpversion(), '5.4.0', '>=') ) {
				return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
			} else {
				return session_id() === '' ? FALSE : TRUE;
			}
		}
		return FALSE;
	}
	
}