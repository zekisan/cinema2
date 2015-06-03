<?php

class Filme {

  private $id;
  private $titulo;
  private $data_estreia;
  private $data_termino;
  private $genero;
  private $cartaz;
  private $duracao;
  private $ator_principal;
  private $atriz_principal;
  private $ator_coadjuvante;
  private $atriz_coadjuvante;

  //construtor
  public function __construct($id, $titulo, $data_estreia, $data_termino, $genero, $cartaz, $duracao, $ator_principal, $atriz_principal, $ator_coadjuvante, $atriz_coadjuvante)
  {
    $this->id                 = $id;
    $this->titulo             = $titulo;
    $this->data_estreia       = $data_estreia;
    $this->data_termino       = $data_termino;
    $this->genero             = $genero;
    $this->cartaz             = $cartaz;
    $this->duracao            = $duracao;
    $this->ator_principal     = $ator_principal;
    $this->atriz_principal    = $atriz_principal;
    $this->ator_coadjuvante   = $ator_coadjuvante;
    $this->atriz_coadjuvante  = $atriz_coadjuvante;
  }

  //setters
  public function setId($id)
  {
    $this->id = $id;
  }

  public function setTitulo($titulo)
  {
    $this->titulo = $titulo;
  }

  public function setDataEstreia($data_estreia)
  {
    $this->data_estreia = $data_estreia;
  }

  public function setDataTermino($data_termino)
  {
    $this->data_termino = $data_termino;
  }

  public function setGenero($genero)
  {
    $this->genero = $genero;
  }

  public function setCartaz($cartaz)
  {
    $this->cartaz = $cartaz;
  }

  public function setDuracao($duracao)
  {
    $this->duracao = $duracao;
  }

  public function setAtorPrincipal($ator_principal)
  {
    $this->ator_principal = $ator_principal;
  }

  public function setAtrizPrincipal($atriz_principal)
  {
    $this->atriz_principal = $atriz_principal;
  }

  public function setAtorCoadjuvante($ator_coadjuvante)
  {
    $this->ator_coadjuvante = $ator_coadjuvante;
  }

  public function setAtrizCoadjuvante($atriz_coadjuvante)
  {
    $this->atriz_coadjuvante = $atriz_coadjuvante;
  }

  //getters
  public function getId()
  {
      return $this->id;
  }

  public function getTitulo()
  {
    return $this->titulo;
  }

  public function getDataEstreia()
  {
    return $this->data_estreia;
  }

  public function getDataTermino()
  {
    return $this->data_termino;
  }

  public function getGenero()
  {
    return $this->genero;
  }

  public function getCartaz()
  {
    return $this->cartaz;
  }

  public function getDuracao()
  {
    return $this->duracao;
  }

  public function getAtorPrincipal()
  {
    return $this->ator_principal;
  }

  public function getAtrizPrincipal()
  {
    return $this->atriz_principal;
  }

  public function getAtorCoadjuvante()
  {
    return $this->ator_coadjuvante;
  }

  public function getAtrizCoadjuvante()
  {
    return $this->atriz_coadjuvante;
  }
}
?>