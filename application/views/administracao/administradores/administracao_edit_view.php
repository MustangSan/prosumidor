<?php 		
	$this->load->view('pages/header.php');
	$base = $this->config->item('base_url');
	
	if ($this->uri->segment(3) == 'editarAdministrador')
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
						<?php 			
							echo form_open();

							echo '<h3 class="form-title form-title-first"><i class="icon-terminal"></i> Editar Administrador</h3>';
							echo '<div class="row">';
							
							$data = array(
				              'name'        => 'nome',
				              'id'          => 'prependedInput',
							  'type'		=> 'text',
							  'class'		=> 'form-control',
							  'value'		=> $nome
				            );			
							echo '<div class="col-md-6"><div class="form-group"><label>Nome</label>'.form_input($data);
							echo form_error('nome', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
							echo '</div></div>';
							
							$data = array(
				              'name'        => 'email',
				              'id'          => 'prependedInput',
							  'type'		=> 'text',
							  'class'		=> 'form-control',
							  'value'		=> $email
				            );			
							echo '<div class="col-md-6"><div class="form-group"><label>E-mail</label>'.form_input($data);
							echo form_error('email', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
							echo '</div></div>';

							echo '</div><div class="row">';
							
							$data = array(
				              'name'        => 'senha',
				              'id'          => 'senha',
							  'type'		=> 'password',
							  'class'		=> 'form-control',
							  'value'		=> $senha
				            );			
							echo '<div class="col-md-6"><div class="form-group"><label>Senha</label>'.form_input($data, '', $readonly);
							echo form_error('senha', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
							echo '</div></div>';
							
							$data = array(
				              'name'        => 'senhaconf',
				              'id'          => 'senhaconf',
							  'type'		=> 'password',
							  'class'		=> 'form-control',
							  'value'		=> $senha
				            );			
							echo '<div class="col-md-6"><div class="form-group"><label>Confirmar Senha</label>'.form_input($data, '', $readonly);
							echo form_error('senhaconf', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
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

							echo '&nbsp;<a href="'.$base.'administracao/administradores/" class="btn btn-danger">Cancelar</a>';
							if ($readonly == 'readonly')
								echo '<a onclick="habilitarSenha()"><div class="btn" style="margin-left: 10px;">Alterar senha</div></a>';
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