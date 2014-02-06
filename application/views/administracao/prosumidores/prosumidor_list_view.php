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
                    	<h3 class="form-title form-title-first"><i class="icon-group"></i> Usuários Cadastrados</h3>
                    	<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
							  <tr>
							    <th>Nome</th>
							  	<th>E-mail</th>		    
							    <th>Tipo</th>
							    <th>Status</th>
							    <th>Informações</th>
							    <th>Bloqueio</th>
							  </tr>
							</thead>
							<tbody>
								<?php 
									if(isset($prosumidor)){
										foreach($prosumidor as $a){	
											echo '<tr>';
											echo '<td>'.$a->getNome().'</td>';
											echo '<td>'.$a->getEmail().'</td>';

											//Tipo
											if($a->getTipo() == 1 )
												echo '<td>Consumidor</td>';
											else 
												if($a->getTipo() == 2 )
													echo '<td>Prosumidor</td>'; 
											
											//Status
											if($a->getStatus() == 1 )
												echo '<td>Normal</td>';
											else 
												if($a->getStatus() == 2 )
													echo '<td>Bloqueado</td>';

											//Mostrar dados do prosumidor
											echo '<td><a href="'.$base.'administracao/prosumidores/listarDados/'.$a->getIdProsumidor().'"><center><i class="icon-info-sign"></i></center></a></td>';

											//Bloquear ou desbloquear dependendo do status
											if($a->getStatus() == 1 )
												echo '<td><a title="Bloquear" href="'.$base.'administracao/prosumidores/bloquear/'.$a->getIdProsumidor().'"><center><i class="icon-unlock"></i></center></a></td>';
											else 
												if($a->getStatus() == 2 )
													echo '<td><a title="Desbloquear" href="'.$base.'administracao/prosumidores/desbloquear/'.$a->getIdProsumidor().'"><center><i class="icon-lock"></i></center></a></td>';
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('pages/footer.php'); ?>