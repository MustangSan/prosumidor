<?php
	$base = $this->config->item('base_url');
?>
<html>
<body>
	<div>
		<h2>Pedidos</h2>

		<table>
			<thead>
			  <tr>
			    <th>Data</th>
			    <th>Valor Total</th>
			  	<th>Status</th>
			  	<th>Ver Pedido</th>
			  	<th>Concluir</th>
			  </tr>
			</thead>
			<tbody>
				<?php 
				if(isset($pedidos)){
					foreach($pedidos as $a){	
						echo '<tr>';
						echo '<td>'.$a->getData().'</td>';
						echo '<td>'.$a->getValorTotal().'</td>';
						if($a->getValidacao() == 0)
							echo '<td>Aberto</td>';
						else {
							if($a->getValidacao() == 1)
								echo '<td>Confirmado</td>';
							else{ 
								if($a->getValidacao() == 2)
									echo '<td>Concluido</td>';
							}
						}
						echo '<td><a href="'.$base.'administracao/prosumidores/pedido/'.$a->getIdPedido().'">Ver</a></td>';
						if($a->getValidacao() == 1)
							echo '<td><a href="'.$base.'administracao/prosumidores/concluirPedido/'.$a->getIdPedido().'">Concluir Pedido</a></td>';
						//echo '<td><a href="'.$base.'prosumidor/comprar/pedido/'.$a->getIdPedido().'"><center><i class="icon-edit"></i></center></a></td>';
						echo '</tr>';
					}
				}
			?>
			</tbody>
		</table>
		<?php
			echo '<a href="'.$base.'administracao/prosumidores/listarDados/'.$idProsumidor.'" class="btn btn-danger">Voltar</a>';
		?>
	</div>
</body>
</html>