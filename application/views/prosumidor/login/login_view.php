<?php 
	$this->load->view('pages/header.php');

	$base = $this->config->item('base_url');
?>

<div class="all-wrapper no-menu-wrapper">
  <div class="login-logo-w">
    <a href="#" class="logo">
      <i class="icon-cloud-download"></i>
      <span>Prosumidor</span>
    </a>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">

      <div class="content-wrapper bold-shadow wood-wrapper">
        <div class="content-inner">
          <div class="main-content main-content-grey-gradient no-page-header">
            <div class="main-content-inner">
			<?php 

				echo form_open();

				echo '<h3 class="form-title form-title-first"><i class="icon-lock"></i> Login do Prosumidor</h3>';
				
				$data = array(
	              'class'       => 'form-control',
	              'name'        => 'email',
	              'id'          => 'email',
				  'type'		=> 'text',
				  'placeholder'	=> 'Coloque seu e-mail'
	            );
	            echo '<div class="form-group">
                <label>Usuário</label>';
				echo form_input($data);
				echo form_error('email', '<div rel="tooltip" class="fieldErrorLogin" title="', '" ><i class="icon-warning-sign" rel="tooltip"></i></div>');
				
				$data = array(
	              'class'       => 'form-control',
	              'name'        => 'senha',
	              'id'          => 'senha',
				  'type'		=> 'password',
				  'placeholder'	=> 'Coloque sua senha'
	            );
	            echo '</div>
                <div class="form-group">
                <label>Senha</label>';
				echo form_input($data);
				echo form_error('senha', '<div rel="tooltip" class="fieldErrorLogin" title="', '" ><i class="icon-warning-sign" rel="tooltip"></i></div>');
				echo '</div>';

				$data = array(
				  'type'		=> 'submit',
	              'id'          => 'submit',
	              'class'       => 'btn btn-large btn-info submit',
				  'value' 		=> 'Entrar',
			  	  'onclick'  	=> 'setTimeout(twoClicks, 1);'
	            );
				echo form_input($data);
				
				form_close();
			?>






	<?php 			
		if (isset($result) && $result == 'loginErro')
			echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>E-mail ou senha estão incorretos!</div>';

		echo '&nbsp;<a href="'.$base.'prosumidor/cadastro/" class="btn btn-danger">Cadastrar</a>';
	?>

<?php $this->load->view('pages/footer.php'); ?>