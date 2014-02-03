<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * MODEL ADMINISTRADOR
 *---------------------------------------------------------------
 * 
 * Model que trata as funções relacionadas ao objeto Administrador.
 * Todas as funções que necessitam de acessos ao banco de dados,
 * estão descritas neste arquivo.
 *
 */

class Administrador_model extends CI_Model {	
	
	/**
	 * Construtor
	 */
	public function __construct()  {
    	parent::__construct();
		
        $this->load->database();
        $this->load->library('Dominio');
	}	
	
	/**
	 * Retorna a quantidade de linhas na tabela
	 */	
    public function record_count() {
        return $this->db->count_all("administrador");
    }
	
	/**
	 * Insere um administrador no banco de dados
	 */
	public function inserirAdministrador($administrador){
		
		// O parâmetro da função deve ser um objeto do tipo 'Administrador'
		if($administrador instanceof Administrador){
			$this->db->trans_start();
			
			// Insere o administrador
			$dados = array ('idAdministrador' 	=> $administrador->getIdAdministrador(),
							'email' 			=> $administrador->getEmail(),
							'senha' 			=> $administrador->getSenha(),
							'nome' 				=> $administrador->getNome());
			$this->db->insert('administrador', $dados);
						
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status()) 
				return TRUE;
			return FALSE;
		}
	}
	
	/**
	 * Edita um administrador no banco de dados
	 */
	public function editarAdministrador($administrador) {	

		// O parâmetro da função deve ser um objeto do tipo 'Administrador'
		if($administrador instanceof Administrador){
			$this->db->trans_start();
			
			// Insere o administrador
			$dados = array ('idAdministrador' 	=> $administrador->getIdAdministrador(),
							'email' 			=> $administrador->getEmail(),
							'senha' 			=> $administrador->getSenha(),
							'nome' 				=> $administrador->getNome());	
		
			// Pesquisa se existe administrador no banco de dados
			$this->db->where('idAdministrador', $administrador->getIdAdministrador());
			
			// Atualiza a alteração no banco de dados
			$this->db->update('administrador', $dados);
			
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status())
				return TRUE;
			return FALSE;
		}	
	}

	/**
	 * Remove um administrador no banco de dados
	 */
	public function deleteAdministrador($idAdministrador) {

		$this->db->trans_status();

		// Pesquisa se existe administrador no banco de dados
		$this->db->where('idAdministrador', $idAdministrador);

		// Deleta o administrador do banco de dados
		$this->db->delete('administrador');
		
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		if($this->db->trans_status())
			return TRUE;
		return FALSE;
	}
	
	/** 
	*  Lista todos os administradores retornando um array com todos os itens cadastrados no banco de dados.
	*  Se a função for chamada sem parâmetros, considera que o usuário quer listar todos os itens.
	*/
	public function listarAdministradores($limit = 0, $start = 0) {

		// Caso não seja passado nenhum valor limite como parâmetro, inicia a variável com o número total de administradores cadastrados no banco de dados
		if ($limit == 0) {
			$limit = $this->db->count_all("administrador");
		}
		
		// Inicia a transação
		$this->db->trans_start();
		
		$this->db->order_by('nome ASC');
		$this->db->limit($limit, $start);
		
		// Realiza a pesquisa no banco de dados e joga os dados na query	
		$query = $this->db->get('administrador');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		$administradores = array();
		
		// Verifica se encontrou algum administrador na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $administradores
			foreach ($query->result() as $row) {
				$administradores[] = new Administrador(	$row->idAdministrador,
														$row->email,
														$row->senha,
														$row->nome );
			}

			// Retorna o array com todos os administradores encontrados
			return $administradores;
		}
		return NULL;
	}
	
	/** 
	*  Obtém todos os dados do administrador baseado no código recebido como parâmetro.
	*/
	public function getAdministrador($idAdministrador) {

		$this->db->trans_start();
    	
    	// Pesquisa se existe administrador no banco de dados
    	$this->db->where('idAdministrador', $idAdministrador);
    	
    	// Realiza a pesquisa no banco de dados e joga os dados na query
    	$query = $this->db->get('administrador');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
    	
    	// Caso não tenha encontrado nenhum administrador, retorna um valor nulo
    	if ($query->num_rows() == 0)
        	return null; 

    	// Caso encontre o dado, pega a linha que contém este administrador
		$row = $query->row();
		
		// Retorna o administrador requisitado
		return new Administrador(	$row->idAdministrador,
									$row->email,
									$row->senha,
									$row->nome );
  	}
	
	/** 
	*  Função que exporta os dados em formato .csv
	*/
	public function exportar() {
		$this->load->dbutil();
		
		// Prepara os dados para exportação
		$query = $this->db->get('administrador');
		$delimiter = ";";
		$newline = "\r\n";
		
		// Retorna os dados exportando para o arquivo .csv
		return $this->dbutil->csv_from_result($query, $delimiter, $newline);
	}
}

/* End of file administrador_model.php */
/* Location: ./application/models/administrador_model.php */