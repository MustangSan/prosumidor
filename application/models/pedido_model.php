<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * MODEL PEDIDO
 *---------------------------------------------------------------
 * 
 * Model que trata as funções relacionadas ao objeto Pedido.
 * Todas as funções que necessitam de acessos ao banco de dados,
 * estão descritas neste arquivo.
 *
 */

class Pedido_model extends CI_Model {	
	
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
        return $this->db->count_all("pedido");
    }
	
	/**
	 * Insere uma pedido no banco de dados
	 */
	public function inserirPedido($pedido){
		
		// O parâmetro da função deve ser um objeto do tipo 'Pedido'
		if($pedido instanceof Pedido){
			$this->db->trans_start();
			
			// Insere uma pedido
			$dados = array ('idPedido'		=> $pedido->getIdPedido(),
							'valorTotal' 	=> $pedido->getValorTotal(),
							'validacao' 	=> $pedido->getValidacao(),
							'data' 			=> $pedido->getData(),
							'idProsumidor'	=> $pedido->getIdProsumidor()
							);

			$this->db->insert('pedido', $dados);
						
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status()) 
				return TRUE;
			return FALSE;
		}
	}
	
	/**
	 * Edita uma pedido no banco de dados
	 */
	public function editarPedido($pedido) {	

		// O parâmetro da função deve ser um objeto do tipo 'Pedido'
		if($pedido instanceof Pedido){
			$this->db->trans_start();
			
			// Insere uma pedido
			$dados = array ('idPedido'		=> $pedido->getIdPedido(),
							'valorTotal' 	=> $pedido->getValorTotal(),
							'validacao' 	=> $pedido->getValidacao(),
							'data' 			=> $pedido->getData(),
							'idProsumidor'	=> $pedido->getIdProsumidor()
							);
		
			// Pesquisa se existe a pedido no banco de dados
			$this->db->where('idPedido', $pedido->getIdPedido());
			
			// Atualiza a alteração no banco de dados
			$this->db->update('pedido', $dados);
			
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status())
				return TRUE;
			return FALSE;
		}	
	}

	/**
	 * Remove uma pedido no banco de dados
	 */
	public function deletePedido($idPedido) {

		$this->db->trans_status();

		// Pesquisa se existe a pedido no banco de dados
		$this->db->where('idPedido', $idPedido);

		// Deleta o pedido do banco de dados
		$this->db->delete('pedido');
		
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		if($this->db->trans_status())
			return TRUE;
		return FALSE;
	}
	
	/** 
	*  Lista todos as pedidos retornando um array com todos os itens cadastrados no banco de dados.
	*  Se a função for chamada sem parâmetros, considera que o usuário quer listar todos os itens.
	*/
	public function listarPedidos($limit = 0, $start = 0) {

		// Caso não seja passado nenhum valor limite como parâmetro, inicia a variável com o número total de pedidos cadastradas no banco de dados
		if ($limit == 0) {
			$limit = $this->db->count_all("pedido");
		}
		
		// Inicia a transação
		$this->db->trans_start();
		
		$this->db->order_by('nome ASC');
		$this->db->limit($limit, $start);
		
		// Realiza a pesquisa no banco de dados e joga os dados na query	
		$query = $this->db->get('pedido');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		$pedidos = array();
		
		// Verifica se encontrou alguma pedido na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $pedidos
			foreach ($query->result() as $row) {
				$pedidos[] = new Pedido(	$row->idPedido,
											$row->valorTotal,	
											$row->validacao,
											$row->data,
											$row->idProsumidor
										);
			}

			// Retorna o array com todos as pedidos encontrados
			return $pedidos;
		}
		return NULL;
	}
	
	/** 
	*  Obtém todos os dados da pedido baseado no código recebido como parâmetro.
	*/
	public function getPedido($idPedido) {

		$this->db->trans_start();
    	
    	// Pesquisa se existe pedido no banco de dados
    	$this->db->where('idPedido', $idPedido);
    	
    	// Realiza a pesquisa no banco de dados e joga os dados na query
    	$query = $this->db->get('pedido');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
    	
    	// Caso não tenha encontrado nenhuma pedido, retorna um valor nulo
    	if ($query->num_rows() == 0)
        	return null; 

    	// Caso encontre o dado, pega a linha que contém este pedido
		$row = $query->row();
		
		// Retorna o pedido requisitado
		return new Pedido(	$row->idPedido,
							$row->valorTotal,	
							$row->validacao,
							$row->data,
							$row->idProsumidor
						);
  	}
	
	/** 
	*  Função que exporta os dados em formato .csv
	*/
	public function exportar() {
		$this->load->dbutil();
		
		// Prepara os dados para exportação
		$query = $this->db->get('pedido');
		$delimiter = ";";
		$newline = "\r\n";
		
		// Retorna os dados exportando para o arquivo .csv
		return $this->dbutil->csv_from_result($query, $delimiter, $newline);
	}
}

/* End of file pedido_model.php */
/* Location: ./application/models/pedido_model.php */