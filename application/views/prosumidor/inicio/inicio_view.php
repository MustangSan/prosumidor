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
            <h1><i class="icon-home"></i> Início</h1>
          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
                    	<h3 class="form-title form-title-first"><i class="icon-tags"></i> Produtos Cadastrados</h3>
                    	<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
							  <tr>
							    <th width="70"><center>Foto</center></th>
							    <th>Nome</th>
							    <th width="80">Preco</th>
							    <th width="75">Disponivel</th>
							    <th width="40">Detalhes</th>
							  </tr>
							</thead>
							<tbody>
								<?php 
									if(isset($produtos)){
										foreach($produtos as $a){	
											echo '<tr>';
											if ($a->getFoto() != '0')
												echo '<td><center><img style="display: inline;" src="'.$base.'images/produtos/'.$a->getFoto().'" width="50" height="50" /></center></td>';
											else
												echo '<td><center><img style="display: inline;" src="'.$base.'images/produtos/semfoto.png" width="50" height="50" /></center></td>';
											echo '<td>'.$a->getNome().'</td>';
											echo '<td>R$ '.$a->getPreco().'</td>';
											if($a->getDisponibilidade() == 1)
												echo '<td><center>Sim</center></td>';
											else
												echo  '<td><center>Não</center></td>';
											//echo '<td>'.$a->getDisponibilidade().'</td>';
											echo '<td><a href="#"><center><i class="icon-info-sign"></i></center></a></td>';						
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