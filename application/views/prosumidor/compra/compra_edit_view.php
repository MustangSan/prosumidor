<?php
	$base = $this->config->item('base_url');
?>
<html>
<body>
	<div>
		<h2>Comprar Produto</h2>
		<?php 			
			echo form_open();
						
			if(isset($produtos)){
				foreach ($produtos as $key) {
					$b = $key->getIdProduto();

					$data = array(
									'name'        => 'produto',
									'id'          => 'produto',
									'value'       => $key->getIdProduto(),
									'checked'     => FALSE
								);
				echo '<label class="radio">'.form_radio($data).$key->getNome().'</label>';
				echo '<br />';
				}
			}

				$data = array(
	              'name'        => 'qtd',
	              'id'          => 'prependedInput',
				  'type'		=> 'number',
				  'style'		=> 'width: 210px;',
				  'value'		=> $qtd
	            );			
				echo '<div class="input-prepend" style="float: left; margin-right: 20px;"> <span class="add-on">Quantidade</span>'.form_input($data);
				echo form_error('qtd', '<a href="#" class="fieldError" rel="tooltip" title="', '"><i class="icon-warning-sign"></i></a>');
				echo '</div>';

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

				echo '&nbsp;<a href="'.$base.'prosumidor/comprar/pedido/'.$idPedido.'" class="btn btn-danger">Cancelar</a>';
		?>
	</div>
</body>
</html>