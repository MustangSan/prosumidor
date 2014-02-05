	<?php 		
		$base = $this->config->item('base_url');
	?>
<html>
<body>
		<div>
		<h2>Produtos</h2>
		<br><br>
		<table>
			<thead>
			  <tr>
			  	<th>Foto</th>
			    <th>Nome</th>
			    <th>Preco</th>
			    <th>Validade</th>
			    <th>Unidade</th>
			    <th>Disponivel</th>
			    <th>Descricao</th>
			    <th>Categoria</th>
			    <?php //for ($i=0; $i < $numClass; $i++) { 
			    	//echo '<th></th>';
			    //}?>
			  </tr>
			</thead>
			<tbody>
				<?php 
					//if(isset($produtos)){
						//foreach($produtos as $a){	
							echo '<tr>';
							if ($produtos->getFoto() != '0')
								echo '<td><img style="display: inline;" src="'.$base.'images/produtos/'.$produtos->getFoto().'" width="50" height="50" /></td>';
							else
								echo '<td><img style="display: inline;" src="'.$base.'images/produtos/semfoto.png" width="50" height="50" /></td>';							
							echo '<td>'.$produtos->getNome().'</td>';
							echo '<td>'.$produtos->getPreco().'</td>';
							echo '<td>'.$produtos->getValidade().'</td>';
							echo '<td>'.$produtos->getUnidade().'</td>';
							
							if($produtos->getDisponibilidade() == 1)
								echo '<td><center>Sim</center></td>';
							else
								echo  '<td><center>Não</center></td>';
							
							echo '<td>'.$produtos->getDescricao().'</td>';
							echo '<td>'.$categoria->getNome().'</td>';
							if(isset($class)){
								foreach ($class as $key) {
									echo '<td>'.$key->getNome().'</td>';
								}
							}
							echo '</tr>';
						//}
					//}
				?>
			</tbody>
		</table>
        <?php 
        	echo '&nbsp;<a href="'.$base.'prosumidor/inicio/" class="btn btn-danger">Voltar</a>';
        	//echo '<a href="'.$base.'administradores/exportar/"><button>Exportar</button></a>';
		?>
        <br /><br />
	</div>
</body>
</html>