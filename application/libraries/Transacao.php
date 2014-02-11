<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * CLASSE TRANSACAO
 *---------------------------------------------------------------
 */

class Transacao {
	
	/**
	 * Atributos
	 */
	private $idTransacao;
	private $valorTotalRecebido;
	private $validacao;
	private $data;
	private $idProsumidor;
	private $nomeVoluntario;
	
	/**
	 * Construtor
	 */
	public function __construct($idTransacao, $valorTotalRecebido, $validacao, $data, $idProsumidor, $nomeVoluntario) {
		$this->setIdTransacao($idTransacao);
		$this->setValorTotalRecebido($valorTotalRecebido);
		$this->setValidacao($validacao);
		$this->setData($data);
		$this->setIdProsumidor($idProsumidor);
		$this->setNomeVoluntario($nomeVoluntario);
	}

	/**
	 * Getters
	 */
	public function getIdTransacao(){
		return $this->idTransacao;
	}

	public function getValorTotalRecebido(){
		return $this->valorTotalRecebido;
	}

	public function getValidacao(){
		return $this->validacao;
	}

	public function getData(){
		return $this->data;
	}
	public function getIdProsumidor(){
		return $this->idProsumidor;
	}

	public function getNomeVoluntario(){
		return $this->nomeVoluntario;
	}

	/**
	 * Setters
	 */	
	public function setIdTransacao($newValue){
		$this->idTransacao = $newValue;
	}

	public function setValorTotalRecebido($newValue){
		$this->valorTotalRecebido = $newValue;
	}

	public function setValidacao($newValue){
		$this->validacao = $newValue;
	}

	public function setData($newValue){
		$this->data = $newValue;
	}

	public function setIdProsumidor($newValue){
		$this->idProsumidor = $newValue;
	}

	public function setNomeVoluntario($newValue){
		$this->nomeVoluntario = $newValue;
	}

}

/* End of file Transacao.php */
/* Location: ./application/libraries/Transacao.php */