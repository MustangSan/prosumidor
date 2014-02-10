<?php
	$base = $this->config->item('base_url');
?>
<html>
<body>
	<div>
		<h2>Criar Pedido</h2>
		<?php 			
							echo form_open();
							
							$data = array(
					          'name'        => 'data',
							  'type'		=> 'data',
							  'class'		=> 'form-control',
							  'value'		=> $data
					        );			
							echo '<div class="col-md-4"><div class="form-group"><label>Data</label>'.form_input($data);
							echo form_error('data', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
							echo '</div></div>';

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

							echo '&nbsp;<a href="'.$base.'prosumidor/comprar" class="btn btn-danger">Cancelar</a>';
		?>
	</div>
</body>
</html>