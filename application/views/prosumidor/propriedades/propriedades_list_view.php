	<?php 		
		$base = $this->config->item('base_url');
	?>
<html>
<body>
	<div>
	<h2>Propriedades Cadastradss</h2>
	<br />
    <a href="<?php echo $base; ?>prosumidor/propriedades/inserirPropriedade/"><button>Nova Propriedade</button></a>
	<br><br>

	<table>
		<thead>
		  <tr>
		    <th>IdPropriedade</th>
		    <th>Nome</th>
		    <th>Endereco</th>
		    <th>Tamanho</th>
		    <th>IdProsumidor</th>
		    <th>Editar</th>
		    <th>Remover</th>

		  </tr>
		</thead>
		<tbody>
			<?php 
				if(isset($propriedades)){
					foreach($propriedades as $a){	
						echo '<tr>';
						echo '<td>'.$a->getIdPropriedade().'</td>';
						echo '<td>'.$a->getNome().'</td>';
						echo '<td>'.$a->getEndereco().'</td>';
						echo '<td>'.$a->getTamanho().'</td>';
						echo '<td>'.$a->getIdProsumidor().'</td>';
						echo '<td><a href="'.$base.'prosumidor/propriedades/editarPropriedade/'.$a->getIdPropriedade().'"><button>Editar</button></a></td>';
						echo '<td><a href="'.$base.'prosumidor/propriedades/removerPropriedade/'.$a->getIdPropriedade().'"><button>Remover</button></a></td>';
						echo '</tr>';
					}
				}
			?>
		</tbody>
	</table>
    <?php 
    	//echo '<a href="'.$base.'propriedades/exportar/"><button>Exportar</button></a>';
	?>
    <br /><br />
	</div>
</body>
</html>