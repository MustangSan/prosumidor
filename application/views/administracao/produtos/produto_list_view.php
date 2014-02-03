	<?php 		
		$base = $this->config->item('base_url');
	?>
<html>
<body>
		<div>
		<h2>Produtos Cadastrados</h2>
		<br />
        <a href="<?php echo $base; ?>administracao/produtos/inserirProduto/"><button>Novo Produto</button></a>
		<br><br>
		<table>
			<thead>
			  <tr>
			    <th>IdProduto</th>
			    <th>Nome</th>
			    <th>Preco</th>
			    <th>Validade</th>
			    <th>Unidade</th>
			    <th>Disponibilidade</th>
			    <th>Descricao</th>
			    <th>IdCat</th>
			    <th>Foto</th>
			    <th>Editar</th>
			    <th>Remover</th>
			    <th>Classificacao</th>
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
							echo '<td>'.$a->getDisponibilidade().'</td>';
							echo '<td>'.$a->getDescricao().'</td>';
							if(isset($categorias)){
								foreach ($categorias as $key) {
									if($key->getIdCategoria() == $a->getIdCategoria())
										echo '<td>'.$key->getNome().'</td>';
								}
							}
							//echo '<td>'.$a->getIdCategoria().'</td>';
							
							if ($a->getFoto() != '0')
								echo '<td><img style="display: inline;" src="'.$base.'images/produtos/'.$a->getFoto().'" width="50" height="50" /></td>';
							else
								echo '<td><img style="display: inline;" src="'.$base.'images/produtos/semfoto.png" width="50" height="50" /></td>';
							
							echo '<td><a href="'.$base.'administracao/produtos/editarProduto/'.$a->getIdProduto().'"><button>Editar</button></a></td>';
							echo '<td><a href="'.$base.'administracao/produtos/removerProduto/'.$a->getIdProduto().'"><button>Remover</button></a></td>';
							echo '<td><a href="'.$base.'administracao/produtos/adicionarClassificacao/'.$a->getIdProduto().'"><button>Add Class</button></a></td>';
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