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
                    	<h3 class="form-title form-title-first"><i class="icon-tags"></i> Pedidos do Usuário</h3>
                    	<div class="table-responsive">
          				<table class="table table-striped table-bordered table-hover">
							<thead>
							  <tr>
							    <th>Data</th>
							    <th>Valor Recebido</th>
							  	<th>Status</th>
							  	<th>Voluntario</th>
							  	<th width="187"></th>
							  </tr>
							</thead>
							<tbody>
								<?php 
								if(isset($transacoes)){
									foreach($transacoes as $a){	
										echo '<tr>';
										echo '<td>'.$a->getData().'</td>';
										
										if($a->getValorTotalRecebido() != 0)
											echo '<td>'.$a->getValorTotalRecebido().'</td>';
										else
											echo '<td>A Receber</td>';
										
										if($a->getValidacao() == 0)
											echo '<td><span class="label label-info">Aberto</span></td>';
										else {
											if($a->getValidacao() == 1)
												echo '<td><span class="label label-warning">Confirmado</span></td>';
											else{ 
												if($a->getValidacao() == 2)
													echo '<td><span class="label label-success">Concluído</span></td>';
											}
										}
										
										if($a->getValidacao() == 2)
											echo '<td>'.$a->getNomeVoluntario().'</td>';
										else
											echo '<td></td>';

										if($a->getValidacao() == 1)
											echo '<td class="text-right"><a href="'.$base.'administracao/prosumidores/concluirTransacao/'.$a->getIdTransacao().'" class="btn btn-success btn-xs"><i class="icon-ok-sign"></i> Concluir Venda</a>';
										else
											echo '<td class="text-right">';
										echo ' <a href="'.$base.'administracao/prosumidores/transacao/'.$a->getIdTransacao().'" class="btn btn-default btn-xs"><i class="icon-info-sign"></i> Ver</a></td>';
										echo '</tr>';
									}
								}
							?>
							</tbody>
          				</table>
          			    </div>
						<?php
							echo '<a href="'.$base.'administracao/prosumidores/listarDados/'.$idProsumidor.'" class="btn btn-danger">Voltar</a>';
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