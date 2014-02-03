	<?php 		
		$base = $this->config->item('base_url');
	?>
<html>
<body>
		<div>
		<h2>Administradores Cadastrados</h2>
		<br />
        <a href="<?php echo $base; ?>administracao/administradores/inserirAdministrador/"><button>Novo Administrador</button></a>
		<br><br>

		<table>
			<thead>
			  <tr>
			    <th>IdAdmin</th>
			    <th>Nome</th>
			    <th>E-mail</th>
			    <th>Editar</th>
			    <th>Remover</th>

			  </tr>
			</thead>
			<tbody>
				<?php 
					if(isset($administradores)){
						foreach($administradores as $a){	
							echo '<tr>';
							echo '<td>'.$a->getIdAdministrador().'</td>';
							echo '<td>'.$a->getNome().'</td>';
							echo '<td>'.$a->getEmail().'</td>';
							echo '<td><a href="'.$base.'administracao/administradores/editarAdministrador/'.$a->getIdAdministrador().'"><button>Editar</button></a></td>';
							echo '<td><a href="'.$base.'administracao/administradores/removerAdministrador/'.$a->getIdAdministrador().'"><button>Remover</button></a></td>';
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