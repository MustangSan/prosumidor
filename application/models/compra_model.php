<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * MODEL COMPRA
 *---------------------------------------------------------------
 * 
 * Model que trata as funções relacionadas ao objeto Compra.
 * Todas as funções que necessitam de acessos ao banco de dados,
 * estão descritas neste arquivo.
 *
 */

class Compra_model extends CI_Model {	
	
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
        return $this->db->count_all("compra");
    }
	
	/**
	 * Insere uma compra no banco de dados
	 */
	public function inserirCompra($compra){
		
		// O parâmetro da função deve ser um objeto do tipo 'Compra'
		if($compra instanceof Compra){
			$this->db->trans_start();
			
			// Insere uma compra
			$dados = array ('idCompra'		=> $compra->getIdCompra(),
							'qtdComprada' 	=> $compra->getQtdComprada(),
							'valor' 		=> $compra->getValor(),
							'idProduto' 	=> $compra->getIdProduto(),
							'idPedido' 		=> $compra->getIdPedido());
			$this->db->insert('compra', $dados);
						
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status()) 
				return TRUE;
			return FALSE;
		}
	}
	
	/**
	 * Edita uma compra no banco de dados
	 */
	public function editarCompra($compra) {	

		// O parâmetro da função deve ser um objeto do tipo 'Compra'
		if($compra instanceof Compra){
			$this->db->trans_start();
			
			// Insere uma Compra
			$dados = array ('idCompra'		=> $compra->getIdCompra(),
							'qtdComprada' 	=> $compra->getQtdComprada(),
							'valor' 		=> $compra->getValor(),
							'idProduto' 	=> $compra->getIdProduto(),
							'idPedido' 		=> $compra->getIdPedido());
		
			// Pesquisa se existe a compra no banco de dados
			$this->db->where('idCompra', $compra->getIdCompra());
			
			// Atualiza a alteração no banco de dados
			$this->db->update('compra', $dados);
			
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status())
				return TRUE;
			return FALSE;
		}	
	}

	/**
	 * Remove uma compra no banco de dados
	 */
	public function deleteCompra($idCompra) {

		$this->db->trans_status();

		// Pesquisa se existe a compra no banco de dados
		$this->db->where('idCompra', $idCompra);

		// Deleta o compra do banco de dados
		$this->db->delete('compra');
		
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
	public function listarCompras($limit = 0, $start = 0) {

		// Caso não seja passado nenhum valor limite como parâmetro, inicia a variável com o número total de compras cadastradas no banco de dados
		if ($limit == 0) {
			$limit = $this->db->count_all("compra");
		}
		
		// Inicia a transação
		$this->db->trans_start();
		
		//$this->db->order_by('nome ASC');
		$this->db->limit($limit, $start);
		
		// Realiza a pesquisa no banco de dados e joga os dados na query	
		$query = $this->db->get('compra');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		$compras = array();
		
		// Verifica se encontrou alguma Compra na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $compras
			foreach ($query->result() as $row) {
				$compras[] = new Compra(	$row->idCompra,
											$row->qtdComprada,	
											$row->valor,
											$row->idProduto,
											$row->idPedido );
			}

			// Retorna o array com todos as compras encontrados
			return $compras;
		}
		return NULL;
	}
	
	/** 
	*  Obtém todos os dados da compra baseado no código recebido como parâmetro.
	*/
	public function getCompra($idCompra) {

		$this->db->trans_start();
    	
    	// Pesquisa se existe Compra no banco de dados
    	$this->db->where('idCompra', $idCompra);
    	
    	// Realiza a pesquisa no banco de dados e joga os dados na query
    	$query = $this->db->get('compra');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
    	
    	// Caso não tenha encontrado nenhuma Compra, retorna um valor nulo
    	if ($query->num_rows() == 0)
        	return null; 

    	// Caso encontre o dado, pega a linha que contém este Compra
		$row = $query->row();
		
		// Retorna o Compra requisitado
		return new Compra(	$row->idCompra,
							$row->qtdComprada,	
							$row->valor,
							$row->idProduto,
							$row->idPedido );
  	}
	
	/** 
	*  Lista todos as compras retornando um array com todos os itens cadastrados no banco de dados.
	*  Se a função for chamada sem parâmetros, considera que o usuário quer listar todos os itens.
	*/
	public function listarComprasPedido($idPedido, $limit = 0, $start = 0) {

		// Caso não seja passado nenhum valor limite como parâmetro, inicia a variável com o número total de compras cadastradas no banco de dados
		if ($limit == 0) {
			$limit = $this->db->count_all("compra");
		}
		
		// Inicia a transação
		$this->db->trans_start();
		
		$this->db->where('idPedido', $idPedido);

		//$this->db->order_by('nome ASC');
		$this->db->limit($limit, $start);
		
		// Realiza a pesquisa no banco de dados e joga os dados na query	
		$query = $this->db->get('compra');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		$compras = array();
		
		// Verifica se encontrou alguma Compra na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $compras
			foreach ($query->result() as $row) {
				$compras[] = new Compra(	$row->idCompra,
											$row->qtdComprada,	
											$row->valor,
											$row->idProduto,
											$row->idPedido );
			}

			// Retorna o array com todos as compras encontrados
			return $compras;
		}
		return NULL;
	}

	/** 
	*  Função que exporta os dados em formato .csv
	*/
	public function exportar() {
		$this->load->dbutil();
		
		// Prepara os dados para exportação
		$query = $this->db->get('compra');
		$delimiter = ";";
		$newline = "\r\n";
		
		// Retorna os dados exportando para o arquivo .csv
		return $this->dbutil->csv_from_result($query, $delimiter, $newline);
	}
}

/* End of file compra_model.php */
/* Location: ./application/models/compra_model.php */