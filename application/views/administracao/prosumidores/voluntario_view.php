<?php 
	$base = $this->config->item('base_url');
?>
<html>
<body>
<div>
<?php
	echo form_open();

	echo '<h3 class="form-title form-title-first"><i class="icon-shopping-cart"></i> Concluir Venda</h3>';
	echo '<div class="row">';
	
	$data = array(
      'name'        => 'nome',
	  'type'		=> 'text',
	  'class'		=> 'form-control',
	  'value'		=> $nome
    );			
	echo '<div class="col-md-12"><div class="form-group"><label>Nome do Voluntario</label>'.form_input($data);
	echo form_error('nome', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
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
	if($i == 2)
		echo '&nbsp;<a href="'.$base.'administracao/prosumidores/transacoes/'.$idProsumidor.'" class="btn btn-danger">Voltar</a>';
	else if($i == 1)
			echo '&nbsp;<a href="'.$base.'administracao/prosumidores/pedidos/'.$idProsumidor.'" class="btn btn-danger">Voltar</a>';
?>
</div>
</body>
</html>