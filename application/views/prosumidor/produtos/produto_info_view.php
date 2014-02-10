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
                    	<h3 class="form-title form-title-first"><i class="icon-tags"></i> Produto</h3>
                    	<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
							  <tr>
							  	<th width="70">Foto</th>
							    <th>Nome</th>
							    <th>Preco</th>
							    <th>Validade</th>
							    <th>Unidade</th>
							    <th>Disponivel</th>
							    <th>Categoria</th>
							    <?php for ($i=0; $i < $numClass; $i++) { 
							    	echo '<th>Classe</th>';
							    }?>
							  </tr>
							</thead>
							<tbody>
								<?php 
									echo '<tr>';
									if ($produtos->getFoto() != '0')
										echo '<td><center><img style="display: inline;" src="'.$base.'images/produtos/'.$produtos->getFoto().'" width="50" height="50" /></center></td>';
									else
										echo '<td><center><img style="display: inline;" src="'.$base.'images/produtos/semfoto.png" width="50" height="50" /></center></td>';							
									echo '<td>'.$produtos->getNome().'</td>';
									echo '<td>'.$produtos->getPreco().'</td>';
									echo '<td>'.$produtos->getValidade().'</td>';
									echo '<td>'.$produtos->getUnidade().'</td>';
									
									if($produtos->getDisponibilidade() == 1)
										echo '<td><center>Sim</center></td>';
									else
										echo  '<td><center>Não</center></td>';
									
									echo '<td>'.$categoria->getNome().'</td>';
									if(isset($class)){
										foreach ($class as $key) {
											echo '<td>'.$key->getNome().'</td>';
										}
									}
									echo '</tr>';
								?>
							</tbody>
						</table>
						</div>
                    	<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
							  <tr>
							    <th>Descricao</th>
							  </tr>
							</thead>
							<tbody>
								<?php 
									echo '<tr>';
									echo '<td>'.$produtos->getDescricao().'</td>';
									echo '<tr>';
								?>
							</tbody>
						</table>
						</div>
				        <?php 
				        	echo '<a href="'.$base.'prosumidor/inicio/" class="btn btn-primary">Voltar</a>';
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