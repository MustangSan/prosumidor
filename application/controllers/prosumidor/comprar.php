<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * CONTROLLER COMPRAR
 *---------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas as telas de compra. Tem a função de se comunicar
 * com as models e as views, fazendo as chamadas nos momentos necessários.
 *
 */

class Comprar extends CI_Controller {

	/**
	 * Construtor
	 */
	function __construct() {

	 	// Chama todas as models e bibliotecas necessárias no controller
        parent::__construct();
        $this->load->model('Pedido_model');
        $this->load->model('Prosumidor_model','Prosumidor');
        $this->load->model('Compra_model');
        $this->load->model('Produto_model');
        $this->load->model('Categoria_model');
        $this->load->model('Classificacao_model');
        $this->load->model('Login_prosumidor_model', 'Login');
        $this->load->library('Dominio');
		
	 	// O usuário só podera executar alguma função na área de compraa se o mesmo estiver logado.
        $this->Login->logged();
    }
	
	/**
	 * Carrega a página inicial da tela de compra
	 */
    public function index() {		
	 	// Carrega a view que lista todos as compra na tela
    	$this->load->view('prosumidor/compra/compra_menu_view');
    }


    public function criarPedido(){

    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getStatus() == 2){
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
            $this->load->view('prosumidor/compra/pedido_edit_view', $data);
        }
 
