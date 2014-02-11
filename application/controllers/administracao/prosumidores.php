<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * CONTROLLER PROSUMIDORES
 *---------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas as telas de prosumidor. Tem a função de se comunicar
 * com as models e as views, fazendo as chamadas nos momentos necessários.
 *
 */

class Prosumidores extends CI_Controller {

	/**
	 * Construtor
	 */
	function __construct() {

	 	// Chama todas as models e bibliotecas necessárias no controller
        parent::__construct();
        $this->load->model('Prosumidor_model');
        $this->load->model('Propriedade_model');
        $this->load->model('Pedido_model');
        $this->load->model('Compra_model');
        $this->load->model('Transacao_model');
        $this->load->model('Venda_model');
        $this->load->model('Produto_model');
        $this->load->model('Login_administracao_model', 'Login');
        $this->load->library('Dominio');
		
	 	// O usuário só podera executar alguma função na área de administradores se o mesmo estiver logado.
        $this->Login->logged();
    }
	
	/**
	 * Carrega a página inicial da tela de administradores
	 */
    public function index() {		
 
	 	// Salva na variável $data os itens que serão carregados
        $data['prosumidor'] = $this->Prosumidor_model->listarProsumidor();
		 
	 	// Carrega a view que lista todos os administradores na tela
    	$this->load->view('administracao/prosumidores/prosumidor_list_view', $data);
    }

    public function listarDados($idProsumidor){

        $prosumidor = $this->Prosumidor_model->getProsumidor($idProsumidor);
    	$data['prosumidor'] = $prosumidor;
        if($prosumidor->getTipo() == 2)
    	   $data['propriedades'] = $this->Propriedade_model->listarPropriedadesIdProsumidor($idProsumidor);
		 
	 	// Carrega a view que lista todos as propriedades na tela
    	$this->load->view('administracao/prosumidores/dadosprosumidor_list_view', $data);
    }

    public function desbloquear($idProsumidor){

    	$prosumidor = $this->Prosumidor_model->getProsumidor($idProsumidor);

		$prosumidor->setStatus(1);

		$result = $this->Prosumidor_model->editarProsumidor($prosumidor);

        if($result === FALSE)
            echo "fail";
        else
        {	
 			// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração			
			//$this->session->set_flashdata('result', 'editarSucesso');
			redirect('administracao/prosumidores', 'refresh');
        }
    }

    public function bloquear($idProsumidor){

    	$prosumidor = $this->Prosumidor_model->getProsumidor($idProsumidor);

		$prosumidor->setStatus(2);

		$result = $this->Prosumidor_model->editarProsumidor($prosumidor);

        if($result === FALSE)
            echo "fail";
        else
        {	
 			// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração			
			//$this->session->set_flashdata('result', 'editarSucesso');
			redirect('administracao/prosumidores', 'refresh');
        }
    }

    public function pedidos($idProsumidor){
        $data['pedidos'] = $this->Pedido_model->listarPedidos($idProsumidor);
        $data['idProsumidor'] = $idProsumidor;
        $this->load->view('administracao/prosumidores/pedidos_list_view', $data);
    }

    public function pedido($idPedido){
        //$data['prosumidor'] = $this->Prosumidor->getProsumidor();
        $pedido = $this->Pedido_model->getPedido($idPedido);
        $data['pedido'] = $pedido;
        $data['compras'] = $this->Compra_model->listarComprasPedido($idPedido);
        $data['produtos'] = $this->Produto_model->listarProdutos();
        $data['idProsumidor'] = $pedido->getIdProsumidor();

        $this->load->view('administracao/prosumidores/pedido_view', $data);
    }

    public function concluirPedido($idPedido){

        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');

        $pedido = $this->Pedido_model->getPedido($idPedido);
        $data['idProsumidor'] = $pedido->getIdProsumidor();
        $data['i'] = 1;
        if ($this->form_validation->run() == FALSE)
        {
            $data['nome'] = $this->input->post('nome');
            
            $this->load->view('administracao/prosumidores/voluntario_view', $data);
        }
        else{
            $pedido->setValidacao(2);
            $pedido->setNomeVoluntario($this->input->post('nome'));
            $prosumidor = $this->Prosumidor_model->getProsumidor($pedido->getIdProsumidor());
            $saldo = $prosumidor->getSaldoConsumidor()-$pedido->getValorTotal();
            $prosumidor->setSaldoConsumidor($saldo);
            $this->Prosumidor_model->editarProsumidor($prosumidor);

            $result = $this->Pedido_model->editarPedido($pedido);
            if($result){
                redirect('administracao/prosumidores/pedidos/'.$pedido->getIdProsumidor());
            }
        }
    }

    
    public function transacoes($idProsumidor){
        $data['transacoes'] = $this->Transacao_model->listarTransacoes($idProsumidor);
        $data['idProsumidor'] = $idProsumidor;
        $this->load->view('administracao/prosumidores/transacoes_list_view', $data);
    }


