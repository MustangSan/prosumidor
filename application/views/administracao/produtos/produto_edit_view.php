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
            <h1><i class="icon-ticket"></i> Produtos</h1>
          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
						<?php

							echo form_open_multipart();

							echo '<h3 class="form-title form-title-first"><i class="icon-terminal"></i> Cadastrar / Editar Produto</h3>';
							echo '<div class="row">';
							
							$data = array(
				              'name'        => 'nome',
				              'id'          => 'prependedInput',
							  'type'		=> 'text',
							  'class'		=> 'form-control',
							  'value'		=> $nome
				            );			
							echo '<div class="col-md-4"><div class="form-group"><label>Nome</label>'.form_input($data);
							echo form_error('nome', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
							echo '</div></div>';
							
							$data = array(
				              'name'        => 'preco',
				              'id'          => 'prependedInput',
							  'type'		=> 'text',
							  'class'		=> 'form-control',
							  'value'		=> $preco
				            );			
							echo '<div class="col-md-4"><div class="form-group"><label>Preço</label>'.form_input($data);
							echo form_error('preco', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
							echo '</div></div>';

							$data = array(
				              'name'        => 'validade',
				              'id'          => 'prependedInput',
							  'type'		=> 'text',
							  'class'		=> 'form-control',
							  'value'		=> $validade
				            );			
							echo '<div class="col-md-4"><div class="form-group"><label>Validade</label>'.form_input($data);
							echo form_error('validade', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
							echo '</div></div>';

							echo '</div><div class="row">';
							
							$data = array(
				              'name'        => 'unidade',
				              'id'          => 'prependedInput',
							  'type'		=> 'text',
							  'class'		=> 'form-control',
							  'value'		=> $unidade
				            );			
							echo '<div class="col-md-6"><div class="form-group"><label>Unidade</label>'.form_input($data);
							echo form_error('unidade', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
							echo '</div></div>';

							$options = array(
									  '1'		=> 'Disponivel',
									  '2' 		=> 'Não Disponivel'
									);
							$js = 'id="disponibilidade" class="form-control"';
							echo '<div class="col-md-6"><div class="form-group"><label>Tipo</label>'.form_dropdown('disponibilidade', $options, $disponibilidade, $js);
							echo '</div></div>';

							/*$data = array(
				              'name'        => 'disponibilidade',
				              'id'          => 'prependedInput',
							  'type'		=> 'text',
							  'class'		=> 'form-control',
							  'value'		=> $disponibilidade
				            );			
							echo '<div class="col-md-6"><div class="form-group"><label>Disponibilidade</label>'.form_input($data);
							echo form_error('disponibilidade', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
							echo '</div></div>';*/

							echo '</div><div class="row">';
							
							$data = array(
				              'name'        => 'descricao',
				              'id'          => 'prependedInput',
							  'type'		=> 'text',
							  'class'		=> 'form-control',
							  'value'		=> $descricao
				            );			
							echo '<div class="col-md-12"><div class="form-group"><label>Descrição</label>'.form_textarea($data);
							echo form_error('descricao', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
							echo '</div></div>';

							echo '</div><div class="row">';

							if(isset($categorias)){		
								$class = 'class="form-control"';
								echo '<div class="col-md-6"><div class="form-group"><label>Categoria</label>' .form_dropdown('idCategoria', $categorias, $id, $class);
								echo '</div></div>';
							}
							
							echo '<div class="col-md-6"><div class="form-group"><label>Upload de Foto</label>';
							echo '<input type="file" class="form-control" accept="image/jpeg, image/gif, image/png" id="userfile" name="userfile" size="20"/>';
							echo '</div></div>';

							echo '</div>';

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