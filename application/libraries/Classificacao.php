<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * CLASSE CLASSIFICAÇÃO
 *---------------------------------------------------------------
 */

class Classificacao {
	
	/**
	 * Atributos
	 */
	private $idClassificacao;
	private $nome;
	private $descricao;
	
	/**
	 * Construtor
	 */
	public function __construct($idClassificacao, $nome, $descricao) {
		$this->setIdClassificacao($idClassificacao);
		$this->setNome($nome);
		$this->setDescricao($descricao);
	}

	/**
	 * Getters
	 */
	public function getIdClassificacao(){
		return $this->idClassificacao;
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
	public function setIdClassificacao($newValue){
		$this->idClassificacao = $newValue;
	}

	public function setNome($newValue){
		$this->nome = $newValue;
	}

	public function setDescricao($newValue){
		$this->descricao = $newValue;
	}

}

/* End of file Classificacao.php */
/* Location: ./application/libraries/Classificacao.php */