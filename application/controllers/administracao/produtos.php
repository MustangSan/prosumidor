<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * CONTROLLER PRODUTOS
 *---------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas as telas de produtos. Tem a função de se comunicar
 * com as models e as views, fazendo as chamadas nos momentos necessários.
 *
 */

class Produtos extends CI_Controller {

	/**
	 * Construtor
	 */
	function __construct() {

	 	// Chama todas as models e bibliotecas necessárias no controller
        parent::__construct();
        $this->load->model('Produto_model');
        $this->load->model('Categoria_model');
        $this->load->model('Classificacao_model');
        $this->load->model('Login_administracao_model', 'Login');
        $this->load->library('Dominio');
		$this->load->library('upload');
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('form');		
		
	 	// O usuário só podera executar alguma função na área de administradores se o mesmo estiver logado.
        $this->Login->logged();
    }

	/**
	 * Carrega a página inicial da tela de Produtos
	 */
    public function index() {		
 
	 	// Salva na variável $data os itens que serão carregados
        $data['produtos'] = $this->Produto_model->listarProdutos();
        $data['categorias'] = $this->Categoria_model->listarCategorias();
		 
	 	// Carrega a view que lista todas as categorias na tela
    	$this->load->view('administracao/produtos/produto_list_view', $data);
    }

    /** 
	* Função que controla a inserção de um produto no banco de dados
	*/
	public function inserirProduto(){
		$this->load->library('form_validation');

		$config['upload_path'] = './images/produtos/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$this->load->library('upload');
		$this->upload->initialize($config);

	 	// Controla a inserção de dados nos campos de acordo com as regras estabelecidas para cada campo
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('preco', 'Preco', 'trim|required');
        $this->form_validation->set_rules('validade', 'Validade', 'trim|required');
        $this->form_validation->set_rules('unidade', 'Unidade', 'trim|required');
        $this->form_validation->set_rules('disponibilidade', 'Disponibilidade', 'trim|required');
        $this->form_validation->set_rules('descricao', 'Descricao', 'trim|required');
        //$this->form_validation->set_rules('idCategoria', 'IdCategoria', 'trim|required');

        // Se a inserção de dados não for bem sucedida, carrega novamente a view de edição de produtos
        if ($this->form_validation->run() == FALSE)
        {
			$data = array(
				'nome' 				=> $this->input->post('nome'),
				'preco' 			=> $this->input->post('preco'),
				'validade' 			=> $this->input->post('validade'),
				'unidade' 			=> $this->input->post('unidade'),
				'disponibilidade' 	=> $this->input->post('disponibilidade'),
				'descricao' 		=> $this->input->post('descricao')
				//'idCategoria' 		=> $this->input->post('idCategoria')
			);
			$categorias = $this->Categoria_model->listarCategorias();
			$tipos = array();
			if(isset($categorias)) {
				foreach($categorias as $t){
					$tipos[$t->getIdCategoria()] = $t->getNome();
				}
				$data['categorias'] = $tipos;
			}
			$data['id'] = 0;
            $this->load->view('administracao/produtos/produto_edit_view', $data);
        }

        // Caso os dados estiverem de acordo com as regras estabelecidas, insere o produto
	 	// no banco de dados por meio da chamada de uma função da model
        else
        {
			if ($this->upload->do_upload() == TRUE) {
        		$upload_data = $this->upload->data();
    			$nome_do_arquivo_gravado = $upload_data['file_name'];
			}
			else
				$nome_do_arquivo_gravado = '0';

			$data = new Produto(NULL, $this->input->post('nome'), 
									$this->input->post('preco'), 
									$this->input->post('validade'), 
									$this->input->post('unidade'), 
									$this->input->post('disponibilidade'), 
									$this->input->post('descricao'), 
									$this->input->post('idCategoria'),
									$nome_do_arquivo_gravado
								);

			$resultado = $this->Produto_model->inserirProduto($data);
			
	 		// Informa ao usuário que a inserção ocorreu com sucesso e retorna a tela principal da administração
			//$this->session->set_flashdata('result', 'inserirSucesso');
			redirect('administracao/produtos', 'refresh');
        }

	}

