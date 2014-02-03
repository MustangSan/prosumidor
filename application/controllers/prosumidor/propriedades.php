<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * CONTROLLER PROPRIEDADES
 *---------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas as telas de propriedades. Tem a função de se comunicar
 * com as models e as views, fazendo as chamadas nos momentos necessários.
 *
 */

class Propriedades extends CI_Controller {

	/**
	 * Construtor
	 */
	function __construct() {

	 	// Chama todas as models e bibliotecas necessárias no controller
        parent::__construct();
        $this->load->model('Propriedade_model');
        $this->load->model('Prosumidor_model','Prosumidor');
        $this->load->model('Login_prosumidor_model', 'Login');
        $this->load->library('Dominio');
		
	 	// O usuário só podera executar alguma função na área de propriedades se o mesmo estiver logado.
        $this->Login->logged();
    }
	
	/**
	 * Carrega a página inicial da tela de propriedades
	 */
    public function index() {		
 		$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getTipo() == 1){
 			redirect('prosumidor/inicio', 'refresh');
 		}
	 	// Salva na variável $data os itens que serão carregados
        $data['propriedades'] = $this->Propriedade_model->listarPropriedades();
		 
	 	// Carrega a view que lista todos as propriedades na tela
    	$this->load->view('prosumidor/propriedades/propriedades_list_view', $data);
    }

    /** 
	* Função que controla a inserção de um propriedade no banco de dados
	*/
    public function inserirPropriedade(){

    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getTipo() == 1){
 			redirect('prosumidor/inicio', 'refresh');
 		}

        $this->load->library('form_validation');

	 	// Controla a inserção de dados nos campos de acordo com as regras estabelecidas para cada campo
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('endereco', 'Endereco', 'trim|required');
        $this->form_validation->set_rules('tamanho', 'Tamanho', 'trim|required');

	 	// Se a inserção de dados não for bem sucedida, carrega novamente a view de edição de propriedades
        if ($this->form_validation->run() == FALSE)
        {
			$data = array(
				'nome' 				=> $this->input->post('nome'),
				'endereco' 			=> $this->input->post('endereco'),
				'tamanho' 			=> $this->input->post('tamanho')
			);
            $this->load->view('prosumidor/propriedades/propriedades_edit_view', $data);
        }
 
	 	// Caso os dados estiverem de acordo com as regras estabelecidas, insere o propriedade
	 	// no banco de dados por meio da chamada de uma função da model
        else
        {
			$data = new Propriedade(NULL, $this->input->post('nome'), $this->input->post('endereco'), $this->input->post('tamanho'), 
									$this->session->userdata('idProsumidor') );
			$resultado = $this->Propriedade_model->inserirPropriedade($data);
			
	 		// Informa ao usuário que a inserção ocorreu com sucesso e retorna a tela principal da administração
			//$this->session->set_flashdata('result', 'inserirSucesso');
			redirect('prosumidor/propriedades', 'refresh');
        }  
    }

    /** 
	* Função que controla a edição de um propriedade no banco de dados. A função recebe
	* como parâmetro um código do propriedade que será editado
	*/
    public function editarPropriedade($idPropriedade){

    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getTipo() == 1){
 			redirect('prosumidor/inicio', 'refresh');
 		}
 		
        $this->load->library('form_validation');
		
		// Busca por meio de uma função da model o propriedade desejado e guarda na variável $propriedade
        $propriedade = $this->Propriedade_model->getPropriedade($idPropriedade);

	 	// Controla a inserção de dados nos campos de acordo com as regras estabelecidas para cada campo
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('endereco', 'Endereco', 'trim|required');
        $this->form_validation->set_rules('tamanho', 'Tamanho', 'trim|required');

	 	// Se a inserção de dados não for bem sucedida, carrega novamente a view de edição de propriedades
        if ($this->form_validation->run() == FALSE)
        {
			$data = array(
				'nome' 				=> $propriedade->getNome(),
				'endereco' 			=> $propriedade->getEndereco(),
				'tamanho' 			=> $propriedade->getTamanho()
			);
	 		
	 		// Se a inserção dos novos valores não for bem sucedida, atribui os valores da variável $propriedade
	 		// à variável $dados. Caso a variável $dados esteja vazia, ele a elimina
            $dados['propriedade'] = $propriedade;
            if($dados['propriedade'] == NULL) {
                unset($dados['propriedade']);
			}


            $this->load->view('prosumidor/propriedades/propriedades_edit_view', $data);
        }	

        else {
			
	 		// Cria um novo propriedade com as informações editadas e grava na variável $data
			$data = new Propriedade($propriedade->getIdPropriedade(), $this->input->post('nome'), $this->input->post('endereco'), 
									$this->input->post('tamanho'), $this->session->userdata('idProsumidor'));
             
	 		// Chama a model de edição de propriedade passando como parâmetro os dados editados
			$result = $this->Propriedade_model->editarPropriedade($data);
			
            if($result === FALSE)
                echo "fail";
            else
            {	
	 			// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração			
				//$this->session->set_flashdata('result', 'editarSucesso');
				redirect('prosumidor/propriedades', 'refresh');
            }
        }
    }

    /** 
	* Função que controla a remoção de um propriedade do banco de dados. A função recebe
	* como parâmetro o código do propriedade que será removido
	*/
    public function removerPropriedade($idPropriedade){

    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getTipo() == 1){
 			redirect('prosumidor/inicio', 'refresh');
 		}
 		
		$result = $this->Propriedade_model->deletePropriedade($idPropriedade);

		if($result === FALSE)
			echo "fail";
		else
		{		
	 		// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração		
			//$this->session->set_flashdata('result', 'removerSucesso');
			redirect('prosumidor/propriedades', 'refresh');
		}
	}

	public function exportar() {
		
    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getTipo() == 1){
 			redirect('prosumidor/inicio', 'refresh');
 		}
 		
		$this->load->helper('download');
		
		// Prepara os dados para exportação chamando uma função de auxílio presente na model de administração
		$data = $this->Propriedade_model->exportar();

		// Inicia o download dos dados exportados
		force_download('Propriedades.csv', $data);
	}
}

/* End of file propriedade.php */
/* Location: ./application/controllers/prosumidor/propriedade.php */
