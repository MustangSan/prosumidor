<?php 
	$base = $this->config->item('base_url');
?>
<html>
<body>
<div>
<?php
	echo form_open();

	echo '<h3 class="form-title form-title-first"><i class="icon-shopping-cart"></i> Confirmar Venda</h3>';
	echo '<div class="row">';
	
	$data = array(
      'name'        => 'qtd',
	  'type'		=> 'number',
	  'class'		=> 'form-control',
	  'value'		=> $qtd
    );			
	echo '<div class="col-md-12"><div class="form-group"><label>Quantidade Vendida</label>'.form_input($data);
	echo form_error('qtd', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
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

	echo '&nbsp;<a href="'.$base.'administracao/prosumidores/transacao/'.$idTransacao.'" class="btn btn-danger">Voltar</a>';
?>
</div>
</body>
</html>