	 	// Caso os dados estiverem de acordo com as regras estabelecidas, insere o propriedade
	 	// no banco de dados por meio da chamada de uma função da model
        else
        {
			$data = new Pedido(NULL, 0, 0, $this->input->post('data'), $this->session->userdata('idProsumidor'), 0 );
			$result = $this->Pedido_model->inserirPedido($data);
			
	 		// Informa ao usuário que a inserção ocorreu com sucesso e retorna a tela principal da administração
			//$this->session->set_flashdata('result', 'inserirSucesso');
			redirect('prosumidor/comprar/pedidos/', 'refresh');
        }  
    }

    public function pedidos(){

 		$data['pedidos'] = $this->Pedido_model->listarPedidos($this->session->userdata('idProsumidor'));

 		$this->load->view('prosumidor/compra/pedidos_list_view', $data);
 		
        
    }

    public function pedido($idPedido){
    	
    	$data['prosumidor'] = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
    	$data['pedido'] = $this->Pedido_model->getPedido($idPedido);
    	$data['compras'] = $this->Compra_model->listarComprasPedido($idPedido);
    	$data['produtos'] = $this->Produto_model->listarProdutos();

    	$this->load->view('prosumidor/compra/pedido_view', $data);
    }

    public function confirmarPedido($idPedido){

    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getStatus() == 2){
 			redirect('prosumidor/inicio', 'refresh');
 		}

    	$compras = $this->Compra_model->listarComprasPedido($idPedido);
        if(isset($compras)){
    	   $pedido = $this->Pedido_model->getPedido($idPedido);
           
           $saldo = $prosumidor->getSaldoConsumidor()+$pedido->getValorTotal();
           $prosumidor->setSaldoConsumidor($saldo);
           $this->Prosumidor->editarProsumidor($prosumidor);
    	   

           $pedido->setValidacao(1);
    	   $this->Pedido_model->editarPedido($pedido);
           redirect('prosumidor/comprar/pedidos', 'refresh');
        }
        else
            redirect('prosumidor/comprar/pedido/'.$idPedido, 'refresh');   

    }

    public function fazerComprar($idPedido){

    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getStatus() == 2){
 			redirect('prosumidor/inicio', 'refresh');
 		}
 		
 		$produtos = $this->Produto_model->listarProdutos();
 		$data['produtos'] = $produtos;
 		$data['idPedido'] = $idPedido;

 		$this->load->library('form_validation');
 		$this->form_validation->set_rules('qtd', 'Quantidade', 'trim|required');
 		
 		if ($this->form_validation->run() == FALSE)
        {
        	$data['qtd'] = $this->input->post('qtd');
            
            $this->load->view('prosumidor/compra/compra_edit_view', $data);
        }
        else{
        	$produto = $this->Produto_model->getProduto($this->input->post('produto'));
        	$pedido = $this->Pedido_model->getPedido($idPedido);
        	$valor = $this->input->post('qtd')*$produto->getPreco();
        	$valorTotal = $pedido->getValorTotal()+$valor;
        	$pedido->setValorTotal($valorTotal);

        	$data = new Compra(NULL, $this->input->post('qtd'), $valor, $this->input->post('produto'), $idPedido);
			$result = $this->Compra_model->inserirCompra($data);
			if($result){
				$this->Pedido_model->editarPedido($pedido);
	 			// Informa ao usuário que a inserção ocorreu com sucesso e retorna a tela principal da administração
				//$this->session->set_flashdata('result', 'inserirSucesso');
				redirect('prosumidor/comprar/pedido/'.$idPedido, 'refresh');
			}
        }
    }

    public function editarCompra($idCompra){

        $prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
        if($prosumidor->getStatus() == 2){
            redirect('prosumidor/inicio', 'refresh');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('qtd', 'Quantidade', 'trim|required');        
        $compra = $this->Compra_model->getCompra($idCompra);
        $data['idPedido'] = $compra->getIdPedido();
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['qtd'] = $compra->getQtdComprada();
            
            $this->load->view('prosumidor/compra/compra_edit_view', $data);
        }
        else{
            
            
            $pedido = $this->Pedido_model->getPedido($compra->getIdPedido());
            $produto = $this->Produto_model->getProduto($compra->getIdProduto());
            
            $valor = $this->input->post('qtd')*$produto->getPreco();
            $valorTotal = $pedido->getValorTotal()-$compra->getValor();
            $valorTotal = $valorTotal+$valor;
            $compra->setValor($valor);
            $compra->setQtdComprada($this->input->post('qtd'));
            $pedido->setValorTotal($valorTotal);

            $result = $this->Compra_model->editarCompra($compra);
            if($result === FALSE)
                echo "fail";
            else
            {   
                $this->Pedido_model->editarPedido($pedido);
                // Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração       
                //$this->session->set_flashdata('result', 'removerSucesso');
                redirect('prosumidor/comprar/pedido/'.$compra->getIdPedido(), 'refresh');
            }
        }

    }

    public function removerCompra($idCompra){

    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getStatus() == 2){
 			redirect('prosumidor/inicio', 'refresh');
 		}

 		$compra = $this->Compra_model->getCompra($idCompra);
        $pedido = $this->Pedido_model->getPedido($compra->getIdPedido());
        $valorTotal = $pedido->getValorTotal()-$compra->getValor();
        $pedido->setValorTotal($valorTotal);

		$result = $this->Compra_model->deleteCompra($idCompra);

		if($result === FALSE)
			echo "fail";
		else
		{	
            $this->Pedido_model->editarPedido($pedido);
	 		// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração		
			//$this->session->set_flashdata('result', 'removerSucesso');
			redirect('prosumidor/comprar/pedido/'.$compra->getIdPedido(), 'refresh');
		}
	}

    public function removerPedido($idPedido){
        
        $prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
        if($prosumidor->getStatus() == 2){
            redirect('prosumidor/inicio', 'refresh');
        }
        
        $compras = $this->Compra_model->listarComprasPedido($idPedido);
        if(isset($compras)){
            foreach ($compras as $key) {
                $this->Compra_model->deleteCompra($key->getIdCompra());
            }
        }
        $this->Pedido_model->deletePedido($idPedido);
        redirect('prosumidor/comprar/pedidos/', 'refresh');
    }

	public function exportar() {
		
    	$prosumidor = $this->Prosumidor->getProsumidor($this->session->userdata('idProsumidor'));
 		if($prosumidor->getStatus() == 2){
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
