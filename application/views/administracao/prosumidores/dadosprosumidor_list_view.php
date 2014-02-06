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
                    	<div>
                    	<h3 class="form-title form-title-first"><i class="icon-map-marker"></i> Dados Usuario</h3>
                    	<?php
                      echo $prosumidor->getNome();
                      echo $prosumidor->getEmail();
                      echo $prosumidor->getCPF();
                      echo $prosumidor->getEndereco();
                      echo $prosumidor->getTelefone();
                      echo $prosumidor->getSexo();
                      //Status
                      if($prosumidor->getStatus() == 1 )
                        echo '<td>Normal</td>';
                      else 
                        if($prosumidor->getStatus() == 2 )
                          echo '<td>Bloqueado</td>';
                      if($prosumidor->getTipo() == 1 )
                        echo '<td>Consumidor</td>';
                      else 
                        if($prosumidor->getTipo() == 2 )
                          echo '<td>Prosumidor</td>'; 
                      echo $prosumidor->getSaldoConsumidor();
                      ?>
                    	</div>
                    	<h3 class="form-title form-title-first"><i class="icon-map-marker"></i> Propriedades Cadastradas</h3>
                    	<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
							  <tr>
							    <th>Nome</th>
							    <th>Endereco</th>
							    <th width="70">Tamanho</th>
							  </tr>
							</thead>
							<tbody>
								<?php 
									if(isset($propriedades)){
										foreach($propriedades as $a){	
											echo '<tr>';
											echo '<td>'.$a->getNome().'</td>';
											echo '<td>'.$a->getEndereco().'</td>';
											echo '<td>'.$a->getTamanho().'</td>';
											echo '</tr>';
										}
									}
								?>
							</tbody>
          				</table>
          			    </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                  </div>
                </div>
                <a href="<?php echo $base; ?>administracao/prosumidores/" class="btn btn-primary">Voltar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('pages/footer.php'); ?>