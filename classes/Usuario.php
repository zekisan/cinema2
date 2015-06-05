<?php
class Usuario {
	private $id;
	private $nome;
	private $papel;
	private $login;
	private $senha;
	
	//construtor
	public function __construct($id, $nome, $papel, $login, $senha)
	{
		$this->id   = $id;
		$this->nome = $nome;
		$this->papel = $papel;
		$this->login = $login;
		$this->senha = $senha;
	}
	
	//setters
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function setNome($nome)
	{
		$this->nome = $nome;
	}
	
	public function setPapel($papel)
	{
		$this->papel = $papel;
	}
	
	public function setLogin($login)
	{
		$this->login = $login;
	}
	
	public function setSenha($senha)
	{
		$this->senha = $senha;
	}
	
	//getters
	public function getId()
	{
		return $this->id;
	}
	
	public function getNome()
	{
		return $this->nome;
	}
	
	public function getPapel()
	{
		return $this->papel;
	}
	
	public function getLogin()
	{
		return $this->login;
	}
	
	public function getSenha()
	{
		return $this->senha;
	}
}