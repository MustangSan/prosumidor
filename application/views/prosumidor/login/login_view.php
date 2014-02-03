<?php 
	$base = $this->config->item('base_url');
?>

<html>
<body>
	<div>
		<h1>Prosumidor</h1>
	</div>
	<div class="box">
        <div class="box-center" style="margin-top: 35px;">
			<h2>Login Prosumidor</h2>
			<?php 

				echo form_open();
				
				$data = array(
	              'class'       => 'input',
	              'name'        => 'email',
	              'id'          => 'email',
				  'type'		=> 'text',
				  'placeholder'	=> 'E-mail'
	            );
				echo form_input($data);
				echo '<br>';
				echo form_error('email', '<div rel="tooltip" class="fieldErrorLogin" title="', '" ><i class="icon-warning-sign" rel="tooltip"></i></div>');
				
				$data = array(
	              'class'       => 'input',
	              'name'        => 'senha',
	              'id'          => 'senha',
				  'type'		=> 'password',
				  'placeholder'	=> 'Senha'
	            );
				echo form_input($data);
				echo '<br>';
				echo form_error('senha', '<div rel="tooltip" class="fieldErrorLogin" title="', '" ><i class="icon-warning-sign" rel="tooltip"></i></div>');
				
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
        </div>
	</div>

	<?php 			
		if (isset($result) && $result == 'loginErro')
			echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>E-mail ou senha estão incorretos!</div>';

		echo '&nbsp;<a href="'.$base.'prosumidor/cadastro/" class="btn btn-danger">Cadastrar</a>';
	?>
    <!--script>
        //Placeholder Cross-Browser
        $('input[placeholder], textarea[placeholder]').placeholder();
    </script-->
</body>
</html>