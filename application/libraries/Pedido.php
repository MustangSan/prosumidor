<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * CLASSE PEDIDO
 *---------------------------------------------------------------
 */

class Pedido {
	
	/**
	 * Atributos
	 */
	private $idPedido;
	private $valorTotal;
	private $validacao;
	private $data;
	private $idProsumidor;
	
	/**
	 * Construtor
	 */
	public function __construct($idPedido, $valorTotal, $validacao, $data, $idProsumidor) {
		$this->setIdPedido($idPedido);
		$this->setValorTotal($valorTotal);
		$this->setValidacao($validacao);
		$this->setData($data);
		$this->setIdProsumidor($idProsumidor);
	}

	/**
	 * Getters
	 */
	public function getIdPedido(){
		return $this->idPedido;
	}

	public function getValorTotal(){
		return $this->valorTotal;
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

	/**
	 * Setters
	 */	
	public function setIdPedido($newValue){
		$this->idPedido = $newValue;
	}

	public function setValorTotal($newValue){
		$this->valorTotal = $newValue;
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

}

/* End of file Pedido.php */
/* Location: ./application/libraries/Pedido.php */