<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * MODEL PROPRIEDADE
 *---------------------------------------------------------------
 * 
 * Model que trata as funções relacionadas ao objeto Propriedade.
 * Todas as funções que necessitam de acessos ao banco de dados,
 * estão descritas neste arquivo.
 *
 */

class Propriedade_model extends CI_Model {	
	
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
        return $this->db->count_all("propriedade");
    }
	
	/**
	 * Insere uma propriedade no banco de dados
	 */
	public function inserirPropriedade($propriedade){
		
		// O parâmetro da função deve ser um objeto do tipo 'Propriedade'
		if($propriedade instanceof Propriedade){
			$this->db->trans_start();
			
			// Insere uma propriedade
			$dados = array ('idPropriedade'	=> $propriedade->getIdPropriedade(),
							'nome' 			=> $propriedade->getNome(),
							'endereco' 		=> $propriedade->getEndereco(),
							'tamanho' 		=> $propriedade->getTamanho(),
							'idProsumidor' 	=> $propriedade->getIdProsumidor() );
			$this->db->insert('propriedade', $dados);
						
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status()) 
				return TRUE;
			return FALSE;
		}
	}
	
	/**
	 * Edita uma propriedade no banco de dados
	 */
	public function editarPropriedade($propriedade) {	

		// O parâmetro da função deve ser um objeto do tipo 'Propriedade'
		if($propriedade instanceof Propriedade){
			$this->db->trans_start();
			
			// Insere uma propriedade
			$dados = array ('idPropriedade'	=> $propriedade->getIdPropriedade(),
							'nome' 			=> $propriedade->getNome(),
							'endereco' 		=> $propriedade->getEndereco(),
							'tamanho' 		=> $propriedade->getTamanho(),
							'idProsumidor' 	=> $propriedade->getIdProsumidor() );
		
			// Pesquisa se existe a propriedade no banco de dados
			$this->db->where('idPropriedade', $propriedade->getIdPropriedade());
			
			// Atualiza a alteração no banco de dados
			$this->db->update('propriedade', $dados);
			
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status())
				return TRUE;
			return FALSE;
		}	
	}

	/**
	 * Remove uma propriedade no banco de dados
	 */
	public function deletePropriedade($idPropriedade) {
		
		$this->db->trans_status();

		// Pesquisa se existe a propriedade no banco de dados
		$this->db->where('idPropriedade', $idPropriedade);

		// Deleta o propriedade do banco de dados
		$this->db->delete('propriedade');
		
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		if($this->db->trans_status())
			return TRUE;
		return FALSE;
	}
	
	/** 
	*  Lista todos as propriedades retornando um array com todos os itens cadastrados no banco de dados.
	*  Se a função for chamada sem parâmetros, considera que o usuário quer listar todos os itens.
	*/
	public function listarPropriedades($limit = 0, $start = 0) {

		// Caso não seja passado nenhum valor limite como parâmetro, inicia a variável com o número total de propriedades cadastradas no banco de dados
		if ($limit == 0) {
			$limit = $this->db->count_all("propriedade");
		}
		
		// Inicia a transação
		$this->db->trans_start();
		
		$this->db->order_by('nome ASC');
		$this->db->limit($limit, $start);
		
		// Realiza a pesquisa no banco de dados e joga os dados na query	
		$query = $this->db->get('propriedade');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		$propriedades = array();
		
		// Verifica se encontrou alguma propriedade na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $propriedades
			foreach ($query->result() as $row) {
				$propriedades[] = new Propriedade(	$row->idPropriedade,
													$row->nome,	
													$row->endereco,
													$row->tamanho,
													$row->idProsumidor );
			}

			// Retorna o array com todos as propriedades encontrados
			return $propriedades;
		}
		return NULL;
	}
	
	/** 
	*  Obtém todos os dados da propriedade baseado no código recebido como parâmetro.
	*/
	public function getPropriedade($idPropriedade) {

		$this->db->trans_start();
    	
    	// Pesquisa se existe propriedade no banco de dados
    	$this->db->where('idPropriedade', $idPropriedade);
    	
    	// Realiza a pesquisa no banco de dados e joga os dados na query
    	$query = $this->db->get('propriedade');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
    	
    	// Caso não tenha encontrado nenhuma propriedade, retorna um valor nulo
    	if ($query->num_rows() == 0)
        	return null; 

    	// Caso encontre o dado, pega a linha que contém este propriedade
		$row = $query->row();
		
		// Retorna o propriedade requisitado
		return new Propriedade(	$row->idPropriedade,
								$row->nome,	
								$row->endereco,
								$row->tamanho,
								$row->idProsumidor );
  	}
	
	/** 
	*  Função que exporta os dados em formato .csv
	*/
	public function exportar() {
		$this->load->dbutil();
		
		// Prepara os dados para exportação
		$query = $this->db->get('propriedade');
		$delimiter = ";";
		$newline = "\r\n";
		
		// Retorna os dados exportando para o arquivo .csv
		return $this->dbutil->csv_from_result($query, $delimiter, $newline);
	}
}

/* End of file propriedade_model.php */
/* Location: ./application/models/propriedade_model.php */