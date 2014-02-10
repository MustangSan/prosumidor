<?php 		
	$this->load->view('pages/header.php');
	$base = $this->config->item('base_url');
	
	if ($this->uri->segment(2) == 'editar')
		$readonly = 'readonly';
	else
		$readonly = '';
?>

<script>
	function habilitarSenha() {
		var field = document.getElementById("senha");
		field.readOnly=false;
		field.value='';
		var field = document.getElementById("senhaconf");
		field.readOnly=false;
		field.value='';
	}
</script>

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
                    	<h3 class="form-title form-title-first"><i class="icon-shopping-cart"></i>  Faça e veja seus pedidos</h3>
                    	<div class="row">
                    		<div class="col-md-6">
								<a class="col-md-12 btn btn-primary" href="<?php echo $base; ?>prosumidor/comprar/criarPedido">Fazer Pedido</a>
							</div>
							<div class="col-md-6">
								<a class="col-md-12 btn btn-info" href="<?php echo $base; ?>prosumidor/comprar/pedidos">Ver Pedidos</a>
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