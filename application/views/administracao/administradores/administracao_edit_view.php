<body>
<html>
	<?php 		
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
    
	<div class="conteudo">
		<h2>Cadastrar Novo Administrador</h2>
		<br />
		<?php 			
			echo form_open();
			
			$data = array(
              'name'        => 'nome',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 210px;',
			  'value'		=> $nome
            );			
			echo '<div class="input-prepend" style="float: left; margin-right: 20px;"> <span class="add-on">Nome</span>'.form_input($data);
			echo form_error('nome', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div>';
			
			$data = array(
              'name'        => 'email',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 275px;',
			  'value'		=> $email
            );			
			echo '<div class="input-prepend"> <span class="add-on">E-mail</span>'.form_input($data);
			echo form_error('email', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div><br>';
			
			$data = array(
              'name'        => 'senha',
              'id'          => 'senha',
			  'type'		=> 'password',
			  'value'		=> $senha
            );			
			echo '<div class="input-prepend" style="float: left; margin-right: 20px;"> <span class="add-on">Senha</span>'.form_input($data, '', $readonly);
			echo form_error('senha', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div>';
			
			$data = array(
              'name'        => 'senhaconf',
              'id'          => 'senhaconf',
			  'type'		=> 'password',
			  'value'		=> $senha
            );			
			echo '<div class="input-prepend"> <span class="add-on">Confirmar Senha</span>'.form_input($data, '', $readonly);
			echo form_error('senhaconf', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div><br>';
			
			$data = array(
			  'type'		=> 'submit',
              'name'        => 'submit',
              'id'          => 'submit',
              'class'       => 'btn btn-info',
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
</body>
</html>