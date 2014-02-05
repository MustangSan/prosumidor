	<?php 		
		$base = $this->config->item('base_url');
	?>
<html>
<body>
		<div>
		<h2>Prosumidores Cadastrados</h2>
		<br><br>

		<table>
			<thead>
			  <tr>
			  	<th>E-mail</th>
			    <th>CPF</th>			    
			    <th>Nome</th>
			    <th>Endereco</th>
			    <th>Telefone</th>
			    <th>Sexo</th>
			    <th>Tipo</th>
			    <th>SaldoConsumidor(R$)</th>
			    <th>Status</th>
			    <th></th>
			    <th></th>
			  </tr>
			</thead>
			<tbody>
				<?php 
					if(isset($prosumidor)){
						foreach($prosumidor as $a){	
							echo '<tr>';
							echo '<td>'.$a->getEmail().'</td>';
							echo '<td>'.$a->getCPF().'</td>';
							echo '<td>'.$a->getNome().'</td>';
							echo '<td>'.$a->getEndereco().'</td>';
							echo '<td>'.$a->getTelefone().'</td>';
							echo '<td>'.$a->getSexo().'</td>';
							
							//Tipo
							if($a->getTipo() == 1 )
								echo '<td>Consumidor</td>';
							else 
								if($a->getTipo() == 2 )
									echo '<td>Prosumidor</td>'; 
							
							//Saldo
							echo '<td>'.$a->getSaldoConsumidor().'</td>';
							
							//Status
							if($a->getStatus() == 1 )
								echo '<td>Normal</td>';
							else 
								if($a->getStatus() == 2 )
									echo '<td>Bloqueado</td>';

							//Listar Propriedades se for vendedor
							if($a->getTipo() == 2 )
									echo '<td><a href="'.$base.'administracao/prosumidores/listarPropriedades/'.$a->getIdProsumidor().'"><button>Ver Propriedades</button></a></td>';
							else
								echo '<td></td>';

							//Bloquear ou desbloquear dependendo do status
							if($a->getStatus() == 1 )
								echo '<td><a href="'.$base.'administracao/prosumidores/bloquear/'.$a->getIdProsumidor().'"><button>Bloquear</button></a></td>';
							else 
								if($a->getStatus() == 2 )
									echo '<td><a href="'.$base.'administracao/prosumidores/desbloquear/'.$a->getIdProsumidor().'"><button>Desbloquear</button></a></td>';
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