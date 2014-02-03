<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * MODEL PROSUMIDOR
 *---------------------------------------------------------------
 * 
 * Model que trata as funções relacionadas ao objeto Prosumidor.
 * Todas as funções que necessitam de acessos ao banco de dados,
 * estão descritas neste arquivo.
 *
 */

class Prosumidor_model extends CI_Model {	
	
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
        return $this->db->count_all("prosumidor");
    }
	
	/**
	 * Insere um prosumidor no banco de dados
	 */
	public function inserirProsumidor($prosumidor){
		
		// O parâmetro da função deve ser um objeto do tipo 'Prosumidor'
		if($prosumidor instanceof Prosumidor){
			$this->db->trans_start();
			
			// Insere um prosumidor
			$dados = array ('idProsumidor' 		=> $prosumidor->getIdProsumidor(),
							'email'				=> $prosumidor->getEmail(),
							'senha' 			=> $prosumidor->getSenha(),
							'nome' 				=> $prosumidor->getNome(),
							'cpf' 				=> $prosumidor->getCPF(),
							'telefone'			=> $prosumidor->getTelefone(),
							'endereco'			=> $prosumidor->getEndereco(),
							'sexo'				=> $prosumidor->getSexo(),
							'status'			=> $prosumidor->getStatus(),
							'tipo'				=> $prosumidor->getTipo(),
							'saldoConsumidor'	=> $prosumidor->getSaldoConsumidor() );
			$this->db->insert('prosumidor', $dados);
						
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status()) 
				return TRUE;
			return FALSE;
		}
	}
	
	/**
	 * Edita um prosumidor no banco de dados
	 */
	public function editarProsumidor($prosumidor) {	

		// O parâmetro da função deve ser um objeto do tipo 'Prosumidor'
		if($prosumidor instanceof Prosumidor){
			$this->db->trans_start();
			
			// Insere um prosumidor
			$dados = array ('idProsumidor' 		=> $prosumidor->getIdProsumidor(),
							'email'				=> $prosumidor->getEmail(),
							'senha' 			=> $prosumidor->getSenha(),
							'nome' 				=> $prosumidor->getNome(),
							'cpf' 				=> $prosumidor->getCPF(),
							'telefone'			=> $prosumidor->getTelefone(),
							'endereco'			=> $prosumidor->getEndereco(),
							'sexo'				=> $prosumidor->getSexo(),
							'status'			=> $prosumidor->getStatus(),
							'tipo'				=> $prosumidor->getTipo(),
							'saldoConsumidor'	=> $prosumidor->getSaldoConsumidor() );
		
			// Pesquisa se existe o prosumidor no banco de dados
			$this->db->where('idProsumidor', $prosumidor->getIdProsumidor());
			
			// Atualiza a alteração no banco de dados
			$this->db->update('prosumidor', $dados);
			
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status())
				return TRUE;
			return FALSE;
		}	
	}

	/**
	 * Remove uma prosumidor no banco de dados
	 */
	public function deleteProsumidor($idProsumidor) {

		$this->db->trans_status();

		// Pesquisa se existe o prosumidor no banco de dados
		$this->db->where('idProsumidor', $idProsumidor);

		// Deleta o prosumidor do banco de dados
		$this->db->delete('prosumidor');
		
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		if($this->db->trans_status())
			return TRUE;
		return FALSE;

	}
	
	/** 
	*  Lista todos as prosumidor retornando um array com todos os itens cadastrados no banco de dados.
	*  Se a função for chamada sem parâmetros, considera que o usuário quer listar todos os itens.
	*/
	public function listarProsumidor($limit = 0, $start = 0) {

		// Caso não seja passado nenhum valor limite como parâmetro, inicia a variável com o número total de prosumidor cadastradas no banco de dados
		if ($limit == 0) {
			$limit = $this->db->count_all("prosumidor");
		}
		
		// Inicia a transação
		$this->db->trans_start();
		
		$this->db->order_by('nome ASC');
		$this->db->limit($limit, $start);
		
		// Realiza a pesquisa no banco de dados e joga os dados na query	
		$query = $this->db->get('prosumidor');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		$prosumidores = array();
		
		// Verifica se encontrou alguma prosumidor na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $prosumidores
			foreach ($query->result() as $row) {
				$prosumidores[] = new Prosumidor(	$row->idProsumidor,
													$row->email,	
													$row->senha,
													$row->nome,
													$row->cpf,
													$row->telefone,
													$row->endereco,
													$row->sexo,
													$row->status,
													$row->tipo,
													$row->saldoConsumidor );
			}

			// Retorna o array com todos as prosumidores encontrados
			return $prosumidores;
		}
		return NULL;
	}
	
	/** 
	*  Obtém todos os dados da prosumidor baseado no código recebido como parâmetro.
	*/
	public function getProsumidor($idProsumidor) {

		$this->db->trans_start();
    	
    	// Pesquisa se existe prosumidor no banco de dados
    	$this->db->where('idProsumidor', $idProsumidor);
    	
    	// Realiza a pesquisa no banco de dados e joga os dados na query
    	$query = $this->db->get('prosumidor');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
    	
    	// Caso não tenha encontrado nenhuma prosumidor, retorna um valor nulo
    	if ($query->num_rows() == 0)
        	return null; 

    	// Caso encontre o dado, pega a linha que contém este prosumidor
		$row = $query->row();
		
		// Retorna o prosumidor requisitado
		return new Prosumidor(	$row->idProsumidor,
								$row->email,	
								$row->senha,
								$row->nome,
								$row->cpf,
								$row->telefone,
								$row->endereco,
								$row->sexo,
								$row->status,
								$row->tipo,
								$row->saldoConsumidor );
  	}
	
	/** 
	*  Função que exporta os dados em formato .csv
	*/
	public function exportar() {
		$this->load->dbutil();
		
		// Prepara os dados para exportação
		$query = $this->db->get('prosumidor');
		$delimiter = ";";
		$newline = "\r\n";
		
		// Retorna os dados exportando para o arquivo .csv
		return $this->dbutil->csv_from_result($query, $delimiter, $newline);
	}
}

/* End of file prosumidor_model.php */
/* Location: ./application/models/prosumidor_model.php */