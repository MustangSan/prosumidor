<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * MODEL TRANSACAO
 *---------------------------------------------------------------
 * 
 * Model que trata as funções relacionadas ao objeto Transacao.
 * Todas as funções que necessitam de acessos ao banco de dados,
 * estão descritas neste arquivo.
 *
 */

class Transacao_model extends CI_Model {	
	
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
        return $this->db->count_all("transacao");
    }
	
	/**
	 * Insere uma transacao no banco de dados
	 */
	public function inserirTransacao($transacao){
		
		// O parâmetro da função deve ser um objeto do tipo 'Transacao'
		if($transacao instanceof Transacao){
			$this->db->trans_start();
			
			$dia = substr($transacao->getData(),0,2);
			$mes = substr($transacao->getData(),3,2);
			$ano = substr($transacao->getData(),6,4);
			$data = $ano."/".$mes."/".$dia;

			// Insere uma transacao
			$dados = array ('idTransacao'			=> $transacao->getIdTransacao(),
							'valorTotalRecebido' 	=> $transacao->getValorTotalRecebido(),
							'validacao' 			=> $transacao->getValidacao(),
							'data' 					=> $data,
							'idProsumidor'			=> $transacao->getIdProsumidor(),
							'nomeVoluntario'		=> $transacao->getNomeVoluntario()
							);

			$this->db->insert('transacao', $dados);
						
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status()) 
				return TRUE;
			return FALSE;
		}
	}
	
	/**
	 * Edita uma transacao no banco de dados
	 */
	public function editarTransacao($transacao) {	

		// O parâmetro da função deve ser um objeto do tipo 'Pedido'
		if($transacao instanceof Transacao){
			$this->db->trans_start();
			
			// Insere uma transacao
			$dados = array ('idTransacao'			=> $transacao->getIdTransacao(),
							'valorTotalRecebido' 	=> $transacao->getValorTotalRecebido(),
							'validacao' 			=> $transacao->getValidacao(),
							'data' 					=> $transacao->getData(),
							'idProsumidor'			=> $transacao->getIdProsumidor(),
							'nomeVoluntario'		=> $transacao->getNomeVoluntario()
							);
		
			// Pesquisa se existe a transacao no banco de dados
			$this->db->where('idTransacao', $transacao->getIdTransacao());
			
			// Atualiza a alteração no banco de dados
			$this->db->update('transacao', $dados);
			
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
	public function deleteTransacao($idTransacao) {

		$this->db->trans_status();

		// Pesquisa se existe a pedido no banco de dados
		$this->db->where('idTransacao', $idTransacao);

		// Deleta o pedido do banco de dados
		$this->db->delete('transacao');
		
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		if($this->db->trans_status())
			return TRUE;
		return FALSE;
	}
	
	/** 
	*  Lista todos as transacoes retornando um array com todos os itens cadastrados no banco de dados.
	*  Se a função for chamada sem parâmetros, considera que o usuário quer listar todos os itens.
	*/
	public function listarTransacoes($idProsumidor = 0, $limit = 0, $start = 0) {

		// Caso não seja passado nenhum valor limite como parâmetro, inicia a variável com o número total de transacoes cadastradas no banco de dados
		if ($limit == 0) {
			$limit = $this->db->count_all("transacao");
		}
		
		// Inicia a transação
		$this->db->trans_start();
		if($idProsumidor != 0)
			$this->db->where('idProsumidor',$idProsumidor);
		//$this->db->order_by('nome ASC');
		$this->db->limit($limit, $start);
		
		// Realiza a pesquisa no banco de dados e joga os dados na query	
		$query = $this->db->get('transacao');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		$transacoes = array();
		
		// Verifica se encontrou alguma transacao na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $transacoes
			foreach ($query->result() as $row) {
				$transacoes[] = new Transacao(	$row->idTransacao,
												$row->valorTotalRecebido,	
												$row->validacao,
												$row->data,
												$row->idProsumidor,
												$row->nomeVoluntario
											);
			}

			// Retorna o array com todos as transacoes encontrados
			return $transacoes;
		}
		return NULL;
	}
	
	/** 
	*  Obtém todos os dados da transacao baseado no código recebido como parâmetro.
	*/
	public function getTransacao($idTransacao) {

		$this->db->trans_start();
    	
    	// Pesquisa se existe transacao no banco de dados
    	$this->db->where('idTransacao', $idTransacao);
    	
    	// Realiza a pesquisa no banco de dados e joga os dados na query
    	$query = $this->db->get('transacao');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
    	
    	// Caso não tenha encontrado nenhuma transacao, retorna um valor nulo
    	if ($query->num_rows() == 0)
        	return null; 

    	// Caso encontre o dado, pega a linha que contém este transacao
		$row = $query->row();
		
		// Retorna o transacao requisitado
		return new Transacao(	$row->idTransacao,
								$row->valorTotalRecebido,	
								$row->validacao,
								$row->data,
								$row->idProsumidor,
								$row->nomeVoluntario
							);
  	}
	
	/** 
	*  Função que exporta os dados em formato .csv
	*/
	public function exportar($dias) {
		$this->load->dbutil();

		// Prepara os dados para exportação
		$query = $this->db->query(' SELECT PROSUMIDOR.email, TRANSACAO.idTransacao, TRANSACAO.data, TRANSACAO.valorTotalRecebido, 
									PRODUTO.nome, VENDA.qtdVendida, VENDA.valorRecebido, TRANSACAO.nomeVoluntario
									
									FROM prosumidor.transacao AS TRANSACAO, prosumidor.prosumidor AS PROSUMIDOR, prosumidor.venda AS VENDA, 
									prosumidor.produto AS PRODUTO
									
									WHERE VENDA.idTransacao = TRANSACAO.idTransacao AND VENDA.idProduto = PRODUTO.idProduto 
									AND TRANSACAO.idProsumidor = PROSUMIDOR.idProsumidor AND DATEDIFF(CURDATE(),data) >= 0 AND 
									DATEDIFF(CURDATE(),data) <= '.$dias.' ORDER BY TRANSACAO.idTransacao;'
								);
		$delimiter = ";";
		$newline = "\r\n";
		
		// Retorna os dados exportando para o arquivo .csv
		return $this->dbutil->csv_from_result($query, $delimiter, $newline);
	}
}

/* End of file pedido_model.php */
/* Location: ./application/models/pedido_model.php */