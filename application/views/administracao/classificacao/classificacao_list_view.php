	<?php 		
		$base = $this->config->item('base_url');
	?>
<html>
<body>
		<div>
		<h2>Classificacao Cadastrados</h2>
		<br />
        <a href="<?php echo $base; ?>administracao/classificacoes/inserirClassificacao/"><button>Nova Classificacao</button></a>
		<br><br>

		<table>
			<thead>
			  <tr>
			    <th>IdClass</th>
			    <th>Nome</th>
			    <th>Descricao</th>
			    <th>Editar</th>
			    <th>Remover</th>

			  </tr>
			</thead>
			<tbody>
				<?php 
					if(isset($classificacoes)){
						foreach($classificacoes as $a){	
							echo '<tr>';
							echo '<td>'.$a->getIdClassificacao().'</td>';
							echo '<td>'.$a->getNome().'</td>';
							echo '<td>'.$a->getDescricao().'</td>';
							echo '<td><a href="'.$base.'administracao/classificacoes/editarClassificacao/'.$a->getIdClassificacao().'"><button>Editar</button></a></td>';
							echo '<td><a href="'.$base.'administracao/classificacoes/removerClassificacao/'.$a->getIdClassificacao().'"><button>Remover</button></a></td>';
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