    /** 
	* Função que controla a edição de um produto no banco de dados. A função recebe
	* como parâmetro um código do produto que será editado
	*/
    public function editarProduto($idProduto){
        $this->load->library('form_validation');

		$config['upload_path'] = './images/produtos/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		// Busca por meio de uma função da model o produto desejado e guarda na variável $produto
        $produto = $this->Produto_model->getProduto($idProduto);

	 	// Controla a inserção de dados nos campos de acordo com as regras estabelecidas para cada campo
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('preco', 'Preco', 'trim|required');
        $this->form_validation->set_rules('validade', 'Validade', 'trim|required');
        $this->form_validation->set_rules('unidade', 'Unidade', 'trim|required');
        $this->form_validation->set_rules('disponibilidade', 'Disponibilidade', 'trim|required');
        $this->form_validation->set_rules('descricao', 'Descricao', 'trim|required');
        //$this->form_validation->set_rules('idCategoria', 'IdCategoria', 'trim|required');
		 
        if($this->form_validation->run() == FALSE)
        {
			$data = array(
				'nome' 				=> $produto->getNome(),
				'preco'				=> $produto->getPreco(),
				'validade'			=> $produto->getValidade(),
				'unidade'			=> $produto->getUnidade(),
				'disponibilidade'	=> $produto->getDisponibilidade(),
				'descricao' 		=> $produto->getDescricao(),
				'idCategoria'		=> $produto->getIdCategoria()
			);
			
			$categorias = $this->Categoria_model->listarCategorias();
			$tipos = array();
			if(isset($categorias)) {
				foreach($categorias as $t){
					$tipos[$t->getIdCategoria()] = $t->getNome();
				}
				$data['categorias'] = $tipos;
			}
			$data['id'] = $produto->getIdCategoria();
	 		// Se a inserção dos novos valores não for bem sucedida, atribui os valores da variável $produto
	 		// à variável $dados. Caso a variável $dados esteja vazia, ele a elimina
            $dados['produto'] = $produto;
            if($dados['produto'] == NULL) {
                unset($dados['produto']);
			}

	 		// Carrega a view de edição de administradores passando o valor que está na variável $data
            $this->load->view('administracao/produtos/produto_edit_view', $data);
        }
        else {
			
			if ($this->upload->do_upload() == TRUE) {
        		$upload_data = $this->upload->data();
    			$nome_do_arquivo_gravado = $upload_data['file_name'];
			}
			else
				$nome_do_arquivo_gravado = $produto->getFoto();
    		
	 		// Cria um novo prodotp com as informações editadas e grava na variável $data
			$data = new Produto($produto->getIdProduto(), 
									$this->input->post('nome'), 
									$this->input->post('preco'), 
									$this->input->post('validade'), 
									$this->input->post('unidade'), 
									$this->input->post('disponibilidade'), 
									$this->input->post('descricao'), 
									$this->input->post('idCategoria'),
									$nome_do_arquivo_gravado
								);
             
	 		// Chama a model de edição de produto passando como parâmetro os dados editados
			$result = $this->Produto_model->editarProduto($data);
			
            if($result === FALSE)
                echo "fail";
            else
            {	
	 			// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal do	prduto
				//$this->session->set_flashdata('result', 'editarSucesso');
				redirect('administracao/produtos', 'refresh');
            }
        }
    }

    /** 
	* Função que controla a remoção de um produto do banco de dados. A função recebe
	* como parâmetro o código do produto que será removido
	*/
    public function removerProduto($idProduto){

		$result = $this->Produto_model->deleteProduto($idProduto);

		if($result === FALSE)
			echo "fail";
		else
		{		
	 		// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração		
			//$this->session->set_flashdata('result', 'removerSucesso');
			redirect('administracao/produtos', 'refresh');
		}
	}

	public function adicionarClassificacao($idProduto){
		/*$result = $this->Produto_model->inserirClassProduto($idProduto,3);
		if($result === FALSE)
        	echo "fail";
		else
		{		
	 		// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração		
			//$this->session->set_flashdata('result', 'removerSucesso');
			redirect('administracao/produtos', 'refresh');
		}*/
		$this->load->library('form_validation');

		//$numClass = $this->Classificacao_model->record_count();
		//$data['numClass'] = $numClass;
		$class = $this->Classificacao_model->listarClassificacoes();
		$idsClass = $this->Produto_model->listarClassificacoes($idProduto);
		$data['class'] = $class;
		$data['idsClass'] = $idsClass;
		$data['idProduto'] = $idProduto;

		//if($this->form_validation->run() == FALSE) {

			$this->load->view('administracao/produtos/produto_adicionarclass_view', $data);
		//}
		
		/*else{
			if(isset($class)){
				foreach ($class as $key ) {
					$idClassificacao = $this->input->post('classi');
					$result = $this->Produto_model->inserirClassProduto($idProduto,$idClassificacao);
				}
			}
			else{
				echo "alguma coisa errada";
			}
			// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal do	prduto
			//$this->session->set_flashdata('result', 'editarSucesso');
			redirect('administracao/produtos', 'refresh');
		}*/
	}

	public function addBD($idProduto){
		$class = $this->Classificacao_model->listarClassificacoes();
		$idsClass = $this->Produto_model->listarClassificacoes($idProduto);

		$data['class'] = $class;
		$data['idsClass'] = $idsClass;

		/*if(isset($class)){
			if(isset($idsClass)){
				foreach ($class as $k) {
					foreach($idsClass as $a){
						if($k->getIdClassificacao() == $a['idClassificacao'])
							$dadoClass[] = array($key->getIdClassificacao() => TRUE);
						
						}
				}
			}
		}*/
		
		if(isset($class)){
				foreach ($class as $key ){
					$c = $key->getIdClassificacao();
					$value = $this->input->post('classi'.$c);
					if($value == 1){
						//if(!$this->Produto_model->jaExiste($idProduto, $key->getIdClassificacao())){
							$result = $this->Produto_model->inserirClassProduto($idProduto,$key->getIdClassificacao());
						//}
						//else{
							//$result = $this->Produto_model->inserirClassProduto($idProduto,$key->getIdClassificacao());
						//}
					}
					else{//if($value == 0){
						//if($this->Produto_model->jaExiste($idProduto, $key->getIdClassificacao())){
							$result = $this->Produto_model->removeClassProduto($idProduto, $key->getIdClassificacao());
						//}
					}
				}
			}
			else{
				echo "alguma coisa errada";
			}
		redirect('administracao/produtos', 'refresh');
	}



	public function exportar() {
		$this->load->helper('download');
		
		// Prepara os dados para exportação chamando uma função de auxílio presente na model de administração
		$data = $this->Produto_model->exportar();

		// Inicia o download dos dados exportados
		force_download('Produtos.csv', $data);
	}
}

/* End of file produtos.php */
/* Location: ./application/controllers/administracao/produtos.php */
