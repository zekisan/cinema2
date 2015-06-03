<?php

class Genero {

  private $id;
  private $nome;

  //construtor
  public function __construct($id, $nome)
  {
    $this->id   = $id;
    $this->nome = $nome;
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

  //getters
  public function getId()
  {
      return $this->id;
  }

  public function getNome()
  {
    return $this->nome;
  }
}
?>