<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * CONTROLLER CLASSIFICACOES
 *---------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas as telas de classificacao. Tem a função de se comunicar
 * com as models e as views, fazendo as chamadas nos momentos necessários.
 *
 */

class Classificacoes extends CI_Controller {

	/**
	 * Construtor
	 */
	function __construct() {

	 	// Chama todas as models e bibliotecas necessárias no controller
        parent::__construct();
        $this->load->model('Classificacao_model');
        $this->load->model('Login_administracao_model', 'Login');
        $this->load->library('Dominio');
		
	 	// O usuário só podera executar alguma função na área de administradores se o mesmo estiver logado.
        $this->Login->logged();
    }
	
	/**
	 * Carrega a página inicial da tela de classificacoes
	 */
    public function index() {		
 
	 	// Salva na variável $data os itens que serão carregados
        $data['classificacoes'] = $this->Classificacao_model->listarClassificacoes();
		 
	 	// Carrega a view que lista todas as categorias na tela
    	$this->load->view('administracao/classificacao/classificacao_list_view', $data);
    }

    /** 
	* Função que controla a inserção de uma classificacao no banco de dados
	*/
    public function inserirClassificacao(){
        $this->load->library('form_validation');

	 	// Controla a inserção de dados nos campos de acordo com as regras estabelecidas para cada campo
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('descricao', 'Descricao', 'trim|required');
		

	 	// Se a inserção de dados não for bem sucedida, carrega novamente a view de edição de administradores
        if ($this->form_validation->run() == FALSE)
        {
			$data = array(
				'nome' 		=> $this->input->post('nome'),
				'descricao' => $this->input->post('descricao')
			);
            $this->load->view('administracao/classificacao/classificacao_edit_view', $data);
        }
 
	 	// Caso os dados estiverem de acordo com as regras estabelecidas, insere a classificacao
	 	// no banco de dados por meio da chamada de uma função da model
        else
        {
			$data = new Classificacao(NULL, $this->input->post('nome'), $this->input->post('descricao'));
			$resultado = $this->Classificacao_model->inserirClassificacao($data);
			
	 		// Informa ao usuário que a inserção ocorreu com sucesso e retorna a tela principal da administração
			//$this->session->set_flashdata('result', 'inserirSucesso');
			redirect('administracao/classificacoes', 'refresh');
        }  
    }

    /** 
	* Função que controla a edição de uma classificacao no banco de dados. A função recebe
	* como parâmetro um código da classificacao que será editado
	*/
    public function editarClassificacao($idClassificacao){
        $this->load->library('form_validation');
		
		// Busca por meio de uma função da model a classificacao desejado e guarda na variável $classificacao
        $classificacao = $this->Classificacao_model->getClassificacao($idClassificacao);

	 	// Controla a inserção de dados nos campos de acordo com as regras estabelecidas para cada campo
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('descricao', 'Descricao', 'trim|required');
		 
        if($this->form_validation->run() == FALSE)
        {
			$data = array(
				'nome' 		=> $classificacao->getNome(),
				'descricao' => $classificacao->getDescricao(),
			);
			
	 		// Se a inserção dos novos valores não for bem sucedida, atribui os valores da variável $classificacao
	 		// à variável $dados. Caso a variável $dados esteja vazia, ele a elimina
            $dados['classificacao'] = $classificacao;
            if($dados['classificacao'] == NULL) {
                unset($dados['classificacao']);
			}

	 		// Carrega a view de edição de administradores passando o valor que está na variável $data
            $this->load->view('administracao/classificacao/classificacao_edit_view', $data);
        }
        else {

	 		// Cria um novo administrador com as informações editadas e grava na variável $data
			$data = new Classificacao($classificacao->getIdClassificacao(), $this->input->post('nome'), $this->input->post('descricao'));
             
	 		// Chama a model de edição de administrador passando como parâmetro os dados editados
			$result = $this->Classificacao_model->editarClassificacao($data);
			
            if($result === FALSE)
                echo "fail";
            else
            {	
	 			// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração			
				//$this->session->set_flashdata('result', 'editarSucesso');
				redirect('administracao/classificacoes', 'refresh');
            }
        }
    }

    /** 
	* Função que controla a remoção de um administrador do banco de dados. A função recebe
	* como parâmetro o código do administrador que será removido
	*/
    public function removerClassificacao($idClassificacao){

		$result = $this->Classificacao_model->deleteClassificacao($idClassificacao);

		if($result === FALSE)
			echo "fail";
		else
		{		
	 		// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração		
			//$this->session->set_flashdata('result', 'removerSucesso');
			redirect('administracao/classificacoes', 'refresh');
		}
	}

	public function exportar() {
		$this->load->helper('download');
		
		// Prepara os dados para exportação chamando uma função de auxílio presente na model de administração
		$data = $this->Classificacao_model->exportar();

		// Inicia o download dos dados exportados
		force_download('Categorias.csv', $data);
	}
}

/* End of file categorias.php */
/* Location: ./application/controllers/administracao/categorias.php */
