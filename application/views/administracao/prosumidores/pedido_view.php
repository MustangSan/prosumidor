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
		<h2>Produtos Selecionados</h2>
		<table>
			<thead>
			  <tr>
			    <th>Foto</th>
			    <th>Produto</th>
			    <th>Quantidade</th>
			    <th>Valor<th>
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
						echo'</tr>';
					}
				}
			?>
			</tbody>
		</table>
		<br /><br />
		<?php
			echo '<a href="'.$base.'administracao/prosumidores/pedidos/'.$idProsumidor.'" class="btn btn-danger">Voltar</a>';
		?>
	</div>
</body>
</html>