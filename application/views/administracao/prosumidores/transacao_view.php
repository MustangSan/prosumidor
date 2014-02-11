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
                    	<h3 class="form-title form-title-first"><i class="icon-barcode"></i> Detalhes da Venda</h3>
                    	<div class="widget">
	                    	<div class="table-responsive">
	          				<table class="table table-striped table-bordered table-hover">
								<thead>
								  <tr>
								    <th>Data</th>
								    <th>Valor Total</th>
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
										echo '<td>A Receber</td>';
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
							<h3 class="form-title form-title-first"><i class="icon-tags"></i> Produtos da Venda</h3>
							<table class="table table-striped table-bordered table-hover">
								<thead>
								  <tr>
								    <th width="70">Foto</th>
								    <th>Produto</th>
								    <th>Quantidade Disponivel</th>
								    <th>Quantidade Vendida</th>
									<th>Valor Recebido</th>
								  </tr>
								</thead>
								<tbody>
								<?php
									if(isset($vendas)){
										foreach($vendas as $key){
											echo '<tr>';
											if (isset($produtos)) {
											foreach ($produtos as $a) {
												if($a->getIdProduto() == $key->getIdProduto()){
													if ($a->getFoto() != '0')
														echo '<td><center><img style="display: inline;" src="'.$base.'images/produtos/'.$a->getFoto().'" width="50" height="50" /></center></td>';
													else
														echo '<td><center><img style="display: inline;" src="'.$base.'images/produtos/semfoto.png" width="50" height="50" /></center></td>';
													echo '<td>'.$a->getNome().'</td>';
												}
											}
											}											
											echo '<td>'.$key->getQtdDisponivel().'</td>';
											if($key->getQtdVendida() != 0){
												echo '<td>'.$key->getQtdVendida().'</td>';
												echo '<td>'.$key->getValorRecebido().'</td>';
											}
											else{
												echo '<td>A Confirmar</td>';
												echo '<td></td>';
											}
											if($transacao->getValidacao() == 1)
												echo '<td class="text-right"><a href="'.$base.'administracao/prosumidores/confirmarVenda/'.$key->getIdVenda().'" class="btn btn-success btn-xs"><i class="icon-ok-sign"></i> Confirmar Produto</a></td>';
											echo'</tr>';
										}
									}
								?>
								</tbody>
							</table>
							</div>
						</div>
						<br>
						<?php
						if($transacao->getValidacao() == 1)
							echo '<a href="'.$base.'administracao/prosumidores/concluirTransacao/'.$transacao->getIdTransacao().'" class="btn btn-primary"><i class="icon-ok-sign"></i> Concluir Venda</a>';
							echo '  ';
							echo '<a href="'.$base.'administracao/prosumidores/transacoes/'.$idProsumidor.'" class="btn btn-danger">Voltar</a>';
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