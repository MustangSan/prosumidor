	<?php 		
		$base = $this->config->item('base_url');
	?>
<html>
<body>
		<div>
		<h2>Area Prosumidor</h2>
		<br><br>
		<h3>Produtos Cadastrados</h3>
		<table>
			<thead>
			  <tr>
			    <th>IdProduto</th>
			    <th>Nome</th>
			    <th>Preco</th>
			    <th>Validade</th>
			    <th>Unidade</th>
			    <th>Disponivel</th>
			    <th>Descricao</th>
			    <th>IdCat</th>
			    <th>Foto</th>
			  </tr>
			</thead>
			<tbody>
				<?php 
					if(isset($produtos)){
						foreach($produtos as $a){	
							echo '<tr>';
							echo '<td>'.$a->getIdProduto().'</td>';
							echo '<td>'.$a->getNome().'</td>';
							echo '<td>'.$a->getPreco().'</td>';
							echo '<td>'.$a->getValidade().'</td>';
							echo '<td>'.$a->getUnidade().'</td>';
							if($a->getDisponibilidade() == 1)
								echo '<td>Sim</td>';
							else
								echo  '<td>Não</td>';
							//echo '<td>'.$a->getDisponibilidade().'</td>';
							echo '<td>'.$a->getDescricao().'</td>';
							if(isset($categorias)){
								foreach ($categorias as $key) {
									if($key->getIdCategoria() == $a->getIdCategoria())
										echo '<td>'.$key->getNome().'</td>';
								}
							}							
							if ($a->getFoto() != '0')
								echo '<td><img style="display: inline;" src="'.$base.'images/produtos/'.$a->getFoto().'" width="50" height="50" /></td>';
							else
								echo '<td><img style="display: inline;" src="'.$base.'images/produtos/semfoto.png" width="50" height="50" /></td>';
							echo '</tr>';
						}
					}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>