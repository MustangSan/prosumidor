<html>
<body>
	<div>
		<h2>Estatisticas</h2>
		<table>
			<thead>
			  <tr>
			    <th>Quantidade Prosumidor</th>
			    <th>Quantidade Produtos</th>
			    <th>Quantidade Categorias</th>
			    <th>Quantidade Classificacoes</th>
			  </tr>
			</thead>
			<tbody>
				<?php 
					echo '<tr>';
					echo '<td>'.$prosumidor.'</td>';
					echo '<td>'.$produtos.'</td>';
					echo '<td>'.$categorias.'</td>';
					echo '<td>'.$class.'</td>';
					echo '</tr>';
				?>
			</tbody>
		</table>
	</div>
</body>
</html>