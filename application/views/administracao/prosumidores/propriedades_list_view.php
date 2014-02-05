	<?php 		
		$base = $this->config->item('base_url');
	?>
<html>
<body>
	<div>
	<h2>Propriedades do <?php echo $prosumidor->getNome();?></h2>
	<br><br>

	<table>
		<thead>
		  <tr>
		    <th>Nome</th>
		    <th>Endereco</th>
		    <th>Tamanho</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
				if(isset($propriedades)){
					foreach($propriedades as $a){	
						echo '<tr>';
						echo '<td>'.$a->getNome().'</td>';
						echo '<td>'.$a->getEndereco().'</td>';
						echo '<td>'.$a->getTamanho().'</td>';
						echo '</tr>';
					}
				}
			?>
		</tbody>
	</table>
    <?php 
		echo '&nbsp;<a href="'.$base.'administracao/prosumidores" class="btn btn-danger">Voltar</a>';
	?>
    <br /><br />
	</div>
</body>
</html>