<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * MODEL CATEGORIA
 *---------------------------------------------------------------
 * 
 * Model que trata as funções relacionadas ao objeto Cateforia.
 * Todas as funções que necessitam de acessos ao banco de dados,
 * estão descritas neste arquivo.
 *
 */

class Categoria_model extends CI_Model {	
	
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
        return $this->db->count_all("categoria");
    }
	
	/**
	 * Insere uma categoria no banco de dados
	 */
	public function inserirCategoria($categoria){
		
		// O parâmetro da função deve ser um objeto do tipo 'Categoria'
		if($categoria instanceof Categoria){
			$this->db->trans_start();
			
			// Insere a categoria
			$dados = array ('idCategoria'	 	=> $categoria->getIdCategoria(),
							'nome' 				=> $categoria->getNome(),
							'descricao' 		=> $categoria->getDescricao());
			$this->db->insert('categoria', $dados);
						
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status()) 
				return TRUE;
			return FALSE;
		}
	}
	
	/**
	 * Edita uma categoria no banco de dados
	 */
	public function editarCategoria($categoria) {	

		// O parâmetro da função deve ser um objeto do tipo 'Categoria'
		if($categoria instanceof Categoria){
			$this->db->trans_start();
			
			// Insere uma categoria
			$dados = array ('idCategoria'	 	=> $categoria->getIdCategoria(),
							'nome' 				=> $categoria->getNome(),
							'descricao' 		=> $categoria->getDescricao());
		
			// Pesquisa se existe categoria no banco de dados
			$this->db->where('idCategoria', $categoria->getIdCategoria());
			
			// Atualiza a alteração no banco de dados
			$this->db->update('categoria', $dados);
			
			// Finaliza a transação e fecha a conexão
			$this->db->trans_complete();
			$this->db->close();
			
			if($this->db->trans_status())
				return TRUE;
			return FALSE;
		}	
	}

	/**
	 * Remove uma categoria no banco de dados
	 */
	public function deleteCategoria($idCategoria) {

		$this->db->trans_status();

		// Pesquisa se existe categoria no banco de dados
		$this->db->where('idCategoria', $idCategoria);

		// Deleta o categoria do banco de dados
		$this->db->delete('categoria');
		
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		if($this->db->trans_status())
			return TRUE;
		return FALSE;
	}
	
	/** 
	*  Lista todos as categoria retornando um array com todos os itens cadastrados no banco de dados.
	*  Se a função for chamada sem parâmetros, considera que o usuário quer listar todos os itens.
	*/
	public function listarCategorias($limit = 0, $start = 0) {

		// Caso não seja passado nenhum valor limite como parâmetro, inicia a variável com o número total de categorias cadastradas no banco de dados
		if ($limit == 0) {
			$limit = $this->db->count_all("categoria");
		}
		
		// Inicia a transação
		$this->db->trans_start();
		
		$this->db->order_by('nome ASC');
		$this->db->limit($limit, $start);
		
		// Realiza a pesquisa no banco de dados e joga os dados na query	
		$query = $this->db->get('categoria');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
		
		$categorias = array();
		
		// Verifica se encontrou alguma categoria na query
		if ($query->num_rows() > 0  ) {

			// Joga os resultados dentro da variável $categorias
			foreach ($query->result() as $row) {
				$categorias[] = new Categoria(	$row->idCategoria,
												$row->nome,
												$row->descricao );
			}

			// Retorna o array com todos os categorias encontrados
			return $categorias;
		}
		return NULL;
	}
	
	/** 
	*  Obtém todos os dados da categoria baseado no código recebido como parâmetro.
	*/
	public function getCategoria($idCategoria) {

		$this->db->trans_start();
    	
    	// Pesquisa se existe categoria no banco de dados
    	$this->db->where('idCategoria', $idCategoria);
    	
    	// Realiza a pesquisa no banco de dados e joga os dados na query
    	$query = $this->db->get('categoria');
			
		// Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();
    	
    	// Caso não tenha encontrado nenhuma cateoria, retorna um valor nulo
    	if ($query->num_rows() == 0)
        	return null; 

    	// Caso encontre o dado, pega a linha que contém este categoria
		$row = $query->row();
		
		// Retorna o categoria requisitado
		return new Categoria(	$row->idCategoria,
								$row->nome,
								$row->descricao );
  	}
	
	/** 
	*  Função que exporta os dados em formato .csv
	*/
	public function exportar() {
		$this->load->dbutil();
		
		// Prepara os dados para exportação
		$query = $this->db->get('categoria');
		$delimiter = ";";
		$newline = "\r\n";
		
		// Retorna os dados exportando para o arquivo .csv
		return $this->dbutil->csv_from_result($query, $delimiter, $newline);
	}
}

/* End of file categoria_model.php */
/* Location: ./application/models/categoria_model.php */