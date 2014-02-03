<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * MODEL PRODUTO
 *---------------------------------------------------------------
 * 
 * Model que trata as funções relacionadas ao objeto Produto.
 * Todas as funções que necessitam de acessos ao banco de dados,
 * estão descritas neste arquivo.
 *
 */

class Produto_model extends CI_Model {	
	
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
        return $this->db->count_all("produto");
    }
	
	/**
	 * Insere uma produto no banco de dados
	 */
	public function inserirProduto($produto){
		
		// O parâmetro da função deve ser um objeto do tipo 'Produto'
		if($produto instanceof Produto){
			$this->db->trans_start();
			
			// Insere um produto
			$dados = array ('idProduto'			=> $produto->getIdProduto(),
							'nome' 				=> $produto->getNome(),
							'preco' 			=> $produto->getPreco(),
							'validade' 			=> $produto->getValidade(),
							'unidade' 			=> $produto->getUnidade(),
							'disponibilidade' 	=> $produto->getDisponibilidade(),
							'descricao' 		=> $produto->getDescricao(),
							'idCategoria' 		=> $produto->getIdCategoria(),
							'foto'				=> $produto->getFoto()
							);
			$this->db->insert('produto', $dados);
						
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status()) 
				return TRUE;
			return FALSE;
		}
	}
	
	/**
	 * Edita uma produto no banco de dados
	 */
	public function editarProduto($produto) {	

		// O parâmetro da função deve ser um objeto do tipo 'Produto'
		if($produto instanceof Produto){
			$this->db->trans_start();
			
			// Insere uma produto
			$dados = array ('idProduto'			=> $produto->getIdProduto(),
							'nome' 				=> $produto->getNome(),
							'preco' 			=> $produto->getPreco(),
							'validade' 			=> $produto->getValidade(),
							'unidade' 			=> $produto->getUnidade(),
							'disponibilidade' 	=> $produto->getDisponibilidade(),
							'descricao' 		=> $produto->getDescricao(),
							'idCategoria' 		=> $produto->getIdCategoria(),
							'foto'				=> $produto->getFoto()
							);
			// Pesquisa se existe a produto no banco de dados
			$this->db->where('idProduto', $produto->getIdProduto());
			
			// Atualiza a alteração no banco de dados
			$this->db->update('produto', $dados);
			
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status())
				return TRUE;
			return FALSE;
		}	
	}

	/**
	 * Remove uma produto no banco de dados
	 */
	public function deleteProduto($idProduto) {

		$this->db->trans_status();

		// Pesquisa se existe a produto no banco de dados
		$this->db->where('idProduto', $idProduto);

		// Deleta o produto do banco de dados
		$this->db->delete('produto');
		
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		if($this->db->trans_status())
			return TRUE;
		return FALSE;
	}
	
	/** 
	*  Lista todos as produtos retornando um array com todos os itens cadastrados no banco de dados.
	*  Se a função for chamada sem parâmetros, considera que o usuário quer listar todos os itens.
	*/
	public function listarProdutos($limit = 0, $start = 0) {

		// Caso não seja passado nenhum valor limite como parâmetro, inicia a variável com o número total de produtos cadastradas no banco de dados
		if ($limit == 0) {
			$limit = $this->db->count_all("produto");
		}
		
		// Inicia a transação
		$this->db->trans_start();
		
		$this->db->order_by('nome ASC');
		$this->db->limit($limit, $start);
		
		// Realiza a pesquisa no banco de dados e joga os dados na query	
		$query = $this->db->get('produto');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		$produtos = array();
		
		// Verifica se encontrou alguma produto na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $produtos
			foreach ($query->result() as $row) {
				$produtos[] = new Produto(	$row->idProduto,
											$row->nome,	
											$row->preco,
											$row->validade,
											$row->unidade,
											$row->disponibilidade,
											$row->descricao,
											$row->idCategoria,
											$row->foto
											);
			}

			// Retorna o array com todos as produtos encontrados
			return $produtos;
		}
		return NULL;
	}
	
	/** 
	*  Obtém todos os dados da produto baseado no código recebido como parâmetro.
	*/
	public function getProduto($idProduto) {

		$this->db->trans_start();
    	
    	// Pesquisa se existe produto no banco de dados
    	$this->db->where('idProduto', $idProduto);
    	
    	// Realiza a pesquisa no banco de dados e joga os dados na query
    	$query = $this->db->get('produto');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
    	
    	// Caso não tenha encontrado nenhuma produto, retorna um valor nulo
    	if ($query->num_rows() == 0)
        	return null; 

    	// Caso encontre o dado, pega a linha que contém este produto
		$row = $query->row();
		
		// Retorna o produto requisitado
		return new Produto(	$row->idProduto,
							$row->nome,	
							$row->preco,
							$row->validade,
							$row->unidade,
							$row->disponibilidade,
							$row->descricao,
							$row->idCategoria,
							$row->foto
							);
  	}

  	public function listarClassificacoes($idProduto){
  		
  		$this->db->trans_start();
    	
    	// Pesquisa se existe produto no banco de dados
    	$this->db->where('idProduto', $idProduto);
    	
    	// Realiza a pesquisa no banco de dados e joga os dados na query
    	$query = $this->db->get('classproduto');

		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
    	
		//$classproduto = array();
		
		// Verifica se encontrou alguma produto na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $classproduto
			foreach ($query->result() as $row) {
				$classproduto[] = array( 'idClassificacao' => $row->idClassificacao );
			}

			// Retorna o array com todos as classificaçoes daquele produto encontrados
			return $classproduto;
		}
		return NULL; 	
  	}

  	public function inserirClassProduto($idProduto,$idClassificacao){

		$this->db->trans_start();
		
		// Insere um produto
		$dados = array ('idProduto'		  => $idProduto,
						'idClassificacao' => $idClassificacao
						);
		$this->db->insert('classproduto', $dados);
					
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		if($this->db->trans_status()) 
			return TRUE;
		return FALSE;	
  	}
	
	public function jaExiste($idProduto,$idClassificacao){
		$this->db->trans_start();
		
		$this->db->where('idProduto', $idProduto);
		$this->db->where('idClassificacao', $idClassificacao);
    	
    	// Realiza a pesquisa no banco de dados e joga os dados na query
    	$query = $this->db->get('classproduto');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
					
	    if ($query->num_rows() == 0)
    		return FALSE;
		return TRUE;	

	}

	public function removeClassProduto($idProduto,$idClassificacao){
		$this->db->trans_status();

		// Pesquisa se existe a produto no banco de dados
		$this->db->where('idProduto', $idProduto);
		$this->db->where('idClassificacao', $idClassificacao);

		// Deleta o produto do banco de dados
		$this->db->delete('classproduto');
		
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		if($this->db->trans_status())
			return TRUE;
		return FALSE;		
	}
	/** 
	*  Função que exporta os dados em formato .csv
	*/
	public function exportar() {
		$this->load->dbutil();
		
		// Prepara os dados para exportação
		$query = $this->db->get('produto');
		$delimiter = ";";
		$newline = "\r\n";
		
		// Retorna os dados exportando para o arquivo .csv
		return $this->dbutil->csv_from_result($query, $delimiter, $newline);
	}
}

/* End of file produto_model.php */
/* Location: ./application/models/produto_model.php */