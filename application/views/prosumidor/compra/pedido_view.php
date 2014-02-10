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
                    	<h3 class="form-title form-title-first"><i class="icon-barcode"></i> Detalhes do Pedido</h3>
                    	<div class="widget">
	                    	<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								  <tr>
								    <th>Data</th>
								    <th>Valor Total</th>
								  	<th>Status</th>
								  </tr>
								</thead>
								<tbody>
								<?php
									echo '<tr>';
									echo '<td>'.$pedido->getData().'</td>';
									echo '<td>'.$pedido->getValorTotal().'</td>';
									if($pedido->getValidacao() == 0)
										echo '<td><span class="label label-info">Aberto</span></td>';
									else {
										if($pedido->getValidacao() == 1)
											echo '<td><span class="label label-warning">Confirmado</span></td>';
										else{ 
											if($pedido->getValidacao() == 2)
												echo '<td><span class="label label-success">Concluído</span></td>';
										}
									}
									echo '</tr>';
								?>
								</tbody>
							</table>
							</div>
						</div>

						<div class="widget">
							<div class="table-responsive">
							<?php
								if($prosumidor->getStatus() == 1 && $pedido->getValidacao() == 0){
									echo '<div class="widget-controls pull-right">
		                  					<a href="'.$base.'prosumidor/comprar/fazerComprar/'.$pedido->getIdPedido().'"><i class="icon-plus-sign"></i></a>
		                				  </div>';
								}
							?>
							<h3 class="form-title form-title-first"><i class="icon-tags"></i> Produtos do Pedido</h3>
							<table class="table table-striped table-bordered table-hover">
								<thead>
								  <tr>
								    <th width="70">Foto</th>
								    <th>Produto</th>
								    <th>Quantidade</th>
								    <th>Valor</th>
								    	<?php
								    		if($prosumidor->getStatus() == 1 && $pedido->getValidacao() == 0){
								    			echo '<th width="168"></th>';
								    		}
								    	?>
								  </tr>
								</thead>
								<tbody>
								<?php
									if(isset($compras)){
										foreach($compras as $key){
											echo '<tr>';
											foreach ($produtos as $a) {
												if($a->getIdProduto() == $key->getIdProduto()){
													if ($a->getFoto() != '0')
														echo '<td><center><img style="display: inline;" src="'.$base.'images/produtos/'.$a->getFoto().'" width="50" height="50" /></center></td>';
													else
														echo '<td><center><img style="display: inline;" src="'.$base.'images/produtos/semfoto.png" width="50" height="50" /></center></td>';
													echo '<td>'.$a->getNome().'</td>';
												}
											}
											echo '<td>'.$key->getQtdComprada().'</td>';
											echo '<td>'.$key->getValor().'</td>';

											if($prosumidor->getStatus() == 1 && $pedido->getValidacao() == 0){
												echo '<td class="text-right"><a href="'.$base.'prosumidor/comprar/removerCompra/'.$key->getIdCompra().'" class="btn btn-danger btn-xs"><i class="icon-remove"></i></a>';
												echo ' <a href="'.$base.'prosumidor/comprar/editarCompra/'.$key->getIdCompra().'" class="btn btn-default btn-xs"><i class="icon-pencil"></i> Editar Quantidade</a></td>';
											}
											echo'</tr>';
										}
									}
								?>
								</tbody>
							</table>
							<br>
							<?php
								if($prosumidor->getStatus() == 1 && $pedido->getValidacao() == 0)
									echo '<a href="'.$base.'prosumidor/comprar/confirmarPedido/'.$pedido->getIdPedido().'" class="btn btn-primary">Confirmar Pedido</a>';
								echo ' <a href="'.$base.'prosumidor/comprar/pedidos/" class="btn btn-danger">Voltar</a>';
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
  </div>
</div>

<?php $this->load->view('pages/footer.php'); ?>