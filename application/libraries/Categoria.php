<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * CLASSE CATEGORIA
 *---------------------------------------------------------------
 */

class Categoria {
	
	/**
	 * Atributos
	 */
	private $idCategoria;
	private $nome;
	private $descricao;
	
	/**
	 * Construtor
	 */
	public function __construct($idCategoria, $nome, $descricao) {
		$this->setIdCategoria($idCategoria);
		$this->setNome($nome);
		$this->setDescricao($descricao);
	}

	/**
	 * Getters
	 */
	public function getIdCategoria(){
		return $this->idCategoria;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	/**
	 * Setters
	 */	
	public function setIdCategoria($newValue){
		$this->idCategoria = $newValue;
	}

	public function setNome($newValue){
		$this->nome = $newValue;
	}

	public function setDescricao($newValue){
		$this->descricao = $newValue;
	}

}

/* End of file Categoria.php */
/* Location: ./application/libraries/Categoria.php */