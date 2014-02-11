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
            <h1><i class="icon-truck"></i> Vender</h1>
          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
                    	<h3 class="form-title form-title-first"><i class="icon-barcode"></i> Detalhes da Venda</h3>
                    	<div class="widget">
	                    	<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								  <tr>
								    <th>Data</th>
								    <?php
								    if($transacao->getValidacao() != 2)
								    	echo '<th>Valor Total</th>';
								    else
								    	echo '<th>Valor Recebido</th>';
								    ?>
								  	<th>Status</th>
								  	<th>Voluntario</th>
								  </tr>
								</thead>
								<tbody>
								<?php
									echo '<tr>';
									echo '<td>'.$transacao->getData().'</td>';
									if($transacao->getValorTotalRecebido() != 0)
										echo '<td>'.$transacao->getValorTotalRecebido().'</td>';
									else
										echo'<td>A Receber</td>';
									if($transacao->getValidacao() == 0)
										echo '<td><span class="label label-info">Aberto</span></td>';
									else {
										if($transacao->getValidacao() == 1)
											echo '<td><span class="label label-warning">Confirmado</span></td>';
										else{ 
											if($transacao->getValidacao() == 2)
												echo '<td><span class="label label-success">Concluído</span></td>';
										}
									}
									if($transacao->getValidacao() == 2)
										echo '<td>'.$transacao->getNomeVoluntario().'</td>';
									else
										echo '<td></td>';
									
									echo '</tr>';
								?>
								</tbody>
							</table>
							</div>
						</div>

						<div>
							<div class="table-responsive">
							<?php
								if($prosumidor->getStatus() == 1 && $transacao->getValidacao() == 0){
									echo '<div class="widget-controls pull-right">
		                  					<a href="'.$base.'prosumidor/vender/fazerVenda/'.$transacao->getIdTransacao().'"><i class="icon-plus-sign"></i></a>
		                				  </div>';
								}
							?>
							<h3 class="form-title form-title-first"><i class="icon-tags"></i> Produtos da Venda</h3>
							<table class="table table-striped table-bordered table-hover">
								<thead>
								  <tr>
								    <th width="70">Foto</th>
								    <th>Produto</th>
								    <th>Quantidade Disponivel</th>
								<?php
								    if($transacao->getValidacao() == 2){
								    	echo '<th>Quantidade Vendida</th>';
										echo '<th>Valor Recebido</th>';
									}
								    if($prosumidor->getStatus() == 1 && $transacao->getValidacao() == 0){
								    	echo '<th width="168"></th>';
								    }
								?>
								  </tr>
								</thead>
								<tbody>
								<?php
									if(isset($vendas)){
										foreach($vendas as $key){
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
											echo '<td>'.$key->getQtdDisponivel().'</td>';
											if($transacao->getValidacao() == 2){
												echo '<td>'.$key->getQtdVendida().'</td>';
												echo '<td>'.$key->getValorRecebido().'</td>';
											}
											if($prosumidor->getStatus() == 1 && $transacao->getValidacao() == 0){
												echo '<td class="text-right"><a href="'.$base.'prosumidor/vender/removerVenda/'.$key->getIdVenda().'" class="btn btn-danger btn-xs"><i class="icon-remove"></i></a>';
												echo ' <a href="'.$base.'prosumidor/vender/editarVenda/'.$key->getIdVenda().'" class="btn btn-default btn-xs"><i class="icon-pencil"></i> Editar Quantidade</a></td>';
											}
											echo'</tr>';
										}
									}
								?>
								</tbody>
							</table>
							<br>
							<?php
								if($prosumidor->getStatus() == 1 && $transacao->getValidacao() == 0)
									echo '<a href="'.$base.'prosumidor/vender/confirmarTransacao/'.$transacao->getIdTransacao().'" class="btn btn-primary">Confirmar Venda</a>';
								echo ' <a href="'.$base.'prosumidor/vender/transacoes/" class="btn btn-danger">Voltar</a>';
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