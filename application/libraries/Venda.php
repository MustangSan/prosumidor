<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * CLASSE VENDA
 *---------------------------------------------------------------
 */

class Venda {
	
	/**
	 * Atributos
	 */
	private $idVenda;
	private $qtdDisponivel;
	private $qtdVendida;
	private $valorRecebido;
	private $idProduto;
	private $idTransacao;
	
	/**
	 * Construtor
	 */
	public function __construct($idVenda, $qtdDisponivel, $qtdVendida, $valorRecebido, $idProduto, $idTransacao) {
		$this->setIdVenda($idVenda);
		$this->setQtdDisponivel($qtdDisponivel);
		$this->setQtdVendida($qtdVendida);
		$this->setValorRecebido($valorRecebido);
		$this->setIdProduto($idProduto);
		$this->setIdTransacao($idTransacao);
	}

	/**
	 * Getters
	 */
	public function getIdVenda(){
		return $this->idVenda;
	}

	public function getQtdDisponivel(){
		return $this->qtdDisponivel;
	}

	public function getQtdVendida(){
		return $this->qtdVendida;
	}

	public function getValorRecebido(){
		return $this->valorRecebido;
	}

	public function getIdProduto(){
		return $this->idProduto;
	}

	public function getIdTransacao(){
		return $this->idTransacao;
	}		

	/**
	 * Setters
	 */	
	public function setIdVenda($newValue){
		$this->idVenda = $newValue;
	}

	public function setQtdDisponivel($newValue){
		$this->qtdDisponivel = $newValue;
	}

	public function setQtdVendida($newValue){
		$this->qtdVendida = $newValue;
	}

	public function setValorRecebido($newValue){
		$this->valorRecebido = $newValue;
	}

	public function setIdProduto($newValue){
		$this->idProduto = $newValue;
	}

	public function setIdTransacao($newValue){
		$this->idTransacao = $newValue;
	}

}

/* End of file Venda.php */
/* Location: ./application/libraries/Venda.php */