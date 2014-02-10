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
                    	<h3 class="form-title form-title-first"><i class="icon-shopping-cart"></i> Seus pedidos</h3>
                    	<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
							  <tr>
							    <th>Data</th>
							    <th>Valor Total</th>
							  	<th>Status</th>
							  	<th width="127"></th>
							  </tr>
							</thead>
							<tbody>
								<?php 
								if(isset($pedidos)){
									foreach($pedidos as $a){	
										echo '<tr>';
										echo '<td>'.$a->getData().'</td>';
										echo '<td>'.$a->getValorTotal().'</td>';
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
										echo '<td class="text-right">';
										if($a->getValidacao() == 0)
											echo '<a href="'.$base.'prosumidor/comprar/removerPedido/'.$a->getIdPedido().'" class="btn btn-danger btn-xs"><i class="icon-remove"></i></a>';
										echo ' <a href="'.$base.'prosumidor/comprar/pedido/'.$a->getIdPedido().'" class="btn btn-default btn-xs"><i class="icon-info-sign"></i> Ver Pedido</a>';
										//echo '<td><a href="'.$base.'prosumidor/comprar/pedido/'.$a->getIdPedido().'"><center><i class="icon-edit"></i></center></a></td>';
										echo '</td></tr>';
									}
								}
							?>
							</tbody>
						</table>
						<?php
							echo '<a href="'.$base.'prosumidor/comprar" class="btn btn-danger">Voltar</a>';
						?>
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