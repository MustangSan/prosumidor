<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * MODEL CLASSIFICAÇÃO
 *---------------------------------------------------------------
 * 
 * Model que trata as funções relacionadas ao objeto Classificação.
 * Todas as funções que necessitam de acessos ao banco de dados,
 * estão descritas neste arquivo.
 *
 */

class Classificacao_model extends CI_Model {	
	
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
        return $this->db->count_all("classificacao");
    }
	
	/**
	 * Insere uma classificacao no banco de dados
	 */
	public function inserirClassificacao($classificacao){
		
		// O parâmetro da função deve ser um objeto do tipo 'Classificacao'
		if($classificacao instanceof Classificacao){
			$this->db->trans_start();
			
			// Insere uma classificacao
			$dados = array ('idClassificacao'	=> $classificacao->getIdClassificacao(),
							'nome' 				=> $classificacao->getNome(),
							'descricao' 		=> $classificacao->getDescricao());
			$this->db->insert('classificacao', $dados);
						
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status()) 
				return TRUE;
			return FALSE;
		}
	}
	
	/**
	 * Edita uma classificacao no banco de dados
	 */
	public function editarClassificacao($classificacao) {	

		// O parâmetro da função deve ser um objeto do tipo 'Classificacao'
		if($classificacao instanceof Classificacao){
			$this->db->trans_start();
			
			// Insere uma classificacao
			$dados = array ('idClassificacao'	=> $classificacao->getIdClassificacao(),
							'nome' 				=> $classificacao->getNome(),
							'descricao' 		=> $classificacao->getDescricao());
		
			// Pesquisa se existe a classificacao no banco de dados
			$this->db->where('idClassificacao', $classificacao->getIdClassificacao());
			
			// Atualiza a alteração no banco de dados
			$this->db->update('classificacao', $dados);
			
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status())
				return TRUE;
			return FALSE;
		}	
	}

	/**
	 * Remove uma classificacao no banco de dados
	 */
	public function deleteClassificacao($idClassificacao) {

		$this->db->trans_status();

		// Pesquisa se existe a classificacao no banco de dados
		$this->db->where('idClassificacao', $idClassificacao);

		// Deleta o classificacao do banco de dados
		$this->db->delete('classificacao');
		
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		if($this->db->trans_status())
			return TRUE;
		return FALSE;
	}
	
	/** 
	*  Lista todos as classificacoes retornando um array com todos os itens cadastrados no banco de dados.
	*  Se a função for chamada sem parâmetros, considera que o usuário quer listar todos os itens.
	*/
	public function listarClassificacoes($limit = 0, $start = 0) {

		// Caso não seja passado nenhum valor limite como parâmetro, inicia a variável com o número total de classificacaos cadastradas no banco de dados
		if ($limit == 0) {
			$limit = $this->db->count_all("classificacao");
		}
		
		// Inicia a transação
		$this->db->trans_start();
		
		$this->db->order_by('nome ASC');
		$this->db->limit($limit, $start);
		
		// Realiza a pesquisa no banco de dados e joga os dados na query	
		$query = $this->db->get('classificacao');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		$classificacoes = array();
		
		// Verifica se encontrou alguma classificacao na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $classificacoes
			foreach ($query->result() as $row) {
				$classificacoes[] = new Classificacao(	$row->idClassificacao,
														$row->nome,	
														$row->descricao );
			}

			// Retorna o array com todos as classificacoes encontrados
			return $classificacoes;
		}
		return NULL;
	}
	
	/** 
	*  Obtém todos os dados da classificacao baseado no código recebido como parâmetro.
	*/
	public function getClassificacao($idClassificacao) {

		$this->db->trans_start();
    	
    	// Pesquisa se existe classificacao no banco de dados
    	$this->db->where('idClassificacao', $idClassificacao);
    	
    	// Realiza a pesquisa no banco de dados e joga os dados na query
    	$query = $this->db->get('classificacao');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
    	
    	// Caso não tenha encontrado nenhuma classificacao, retorna um valor nulo
    	if ($query->num_rows() == 0)
        	return null; 

    	// Caso encontre o dado, pega a linha que contém este classificacao
		$row = $query->row();
		
		// Retorna o classificacao requisitado
		return new Classificacao(	$row->idClassificacao,
									$row->nome,
									$row->descricao );
  	}
	
	/** 
	*  Função que exporta os dados em formato .csv
	*/
	public function exportar() {
		$this->load->dbutil();
		
		// Prepara os dados para exportação
		$query = $this->db->get('classificacao');
		$delimiter = ";";
		$newline = "\r\n";
		
		// Retorna os dados exportando para o arquivo .csv
		return $this->dbutil->csv_from_result($query, $delimiter, $newline);
	}
}

/* End of file classificacao_model.php */
/* Location: ./application/models/classificacao_model.php */