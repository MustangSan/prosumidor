<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * CLASSE PROPRIEDADE
 *---------------------------------------------------------------
 */

class Propriedade {
	
	/**
	 * Atributos
	 */
	private $idPropriedade;
	private $nome;
	private $endereco;
	private $tamanho;
	private $idProsumidor;
	
	/**
	 * Construtor
	 */
	public function __construct($idPropriedade, $nome, $endereco, $tamanho, $idProsumidor) {
		$this->setIdPropriedade($idPropriedade);
		$this->setNome($nome);
		$this->setEndereco($endereco);
		$this->setTamanho($tamanho);
		$this->setIdProsumidor($idProsumidor);
	}

	/**
	 * Getters
	 */
	public function getIdPropriedade(){
		return $this->idPropriedade;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function getTamanho(){
		return $this->tamanho;
	}

	public function getIdProsumidor(){
		return $this->idProsumidor;
	}		

	/**
	 * Setters
	 */	
	public function setIdPropriedade($newValue){
		$this->idPropriedade = $newValue;
	}

	public function setNome($newValue){
		$this->nome = $newValue;
	}

	public function setEndereco($newValue){
		$this->endereco = $newValue;
	}

	public function setTamanho($newValue){
		$this->tamanho = $newValue;
	}

	public function setIdProsumidor($newValue){
		$this->idProsumidor = $newValue;
	}

}

/* End of file Propriedade.php */
/* Location: ./application/libraries/Propriedade.php */