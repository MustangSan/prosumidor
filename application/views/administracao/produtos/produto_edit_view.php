<body>
<html>
	<?php 		
		$base = $this->config->item('base_url');
	?>
    
	<div class="conteudo">
		<h2>Cadastrar Novo Produto</h2>
		<br />
		<?php

			echo form_open_multipart();
			
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
              'name'        => 'preco',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 275px;',
			  'value'		=> $preco
            );			
			echo '<div class="input-prepend"> <span class="add-on">Preco</span>'.form_input($data);
			echo form_error('preco', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div><br>';

			$data = array(
              'name'        => 'validade',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 210px;',
			  'value'		=> $validade
            );			
			echo '<div class="input-prepend" style="float: left; margin-right: 20px;"> <span class="add-on">Validade</span>'.form_input($data);
			echo form_error('validade', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div>';
			
			$data = array(
              'name'        => 'unidade',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 275px;',
			  'value'		=> $unidade
            );			
			echo '<div class="input-prepend"> <span class="add-on">Unidade</span>'.form_input($data);
			echo form_error('unidade', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div><br>';

			$data = array(
              'name'        => 'disponibilidade',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 210px;',
			  'value'		=> $disponibilidade
            );			
			echo '<div class="input-prepend" style="float: left; margin-right: 20px;"> <span class="add-on">Disponibilidade</span>'.form_input($data);
			echo form_error('disponibilidade', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div>';
			
			$data = array(
              'name'        => 'descricao',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 275px;',
			  'value'		=> $descricao
            );			
			echo '<div class="input-prepend"> <span class="add-on">Descricao</span>'.form_textarea($data);
			echo form_error('descricao', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div><br>';

			/*$data = array(
              'name'        => 'idCategoria',
              'id'          => 'prependedInput',
			  'type'		=> 'text',
			  'style'		=> 'width: 210px;',
			  'value'		=> $idCategoria
            );			
			echo '<div class="input-prepend" style="float: left; margin-right: 20px;"> <span class="add-on">IdCategoria</span>'.form_input($data);
			echo form_error('idCategoria', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
			echo '</div>';*/

			if(isset($categorias)){		
			echo '<div class="input-prepend" style="float: left; margin-right: 20px;"> <span class="add-on">IdCategoria</span>' .form_dropdown('idCategoria', $categorias, $id);
			echo '</div>';
			}
			
			echo '<div class="input-prepend"> <span class="add-on" style="margin-right:5px">Upload Foto</span>';
			echo '<input type="file" class="btn btn-upload" accept="image/jpeg, image/gif, image/png" id="userfile" name="userfile" size="20"/>';
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
		
			echo '&nbsp;<a href="'.$base.'administracao/produtos/" class="btn btn-danger">Cancelar</a>';
		?>
	</div>
</body>
</html>