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
            <h1><i class="icon-ticket"></i> Produtos</h1>
          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
						<?php
							echo form_open('administracao/produtos/addBD/'.$idProduto);

							echo '<h3 class="form-title form-title-first"><i class="icon-terminal"></i> Escolher Classificação do Produto</h3>';
							echo '<div class="row">';

							if(isset($class)){
							
								foreach ($class as $key) {
									$b = $key->getIdClassificacao();
									/*$data = array(
									'name'        => 'classi'.$b,
									'id'          => 'classi'.$b,
									'value'       => 1,
									'checked'     => FALSE
									);*/

									if(isset($idsClass)){
										foreach($idsClass as $a){
											if($key->getIdClassificacao() == $a['idClassificacao']){
												$data = array(
												'name'        => 'classi'.$b,
												'id'          => 'classi'.$b,
												'value'       => 1,
												'checked'     => TRUE
												);
												break;
											}
											else{
												$data = array(
												'name'        => 'classi'.$b,
												'id'          => 'classi'.$b,
												'value'       => 1,
												'checked'     => FALSE
												);
											}
										}

									}
									else{
										$data = array(
										'name'        => 'classi'.$b,
										'id'          => 'classi'.$b,
										'value'       => 1,
										'checked'     => FALSE
										);
									}

								echo '<div class="col-md-3"><div class="form-group">';
									echo '<label>'.form_checkbox($data).' '.$key->getNome().'</label>';
								echo '</div></div>';

								}
							}

							echo '</div><br>';

							$data = array(
							  'type'		=> 'submit',
				              'name'        => 'submit',
				              'id'          => 'submit',
				              'class'		=> 'btn btn-primary',
							  'value' 		=> 'Concluir',
				            );
							echo form_input($data);
							
							form_close();
						
							echo '&nbsp;<a href="'.$base.'administracao/produtos/" class="btn btn-danger">Voltar</a>';
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