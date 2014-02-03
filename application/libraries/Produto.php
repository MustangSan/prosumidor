<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * CLASSE PRODUTO
 *---------------------------------------------------------------
 */

class Produto {
	
	/**
	 * Atributos
	 */
	private $idProduto;
	private $nome;
	private $preco;
	private $validade;
	private $unidade;
	private $disponibilidade;
	private $descricao;
	private $idCategoria;
	private $foto;
	
	/**
	 * Construtor
	 */
	public function __construct($idProduto, $nome, $preco, $validade, $unidade, $disponibilidade, $descricao, $idCategoria, $foto) {
		$this->setIdProduto($idProduto);
		$this->setNome($nome);
		$this->setPreco($preco);
		$this->setValidade($validade);
		$this->setUnidade($unidade);
		$this->setDisponibilidade($disponibilidade);
		$this->setDescricao($descricao);
		$this->setIdCategoria($idCategoria);
		$this->setFoto($foto);
	}

	/**
	 * Getters
	 */
	public function getIdProduto(){
		return $this->idProduto;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getPreco(){
		return $this->preco;
	}

	public function getValidade(){
		return $this->validade;
	}

	public function getUnidade(){
		return $this->unidade;
	}

	public function getDisponibilidade(){
		return $this->disponibilidade;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function getIdCategoria(){
		return $this->idCategoria;
	}

	public function getFoto(){
		return $this->foto;
	}
	/**
	 * Setters
	 */	
	public function setIdProduto($newValue){
		$this->idProduto = $newValue;
	}

	public function setNome($newValue){
		$this->nome = $newValue;
	}

	public function setPreco($newValue){
		$this->preco = $newValue;
	}

	public function setValidade($newValue){
		$this->validade = $newValue;
	}

	public function setUnidade($newValue){
		$this->unidade = $newValue;
	}

	public function setDisponibilidade($newValue){
		$this->disponibilidade = $newValue;
	}

	public function setDescricao($newValue){
		$this->descricao = $newValue;
	}

	public function setIdCategoria($newValue){
		$this->idCategoria = $newValue;
	}

	public function setFoto($newValue){
		$this->foto = $newValue;
	}
}

/* End of file Produto.php */
/* Location: ./application/libraries/Produto.php */