    public function transacao($idTransacao){
        //$data['prosumidor'] = $this->Prosumidor->getProsumidor();
        $transacao = $this->Transacao_model->getTransacao($idTransacao);
        $data['transacao'] = $transacao;
        $data['vendas'] = $this->Venda_model->listarVendaTransacao($idTransacao);
        $data['produtos'] = $this->Produto_model->listarProdutos();
        $data['idProsumidor'] = $transacao->getIdProsumidor();

        $this->load->view('administracao/prosumidores/transacao_view', $data);
    }

    public function confirmarVenda($idVenda){
        
        $venda = $this->Venda_model->getVenda($idVenda);
        $data['idTransacao'] = $venda->getIdTransacao();
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('qtd', 'Quantidade', 'trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['qtd'] = $this->input->post('qtd');
            
            $this->load->view('administracao/prosumidores/confirmarVenda_view', $data);
        }  
        else{
            $produto = $this->Produto_model->getProduto($venda->getIdProduto());

            $valor = $produto->getPreco()*$this->input->post('qtd');
            
            $venda->setQtdVendida($this->input->post('qtd'));
            $venda->setValorRecebido($valor);
            $result = $this->Venda_model->editarVenda($venda);
            if($result === FALSE){
                echo 'fail';
            }
            else
                redirect('administracao/prosumidores/transacao/'.$venda->getIdTransacao());
        }     
    }

    public function concluirTransacao($idTransacao){
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        
        $transacao = $this->Transacao_model->getTransacao($idTransacao);
        $data['idProsumidor'] = $transacao->getIdProsumidor();
        $data['i'] = 2;
        $vendas = $this->Venda_model->listarVendaTransacao($idTransacao);

        if(isset($vendas)){
            foreach ($vendas as $key) {
                if($key->getQtdVendida() == 0)
                    redirect('administracao/prosumidores/transacao/'.$idTransacao);
            }
        }
        if ($this->form_validation->run() == FALSE)
        {
            $data['nome'] = $this->input->post('nome');
            
            $this->load->view('administracao/prosumidores/voluntario_view', $data);
        }
        else{
            
            $valor = 0;
            if(isset($vendas)){
                foreach ($vendas as $key) {
                    if($key->getQtdVendida() == 0)
                        redirect('administracao/prosumidores/transacao/'.$idTransacao);
                    $valor = $valor+$key->getValorRecebido();
                }
            }
            $transacao->setValorTotalRecebido($valor);
            $transacao->setValidacao(2);
            $transacao->setNomeVoluntario($this->input->post('nome'));
            $result = $this->Transacao_model->editarTransacao($transacao);
            if($result){
                redirect('administracao/prosumidores/transacoes/'.$transacao->getIdProsumidor());
            }
        }
    }

    public function gerarRelatorioPedido(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('dias', 'Dias', 'trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['dias'] = $this->input->post('dias');
            
            $this->load->view('administracao/prosumidores/relatorio_view', $data);
        }
        else{
            
        $this->load->helper('download');
        
        // Prepara os dados para exportação chamando uma função de auxílio presente na model de administração
        $data = $this->Pedido_model->exportar($this->input->post('dias'));

        // Inicia o download dos dados exportados
        force_download('Relatorio_de_Pedidos.csv', $data);
        redirect('administracao/prosumidores');
        }
    }

    public function gerarRelatorioVenda(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('dias', 'Dias', 'trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['dias'] = $this->input->post('dias');
            
            $this->load->view('administracao/prosumidores/relatorio_view', $data);
        }
        else{
            
        $this->load->helper('download');
        
        // Prepara os dados para exportação chamando uma função de auxílio presente na model de administração
        $data = $this->Transacao_model->exportar($this->input->post('dias'));

        // Inicia o download dos dados exportados
        force_download('Relatorio_de_Venda.csv', $data);
        redirect('administracao/prosumidores');
        }
    }


}

/* End of file prosumidores.php */
/* Location: ./application/controllers/administracao/prosumidores.php */