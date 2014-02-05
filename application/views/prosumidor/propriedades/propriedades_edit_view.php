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
            <h1><i class="icon-edit"></i> Editar/Cadastrar Terra</h1>
          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
		<?php 			
			echo form_open();

			echo '<h3 class="form-title form-title-first"><i class="icon-terminal"></i> Edite as informações da sua terra</h3>';
			echo '<div class="row">';
			
			$data = array(
              'name'        => 'nome',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'class'		=> 'form-control',
			  'value'		=> $nome
            );			
			echo '<div class="col-md-6"><div class="form-group"><label>Nome da Propriedade</label>'.form_input($data);
			echo form_error('nome', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div></div>';

			$data = array(
              'name'        => 'tamanho',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'class'		=> 'form-control',
			  'value'		=> $tamanho
            );			
			echo '<div class="col-md-6"><div class="form-group"><label>Tamanho</label>'.form_input($data);
			echo form_error('tamanho', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div></div>';

			echo '</div><div class="row">';
			
			$data = array(
              'name'        => 'endereco',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'class'		=> 'form-control',
			  'value'		=> $endereco
            );			
			echo '<div class="col-md-12"><div class="form-group"><label>Endereço</label>'.form_input($data);
			echo form_error('endereco', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div></div>';

			echo '</div>';

			$data = array(
			  'type'		=> 'submit',
              'name'        => 'submit',
              'id'          => 'submit',
              'class'       => 'btn btn-primary',
			  'value' 		=> 'Concluir',
			  'onclick'  	=> 'setTimeout(twoClicks, 1);'
            );
			echo form_input($data);
			
			form_close();

			echo '&nbsp;<a href="'.$base.'prosumidor/propriedades/" class="btn btn-danger">Cancelar</a>';
		?>
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