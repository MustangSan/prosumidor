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
            <h1><i class="icon-home"></i> Início</h1>
          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
                    	<h3 class="form-title form-title-first"><i class="icon-tasks"></i> Estatísticas</h3>

						<div class="row">
			                <div class="col-lg-3 col-md-4 col-sm-6 text-center">
			                  <div class="widget-content-blue-wrapper changed-up">
			                    <div class="widget-content-blue-inner padded">
			                      <div class="pre-value-block"><i class="icon-user"></i>Usuários</div>
			                      <div class="value-block">
			                        <div class="value-self"><?php echo $prosumidor; ?></div>
			                        <div class="value-sub">Total</div>
			                      </div>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-lg-3 col-md-4 col-sm-6 text-center">
			                  <div class="widget-content-blue-wrapper changed-up">
			                    <div class="widget-content-blue-inner padded">
			                      <div class="pre-value-block"><i class="icon-ticket"></i>Produtos</div>
			                      <div class="value-block">
			                        <div class="value-self"><?php echo $produtos; ?></div>
			                        <div class="value-sub">Total</div>
			                      </div>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-lg-3 col-md-4 col-sm-6 text-center hidden-md">
			                  <div class="widget-content-blue-wrapper changed-up">
			                    <div class="widget-content-blue-inner padded">
			                      <div class="pre-value-block"><i class="icon-list-ul"></i>Categorias</div>
			                      <div class="value-block">
			                        <div class="value-self"><?php echo $categorias; ?></div>
			                        <div class="value-sub">Total</div>
			                      </div>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-lg-3 col-md-4 col-sm-6 text-center">
			                  <div class="widget-content-blue-wrapper changed-up">
			                    <div class="widget-content-blue-inner padded">
			                      <div class="pre-value-block"><i class="icon-sort-by-attributes"></i>Classes</div>
			                      <div class="value-block">
			                        <div class="value-self"><?php echo $class; ?></div>
			                        <div class="value-sub">Total</div>
			                      </div>
			                    </div>
			                  </div>
			                </div>
			              </div>
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