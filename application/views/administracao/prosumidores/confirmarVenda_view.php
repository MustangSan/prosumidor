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

	  <?php $this->load->view('pages/menu-administrador.php'); ?>
    </div>

    <div class="col-md-9">
      <div class="content-wrapper wood-wrapper">
        <div class="content-inner">
          <div class="page-header page-header-dark-blue">
            <h1><i class="icon-user"></i> Usuários</h1>
          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
						<?php
							echo form_open();

							echo '<h3 class="form-title form-title-first"><i class="icon-shopping-cart"></i> Confirmar Venda</h3>';
							echo '<div class="row">';
							
							$data = array(
						      'name'        => 'qtd',
							  'type'		=> 'number',
							  'class'		=> 'form-control',
							  'value'		=> $qtd
						    );			
							echo '<div class="col-md-12"><div class="form-group"><label>Quantidade Vendida</label>'.form_input($data);
							echo form_error('qtd', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
							echo '</div></div>';

							echo'</div>';

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

							echo '&nbsp;<a href="'.$base.'administracao/prosumidores/transacao/'.$idTransacao.'" class="btn btn-danger">Voltar</a>';
						?>
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