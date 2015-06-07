<?php
class Sessao {
	private $id;
	private $horario;
	private $data_sessao;
	private $qtd_ingressos;
	private $filme;
	private $sala;
	
	//construtor
	public function __construct($id, $horario, $data_sessao, $qtd_ingressos, $filme, $sala)
	{
		$this->id   = $id;
		$this->horario = $horario;
		$this->data_sessao   = $data_sessao;
		$this->qtd_ingressos = $qtd_ingressos;
		$this->filme   = $filme;
		$this->sala = $sala;
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
	
	public function getFilme()
	{
		return $this->filme;
	}
	
	public function getSala()
	{
		return $this->sala;
	}
}