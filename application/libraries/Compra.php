<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * CLASSE COMPRA
 *---------------------------------------------------------------
 */

class Compra {
	
	/**
	 * Atributos
	 */
	private $idCompra;
	private $qtdComprada;
	private $valor;
	private $idProduto;
	private $idPedido;
	
	/**
	 * Construtor
	 */
	public function __construct($idCompra, $qtdComprada, $valor, $idProduto, $idPedido) {
		$this->setIdCompra($idCompra);
		$this->setQtdComprada($qtdComprada);
		$this->setValor($valor);
		$this->setIdProduto($idProduto);
		$this->setIdPedido($idPedido);
	}

	/**
	 * Getters
	 */
	public function getIdCompra(){
		return $this->idCompra;
	}

	public function getQtdComprada(){
		return $this->qtdComprada;
	}

	public function getValor(){
		return $this->valor;
	}

	public function getIdProduto(){
		return $this->idProduto;
	}

	public function getIdPedido(){
		return $this->idPedido;
	}		

	/**
	 * Setters
	 */	
	public function setIdCompra($newValue){
		$this->idCompra = $newValue;
	}

	public function setQtdComprada($newValue){
		$this->qtdComprada = $newValue;
	}

	public function setValor($newValue){
		$this->valor = $newValue;
	}

	public function setIdProduto($newValue){
		$this->idProduto = $newValue;
	}

	public function setIdPedido($newValue){
		$this->idPedido = $newValue;
	}

}

/* End of file Compra.php */
/* Location: ./application/libraries/Compra.php */