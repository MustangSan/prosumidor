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
            <h1><i class="icon-bolt"></i> Administradores</h1>
          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
                    	<div class="widget-controls pull-right">
			              <a href="<?php echo $base; ?>administracao/administradores/inserirAdministrador/"><i class="icon-plus-sign"></i></a>
			            </div>
                    	<h3 class="form-title form-title-first"><i class="icon-tags"></i> Administradores Cadastrados</h3>
                    	<div class="table-responsive">
          						<table class="table table-striped table-bordered table-hover">
          							<thead>
          							  <tr>
          							    <th>Nome</th>
          							    <th>E-mail</th>
          							    <th width="100"></th>
          							  </tr>
          							</thead>
          							<tbody>
          								<?php 
          									if(isset($administradores)){
          										foreach($administradores as $a){	
          											echo '<tr>';
          											echo '<td>'.$a->getNome().'</td>';
          											echo '<td>'.$a->getEmail().'</td>';
                                echo '<td><a href="'.$base.'administracao/administradores/removerAdministrador/'.$a->getIdAdministrador().'" class="btn btn-danger btn-xs"><i class="icon-remove"></i></a>';
          											echo ' <a href="'.$base.'administracao/administradores/editarAdministrador/'.$a->getIdAdministrador().'" class="btn btn-default btn-xs"><i class="icon-pencil"></i> Editar</a></td>';
          											echo '</tr>';
          										}
          									}
          								?>
          							</tbody>
          					  </table>
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