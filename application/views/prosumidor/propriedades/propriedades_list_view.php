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
            <h1><i class="icon-map-marker"></i> Minhas Terras</h1>
          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
                    	<div class="widget-controls pull-right">
			                  <a href="<?php echo $base; ?>prosumidor/propriedades/inserirPropriedade/"><i class="icon-plus-sign"></i></a>
			                </div>
                    	<h3 class="form-title form-title-first"><i class="icon-tags"></i> Terras Cadastradas</h3>
                    	<div class="table-responsive">
          						<table class="table table-striped table-bordered table-hover">
          							<thead>
          							  <tr>
          							    <th>Nome</th>
          							    <th>Endereco</th>
          							    <th>Tamanho</th>
          							    <th width="40">Editar</th>
          							    <th width="40">Remover</th>

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
          											echo '<td><a href="'.$base.'prosumidor/propriedades/editarPropriedade/'.$a->getIdPropriedade().'"><center><i class="icon-edit"></i></center></a></td>';
          											echo '<td><a href="'.$base.'prosumidor/propriedades/removerPropriedade/'.$a->getIdPropriedade().'"><center><i class="icon-minus-sign"></i></center></td>';
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