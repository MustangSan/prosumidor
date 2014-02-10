<?php
	$base = $this->config->item('base_url');
?>
<html>
<body>
	<div>
		<h2>Informações do Pedido</h2>
		<table>
			<thead>
			  <tr>
			    <th>Data</th>
			    <th>Valor Total</th>
			  	<th>Status</th>
			  </tr>
			</thead>
			<tbody>
			<?php
				echo '<tr>';
				echo '<td>'.$pedido->getData().'</td>';
				echo '<td>'.$pedido->getValorTotal().'</td>';
				if($pedido->getValidacao() == 0)
					echo '<td>Aberto</td>';
				else {
					if($pedido->getValidacao() == 1)
						echo '<td>Confirmado</td>';
					else{ 
						if($pedido->getValidacao() == 2)
							echo '<td>Concluido</td>';
					}
				}
				echo '</tr>';
			?>
			</tbody>
		</table>
	</div>
	<br /> <br />
	<div>
		<?php
			if($prosumidor->getStatus() == 1 && $pedido->getValidacao() == 0){
				echo '&nbsp;<a href="'.$base.'prosumidor/comprar/fazerComprar/'.$pedido->getIdPedido().'" class="btn btn-danger">Adicionar Produto</a>';
			}
		?>
		<h2>Produtos Selecionados</h2>
		<table>
			<thead>
			  <tr>
			    <th>Foto</th>
			    <th>Produto</th>
			    <th>Quantidade</th>
			    <th>Valor<th>
			    	<?php
			    		if($prosumidor->getStatus() == 1 && $pedido->getValidacao() == 0){
			    			echo '<th>Editar</th>';
			    			echo '<th>Remover</th>';
			    		}
			    	?>
			  </tr>
			</thead>
			<tbody>
			<?php
				if(isset($compras)){
					foreach($compras as $key){
						echo '<tr>';
						foreach ($produtos as $a) {
							if($a->getIdProduto() == $key->getIdProduto()){
								if ($a->getFoto() != '0')
									echo '<td><center><img style="display: inline;" src="'.$base.'images/produtos/'.$a->getFoto().'" width="50" height="50" /></center></td>';
								else
									echo '<td><center><img style="display: inline;" src="'.$base.'images/produtos/semfoto.png" width="50" height="50" /></center></td>';
								echo '<td>'.$a->getNome().'</td>';
							}
						}
						echo '<td>'.$key->getQtdComprada().'</td>';
						echo '<td>'.$key->getValor().'</td>';

						if($prosumidor->getStatus() == 1 && $pedido->getValidacao() == 0){
							echo '<td><a href="'.$base.'prosumidor/comprar/editarCompra/'.$key->getIdCompra().'" class="btn btn-danger">Editar</a></td>';
							echo '<td><a href="'.$base.'prosumidor/comprar/removerCompra/'.$key->getIdCompra().'" class="btn btn-danger">Remover</a></td>';
						}
						echo'</tr>';
					}
				}
			?>
			</tbody>
		</table>
		<br /><br />
		<?php
			if($prosumidor->getStatus() == 1 && $pedido->getValidacao() == 0)
				echo '<a href="'.$base.'prosumidor/comprar/confirmarPedido/'.$pedido->getIdPedido().'" class="btn btn-danger">Confirmar Pedido</a>';
			echo '<a href="'.$base.'prosumidor/comprar/pedidos/" class="btn btn-danger">Voltar</a>';
		?>
	</div>
</body>
</html>