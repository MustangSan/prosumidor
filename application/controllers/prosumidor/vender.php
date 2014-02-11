<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * CONTROLLER VENDER
 *---------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas as telas de venda. Tem a função de se comunicar
 * com as models e as views, fazendo as chamadas nos momentos necessários.
 *
 */

class Vender extends CI_Controller {

	/**
	 * Construtor
	 */
	function __construct() {

	 	// Chama todas as models e bibliotecas necessárias no controller
        parent::__construct();
        $this->load->model('Transacao_model');
        $this->load->model('Prosumidor_model', 'Prosumidor');
        $this->load->model('Venda_model');
        $this->load->model('Produto_model');
        $this->load->model('Categoria_model');
        $this->load->model('Classificacao_model');
        $this->load->model('Login_prosumidor_model', 'Login');
        $this->load->library('Dominio');
		
	 	// O usuário só podera executar alguma função na área de compraa se o mesmo estiver logado.
        $this->Login->logged();
    }
	
	/**
	 * Carrega a página inicial da tela de venda
	 */
    public function index() {		
	 	// Carrega a view que lista todos as venda na tela
    	$this->load->view('prosumidor/venda/venda_menu_view');
    }


    public function criarTransacao(){

    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getStatus() == 2 || $prosumidor->getTipo() == 1){
 			redirect('prosumidor/inicio', 'refresh');
 		}

        $this->load->library('form_validation');

	 	// Controla a inserção de dados nos campos de acordo com as regras estabelecidas para cada campo
        $this->form_validation->set_rules('data', 'Data', 'trim|required');

	 	// Se a inserção de dados não for bem sucedida, carrega novamente a view de edição de compra
        if ($this->form_validation->run() == FALSE)
        {
			$data = array(
				'data' 				=> $this->input->post('data')
			);
            $this->load->view('prosumidor/venda/transacao_edit_view', $data);
        }
 
