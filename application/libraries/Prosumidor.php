<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * CLASSE PROSUMIDOR
 *---------------------------------------------------------------
 */

class Prosumidor {
	
	/**
	 * Atributos
	 */
	private $idProsumidor;
	private $email;
	private $senha;
	private $nome;
	private $cpf;
	private $telefone;
	private $endereco;
	private $sexo;
	private $status;
	private $tipo;
	private $saldoConsumidor;
	
	/**
	 * Construtor
	 */
	public function __construct($idProsumidor, $email, $senha, $nome, $cpf, $telefone, $endereco, $sexo, $status, $tipo, $saldoConsumidor) {
		$this->setIdProsumidor($idProsumidor);
		$this->setEmail($email);
		$this->setSenha($senha);
		$this->setNome($nome);
		$this->setCPF($cpf);
		$this->setTelefone($telefone);
		$this->setEndereco($endereco);
		$this->setSexo($sexo);
		$this->setStatus($status);
		$this->setTipo($tipo);
		$this->setSaldoConsumidor($saldoConsumidor);
	}

	/**
	 * Getters
	 */
	public function getIdProsumidor(){
		return $this->idProsumidor;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getCPF(){
		return $this->cpf;
	}

	public function getTelefone(){
		return $this->telefone;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function getSexo(){
		return $this->sexo;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getTipo(){
		return $this->tipo;
	}

	public function getSaldoConsumidor(){
		return $this->saldoConsumidor;
	}

	/**
	 * Setters
	 */	
	public function setIdProsumidor($newValue){
		$this->idProsumidor = $newValue;
	}

	public function setEmail($newValue){
		$this->email = $newValue;
	}

	public function setSenha($newValue){
		$this->senha = $newValue;
	}

	public function setNome($newValue){
		$this->nome = $newValue;
	}

	public function setCPF($newValue){
		$this->cpf = $newValue;
	}

	public function setTelefone($newValue){
		$this->telefone = $newValue;
	}

	public function setEndereco($newValue){
		$this->endereco = $newValue;
	}

	public function setSexo($newValue){
		$this->sexo = $newValue;
	}

	public function setStatus($newValue){
		$this->status = $newValue;
	}

	public function setTipo($newValue){
		$this->tipo = $newValue;
	}

	public function setSaldoConsumidor($newValue){
		$this->saldoConsumidor = $newValue;
	}

}

/* End of file Prosumidor.php */
/* Location: ./application/libraries/Prosumidor.php */