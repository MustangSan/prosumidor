<body>
<html>
	<?php 		
		$base = $this->config->item('base_url');
	?>

    
	<div class="conteudo">
		<h2>Fazer Cadastro</h2>
		<br />
		<?php 			
			echo form_open();
			
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
			echo '<div class="input-prepend" style="float: left; margin-right: 20px;"> <span class="add-on">Senha</span>'.form_input($data);
			echo form_error('senha', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div>';
			
			$data = array(
              'name'        => 'senhaconf',
              'id'          => 'senhaconf',
			  'type'		=> 'password',
			  'value'		=> $senha
            );			
			echo '<div class="input-prepend"> <span class="add-on">Confirmar Senha</span>'.form_input($data);
			echo form_error('senhaconf', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div><br>';
			
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
              'name'        => 'cpf',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 210px;',
			  'value'		=> $cpf
            );			
			echo '<div class="input-prepend" style="float: left; margin-right: 20px;"> <span class="add-on">CPF</span>'.form_input($data);
			echo form_error('cpf', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div>';

			$data = array(
              'name'        => 'telefone',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 210px;',
			  'value'		=> $telefone
            );			
			echo '<div class="input-prepend" style="float: left; margin-right: 20px;"> <span class="add-on">Telefone</span>'.form_input($data);
			echo form_error('telefone', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div>';

			$data = array(
              'name'        => 'endereco',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 210px;',
			  'value'		=> $endereco
            );			
			echo '<div class="input-prepend" style="float: left; margin-right: 20px;"> <span class="add-on">Endereco</span>'.form_input($data);
			echo form_error('endereco', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div>';

			$options = array(
					  'Masculino'		=> 'Masculino',
					  'Feminino' 		=> 'Feminino'
					);
			$js = 'id="sexo" class="input"';
			echo '<div class="input-prepend"> <span class="add-on">Tipo</span>'.form_dropdown('sexo', $options, $sexo, $js);
			echo '</div><br>';

			$options = array(
					  '1'		=> 'Consumidor',
					  '2' 		=> 'Vendendor',
					  '3'		=> 'Prosumidor'
					);
			$js = 'id="tipo" class="input"';
			echo '<div class="input-prepend"> <span class="add-on">Tipo</span>'.form_dropdown('tipo', $options, $tipo, $js);
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

			echo '&nbsp;<a href="'.$base.'prosumidor/login" class="btn btn-danger">Voltar</a>';
		?>
	</div>
</body>
</html>