<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * MODEL VENDA
 *---------------------------------------------------------------
 * 
 * Model que trata as funções relacionadas ao objeto Compra.
 * Todas as funções que necessitam de acessos ao banco de dados,
 * estão descritas neste arquivo.
 *
 */

class Venda_model extends CI_Model {	
	
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
        return $this->db->count_all("venda");
    }
	
	/**
	 * Insere uma venda no banco de dados
	 */
	public function inserirVenda($venda){
		
		// O parâmetro da função deve ser um objeto do tipo 'Venda'
		if($venda instanceof Venda){
			$this->db->trans_start();
			
			// Insere uma venda
			$dados = array ('idVenda'			=> $venda->getIdVenda(),
							'qtdDisponivel' 	=> $venda->getQtdDisponivel(),
							'qtdVendida'		=> $venda->getQtdVendida(),
							'valorRecebido' 	=> $venda->getValorRecebido(),
							'idProduto' 		=> $venda->getIdProduto(),
							'idTransacao' 		=> $venda->getIdTransacao()
							);
			$this->db->insert('venda', $dados);
						
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status()) 
				return TRUE;
			return FALSE;
		}
	}
	
	/**
	 * Edita uma venda no banco de dados
	 */
	public function editarVenda($venda) {	

		// O parâmetro da função deve ser um objeto do tipo 'Venda'
		if($venda instanceof Venda){
			$this->db->trans_start();
			
			// Insere uma venda
			$dados = array ('idVenda'			=> $venda->getIdVenda(),
							'qtdDisponivel' 	=> $venda->getQtdDisponivel(),
							'qtdVendida'		=> $venda->getQtdVendida(),
							'valorRecebido' 	=> $venda->getValorRecebido(),
							'idProduto' 		=> $venda->getIdProduto(),
							'idTransacao' 		=> $venda->getIdTransacao()
							);
		
			// Pesquisa se existe a venda no banco de dados
			$this->db->where('idVenda', $venda->getIdVenda());
			
			// Atualiza a alteração no banco de dados
			$this->db->update('venda', $dados);
			
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status())
				return TRUE;
			return FALSE;
		}	
	}

	/**
	 * Remove uma venda no banco de dados
	 */
	public function deleteVenda($idVenda) {

		$this->db->trans_status();

		// Pesquisa se existe a venda no banco de dados
		$this->db->where('idVenda', $idVenda);

		// Deleta o venda do banco de dados
		$this->db->delete('venda');
		
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		if($this->db->trans_status())
			return TRUE;
		return FALSE;
	}
	
	/** 
	*  Lista todos as compras retornando um array com todos os itens cadastrados no banco de dados.
	*  Se a função for chamada sem parâmetros, considera que o usuário quer listar todos os itens.
	*/
	public function listarVendas($limit = 0, $start = 0) {

		// Caso não seja passado nenhum valor limite como parâmetro, inicia a variável com o número total de compras cadastradas no banco de dados
		if ($limit == 0) {
			$limit = $this->db->count_all("venda");
		}
		
		// Inicia a transação
		$this->db->trans_start();
		
		//$this->db->order_by('nome ASC');
		$this->db->limit($limit, $start);
		
		// Realiza a pesquisa no banco de dados e joga os dados na query	
		$query = $this->db->get('venda');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		$vendas = array();
		
		// Verifica se encontrou alguma Venda na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $vendas
			foreach ($query->result() as $row) {
				$vendas[] = new Venda(	$row->idVenda,
										$row->qtdDisponivel,	
										$row->qtdVendida,
										$row->valorRecebido,
										$row->idProduto,
										$row->idTransacao 
									);
			}

			// Retorna o array com todos as vendas encontrados
			return $vendas;
		}
		return NULL;
	}
	
	/** 
	*  Obtém todos os dados da venda baseado no código recebido como parâmetro.
	*/
	public function getVenda($idVenda) {

		$this->db->trans_start();
    	
    	// Pesquisa se existe Venda no banco de dados
    	$this->db->where('idVenda', $idVenda);
    	
    	// Realiza a pesquisa no banco de dados e joga os dados na query
    	$query = $this->db->get('venda');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
    	
    	// Caso não tenha encontrado nenhuma Venda, retorna um valor nulo
    	if ($query->num_rows() == 0)
        	return null; 

    	// Caso encontre o dado, pega a linha que contém este Vende
		$row = $query->row();
		
		// Retorna o Venda requisitado
		return new Venda(	$row->idVenda,
							$row->qtdDisponivel,	
							$row->qtdVendida,
							$row->valorRecebido,
							$row->idProduto,
							$row->idTransacao 
						);
  	}
	
	/** 
	*  Lista todos as compras retornando um array com todos os itens cadastrados no banco de dados.
	*  Se a função for chamada sem parâmetros, considera que o usuário quer listar todos os itens.
	*/
	public function listarVendaTransacao($idTransacao, $limit = 0, $start = 0) {

		// Caso não seja passado nenhum valor limite como parâmetro, inicia a variável com o número total de vendas cadastradas no banco de dados
		if ($limit == 0) {
			$limit = $this->db->count_all("venda");
		}
		
		// Inicia a transação
		$this->db->trans_start();
		
		$this->db->where('idTransacao', $idTransacao);

		//$this->db->order_by('nome ASC');
		$this->db->limit($limit, $start);
		
		// Realiza a pesquisa no banco de dados e joga os dados na query	
		$query = $this->db->get('venda');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		$vendas = array();
		
		// Verifica se encontrou alguma Compra na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $vendas
			foreach ($query->result() as $row) {
				$vendas[] = new Venda(	$row->idVenda,
										$row->qtdDisponivel,	
										$row->qtdVendida,
										$row->valorRecebido,
										$row->idProduto,
										$row->idTransacao 
									);
			}

			// Retorna o array com todos as vendas encontrados
			return $vendas;
		}
		return NULL;
	}

	/** 
	*  Função que exporta os dados em formato .csv
	*/
	public function exportar() {
		$this->load->dbutil();
		
		// Prepara os dados para exportação
		$query = $this->db->get('venda');
		$delimiter = ";";
		$newline = "\r\n";
		
		// Retorna os dados exportando para o arquivo .csv
		return $this->dbutil->csv_from_result($query, $delimiter, $newline);
	}
}

/* End of file compra_model.php */
/* Location: ./application/models/compra_model.php */