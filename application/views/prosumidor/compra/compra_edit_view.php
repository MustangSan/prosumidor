<?php 		
	$this->load->view('pages/header.php');
	$base = $this->config->item('base_url');
?>

<div class="all-wrapper">
  <div class="row">
    <div class="col-md-3">
      <div class="text-center">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

	  <?php $this->load->view('pages/menu-prossumidor.php'); ?>
    </div>

    <div class="col-md-9">
      <div class="content-wrapper wood-wrapper">
        <div class="content-inner">
          <div class="page-header page-header-dark-blue">
            <h1><i class="icon-credit-card"></i> Comprar</h1>
          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
						<?php 			
							echo form_open();

							echo '<h3 class="form-title form-title-first"><i class="icon-shopping-cart"></i> Escolha um produto</h3>';
							echo '<div class="row"><div class="col-md-12">';
										
							if(isset($produtos)){
								foreach ($produtos as $key) {
									$b = $key->getIdProduto();

									$data = array(
													'name'        => 'produto',
													'id'          => 'produto',
													'value'       => $key->getIdProduto(),
													'checked'     => FALSE
												);
								echo '<label class="radio">'.form_radio($data).$key->getNome().'</label>';
								}
							}

							echo '</div></div><div class="row"><div class="col-md-12">';

								$data = array(
					              'name'        => 'qtd',
					              'id'          => 'prependedInput',
								  'type'		=> 'number',
								  'class'		=> 'form-control',
								  'value'		=> $qtd
					            );			
								echo '<div class="form-group"><label>Quantidade</label>'.form_input($data);
								echo form_error('qtd', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
								echo '</div>';

								echo '</div></div>';

								$data = array(
								  'type'		=> 'submit',
						          'name'        => 'submit',
						          'id'          => 'submit',
						          'class'       => 'btn btn-primary',
								  'value' 		=> 'Concluir',
								  'onclick'  	=> 'setTimeout(twoClicks, 1);'
						        );
								echo form_input($data);
								
								form_close();

								echo '&nbsp;<a href="'.$base.'prosumidor/comprar/pedido/'.$idPedido.'" class="btn btn-danger">Cancelar</a>';
						?>
                 	</div>
                    <div class="col-md-6">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('pages/footer.php'); ?>