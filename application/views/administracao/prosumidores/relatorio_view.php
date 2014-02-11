<?php 		
	$base = $this->config->item('base_url');
?>
<html>
<body>

<?php
	echo form_open();

	echo '<h3 class="form-title form-title-first"><i class="icon-shopping-cart"></i> Gerar Relatorio</h3>';
	echo '<div class="row">';
	
	$data = array(
      'name'        => 'dias',
	  'type'		=> 'number',
	  'class'		=> 'form-control',
	  'value'		=> $dias
    );			
	echo '<div class="col-md-12"><div class="form-group"><label>Quantidade de dias</label>'.form_input($data);
	echo form_error('dias', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
	echo '</div></div>';

	echo'</div>';

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

	echo '&nbsp;<a href="'.$base.'administracao/prosumidores" class="btn btn-danger">Voltar</a>';
?>

</body>
</html>


