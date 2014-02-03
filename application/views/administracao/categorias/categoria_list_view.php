	<?php 		
		$base = $this->config->item('base_url');
	?>
<html>
<body>
		<div>
		<h2>Categorias Cadastrados</h2>
		<br />
        <a href="<?php echo $base; ?>administracao/categorias/inserirCategoria/"><button>Nova Categoria</button></a>
		<br><br>

		<table>
			<thead>
			  <tr>
			    <th>IdCategoria</th>
			    <th>Nome</th>
			    <th>Descricao</th>
			    <th>Editar</th>
			    <th>Remover</th>

			  </tr>
			</thead>
			<tbody>
				<?php 
					if(isset($categorias)){
						foreach($categorias as $a){	
							echo '<tr>';
							echo '<td>'.$a->getIdCategoria().'</td>';
							echo '<td>'.$a->getNome().'</td>';
							echo '<td>'.$a->getDescricao().'</td>';
							echo '<td><a href="'.$base.'administracao/categorias/editarCategoria/'.$a->getIdCategoria().'"><button>Editar</button></a></td>';
							echo '<td><a href="'.$base.'administracao/categorias/removerCategoria/'.$a->getIdCategoria().'"><button>Remover</button></a></td>';
							echo '</tr>';
						}
					}
				?>
			</tbody>
		</table>
        <?php 
        	//echo '<a href="'.$base.'administradores/exportar/"><button>Exportar</button></a>';
		?>
        <br /><br />
	</div>
</body>
</html>