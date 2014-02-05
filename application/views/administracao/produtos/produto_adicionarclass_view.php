<body>
<html>
	<?php 		
		$base = $this->config->item('base_url');
	?>
    
	<div class="conteudo">
		<h2>Cadastrar Classificacao no Produto</h2>
		<br />
<?php

			echo form_open('administracao/produtos/addBD/'.$idProduto);
			if(isset($class)){
			
				foreach ($class as $key) {
					$b = $key->getIdClassificacao();
					/*$data = array(
					'name'        => 'classi'.$b,
					'id'          => 'classi'.$b,
					'value'       => 1,
					'checked'     => FALSE
					);*/

					if(isset($idsClass)){
						foreach($idsClass as $a){
							if($key->getIdClassificacao() == $a['idClassificacao']){
								$data = array(
								'name'        => 'classi'.$b,
								'id'          => 'classi'.$b,
								'value'       => 1,
								'checked'     => TRUE
								);
								break;
								//$data = array(	//'value' => $b,
								//				'checked' => TRUE);
							}
							else{
								$data = array(
								'name'        => 'classi'.$b,
								'id'          => 'classi'.$b,
								'value'       => 1,
								'checked'     => FALSE
								);
							}
						}

					}
					else{
						$data = array(
						'name'        => 'classi'.$b,
						'id'          => 'classi'.$b,
						'value'       => 1,
						'checked'     => FALSE
						);
					}

				echo '<div class="input-prepend"> <span class="add-on input-round" style="width: 105px; padding-left: 10px; text-align: left;">'.form_checkbox($data).$key->getNome().'</span>';
				echo '</div><br>';

				}
			}
			$data = array(
			  'type'		=> 'submit',
              'name'        => 'submit',
              'id'          => 'submit',
			  'value' 		=> 'Concluir',
			  //'onclick'  	=> 'setTimeout(twoClicks, 1);'
            );
			echo form_input($data);
			
			form_close();
		
			echo '&nbsp;<a href="'.$base.'administracao/produtos/" class="btn btn-danger">Voltar</a>';
		?>
	</div>
</body>
</html>