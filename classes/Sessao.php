<?php
class Sessao {
	private $id;
	private $horario;
	private $data_sessao;
	private $qtd_ingressos;
	private $filme_id;
	private $sala_id;
	
	//construtor
	public function __construct($id, $horario, $data_sessao, $qtd_ingressos, $filme_id, $sala_id)
	{
		$this->id   = $id;
		$this->horario = $horario;
		$this->data_sessao   = $data_sessao;
		$this->qtd_ingressos = $qtd_ingressos;
		$this->filme_id   = $filme_id;
		$this->sala_id = $sala_id;
	}
	
	//setters
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function setHorario($horario)
	{
		$this->horario = $horario;
	}
	
	public function setDataSessao($data_sessao)
	{
		$this->data_sessao = $data_sessao;
	}
	
	public function setHorario($nome)
	{
		$this->horario = $horario;
	}
	
	public function setQtdIngressos($qtd_ingressos)
	{
		$this->qtd_ingressos = $qtd_ingressos;
	}
	
	public function setFilmeId($filme_id)
	{
		$this->filme_id   = $filme_id;
	}
	
	public function setFilmeId($sala_id)
	{
		$this->sala_id = $sala_id;
	}
	
	//getters
	public function getId()
	{
		return $this->id;
	}
	
	public function getHorario()
	{
		return $this->horario;
	}
	
	public function getDataSessao()
	{
		return $this->data_sessao;
	}
	
	public function getQtdIngressos()
	{
		return $this->qtd_ingressos;
	}
	
	public function getFilmeId()
	{
		return $this->filme_id;
	}
	
	public function getSalaId()
	{
		return $this->sala_id;
	}
}