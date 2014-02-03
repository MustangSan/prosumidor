<body>
<html>
	<?php 		
		$base = $this->config->item('base_url');	
	?>
    
	<div class="conteudo">
		<h2>Cadastrar Nova Propriedade</h2>
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
              'name'        => 'endereco',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 275px;',
			  'value'		=> $endereco
            );			
			echo '<div class="input-prepend"> <span class="add-on">Endereco</span>'.form_input($data);
			echo form_error('endereco', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div><br>';
			
			$data = array(
              'name'        => 'tamanho',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 275px;',
			  'value'		=> $tamanho
            );			
			echo '<div class="input-prepend"> <span class="add-on">Tamanho</span>'.form_input($data);
			echo form_error('tamanho', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
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

			echo '&nbsp;<a href="'.$base.'prosumidor/propriedades/" class="btn btn-danger">Cancelar</a>';
		?>
	</div>
</body>
</html>