	 	// Caso os dados estiverem de acordo com as regras estabelecidas, insere o propriedade
	 	// no banco de dados por meio da chamada de uma função da model
        else
        {
			$data = new Transacao(NULL, 0, 0, $this->input->post('data'), $this->session->userdata('idProsumidor'), 0 );
			$result = $this->Transacao_model->inserirTransacao($data);
			
	 		// Informa ao usuário que a inserção ocorreu com sucesso e retorna a tela principal da administração
			//$this->session->set_flashdata('result', 'inserirSucesso');
			redirect('prosumidor/vender/transacoes/', 'refresh');
        }  
    }

    public function transacoes(){

        $prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
        if($prosumidor->getTipo() == 1){
            redirect('prosumidor/inicio', 'refresh');
        }

 		$data['transacoes'] = $this->Transacao_model->listarTransacoes($this->session->userdata('idProsumidor'));

 		$this->load->view('prosumidor/venda/transacoes_list_view', $data);
 		
        
    }

    public function transacao($idTransacao){

        $prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
        if($prosumidor->getTipo() == 1){
            redirect('prosumidor/inicio', 'refresh');
        }

    	$data['prosumidor'] = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
    	$data['transacao'] = $this->Transacao_model->getTransacao($idTransacao);
    	$data['vendas'] = $this->Venda_model->listarVendaTransacao($idTransacao);
    	$data['produtos'] = $this->Produto_model->listarProdutos();

    	$this->load->view('prosumidor/venda/transacao_view', $data);
    }

    public function confirmarTransacao($idTransacao){

    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getStatus() == 2 || $prosumidor->getTipo() == 1){
 			redirect('prosumidor/inicio', 'refresh');
 		}

    	$vendas = $this->Venda_model->listarVendaTransacao($idTransacao);
        if(isset($vendas)){
    	   $transacao = $this->Transacao_model->getTransacao($idTransacao);
           
           $transacao->setValidacao(1);
    	   $this->Transacao_model->editarTransacao($transacao);
           redirect('prosumidor/vender/transacoes', 'refresh');
        }
        else
            redirect('prosumidor/vender/transacao/'.$idTransacao, 'refresh');   

    }

    public function fazerVenda($idTransacao){

    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getStatus() == 2 || $prosumidor->getTipo() == 1){
 			redirect('prosumidor/inicio', 'refresh');
 		}
 		
 		$produtos = $this->Produto_model->listarProdutos();
 		$data['produtos'] = $produtos;
 		$data['idTransacao'] = $idTransacao;

 		$this->load->library('form_validation');
 		$this->form_validation->set_rules('qtd', 'Quantidade', 'trim|required');
 		
 		if ($this->form_validation->run() == FALSE)
        {
        	$data['qtd'] = $this->input->post('qtd');
            
            $this->load->view('prosumidor/venda/venda_edit_view', $data);
        }
        else{
            $produto = $this->Produto_model->getProduto($this->input->post('produto'));
            $transacao = $this->Transacao_model->getTransacao($idTransacao);
            $valor = $this->input->post('qtd')*$produto->getPreco();
            $valorTotal = $transacao->getValorTotalRecebido()+$valor;
            $transacao->setValorTotalRecebido($valorTotal);

        	$data = new Venda(NULL, $this->input->post('qtd'), 0, 0, $this->input->post('produto'), $idTransacao);
			$result = $this->Venda_model->inserirVenda($data);
			if($result === FALSE){
                echo 'fail';
			}
            else{
                $this->Transacao_model->editarTransacao($transacao);
                // Informa ao usuário que a inserção ocorreu com sucesso e retorna a tela principal da administração
                //$this->session->set_flashdata('result', 'inserirSucesso');
                redirect('prosumidor/vender/transacao/'.$idTransacao, 'refresh');
            }
        }
    }

    public function editarVenda($idVenda){

        $prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
        if($prosumidor->getStatus() == 2 || $prosumidor->getTipo() == 1){
            redirect('prosumidor/inicio', 'refresh');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('qtd', 'Quantidade', 'trim|required');        
        $venda = $this->Venda_model->getVenda($idVenda);
        $data['idTransacao'] = $venda->getIdTransacao();
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['qtd'] = $venda->getQtdDisponivel();
            
            $this->load->view('prosumidor/venda/venda_edit_view', $data);
        }
        else{
            $transacao = $this->Transacao_model->getTransacao($venda->getIdTransacao());
            $produto = $this->Produto_model->getProduto($venda->getIdProduto());
            
            $valor = $this->input->post('qtd')*$produto->getPreco();
            $v = $venda->getQtdDisponivel()*$produto->getPreco();
            $valorTotal = $transacao->getValorTotalRecebido()-$v;
            $valorTotal = $valorTotal+$valor;
            $transacao->setValorTotalRecebido($valorTotal);

            $venda->setQtdDisponivel($this->input->post('qtd'));

            $result = $this->Venda_model->editarVenda($venda);
            if($result === FALSE)
                echo "fail";
            else
            {
                $this->Transacao_model->editarTransacao($transacao);
                // Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração       
                //$this->session->set_flashdata('result', 'removerSucesso');
                redirect('prosumidor/vender/transacao/'.$venda->getIdTransacao(), 'refresh');
            }
        }

    }

    public function removerVenda($idVenda){

    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getStatus() == 2 || $prosumidor->getTipo() == 1){
 			redirect('prosumidor/inicio', 'refresh');
 		}

        $venda = $this->Venda_model->getVenda($idVenda);
        $produto = $this->Produto_model->getProduto($venda->getIdProduto());
        $transacao = $this->Transacao_model->getTransacao($venda->getIdTransacao());
        
        $valorTotal = $transacao->getValorTotalRecebido()-($venda->getQtdDisponivel()*$produto->getPreco());
        $transacao->setValorTotalRecebido($valorTotal);

		$result = $this->Venda_model->deleteVenda($idVenda);

		if($result === FALSE)
			echo "fail";
		else
		{	
            $this->Transacao_model->editarTransacao($transacao);
	 		// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração		
			//$this->session->set_flashdata('result', 'removerSucesso');
			redirect('prosumidor/vender/transacao/'.$venda->getIdTransacao(), 'refresh');
		}
	}

    public function removerTransacao($idTransacao){
        
        $prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
        if($prosumidor->getStatus() == 2 || $prosumidor->getTipo() == 1){
            redirect('prosumidor/inicio', 'refresh');
        }

        $vendas = $this->Venda_model->listarVendaTransacao($idTransacao);
        if(isset($vendas)){
            foreach ($vendas as $key) {
                $this->Venda_model->deleteVenda($key->getIdVenda());
            }
        }
        $this->Transacao_model->deleteTransacao($idTransacao);
        redirect('prosumidor/vender/transacoes/', 'refresh');
    }

	public function exportar() {
		
    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getStatus() == 2 || $prosumidor->getTipo() == 1){
 			redirect('prosumidor/inicio', 'refresh');
 		}
 		
		$this->load->helper('download');
		
		// Prepara os dados para exportação chamando uma função de auxílio presente na model de administração
		$data = $this->Pedido_model->exportar();

		// Inicia o download dos dados exportados
		force_download('Pedido.csv', $data);
	}
}

/* End of file compra.php */
/* Location: ./application/controllers/prosumidor/compra.php */
