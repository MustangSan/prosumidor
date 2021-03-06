<?php 
  $this->load->view('pages/header.php');
  $base = $this->config->item('base_url');
?>

<div class="all-wrapper">
  <div class="row">
    <div class="col-md-3">
      <div class="text-center">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

    <?php $this->load->view('pages/menu-administrador.php'); ?>
    </div>

    <div class="col-md-9">
      <div class="content-wrapper wood-wrapper">
        <div class="content-inner">
          <div class="page-header page-header-dark-blue">
            <h1><i class="icon-user"></i> Usuários</h1>
          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
                      <div class="widget">
                        <h3 class="form-title form-title-first"><i class="icon-group"></i> Informações do Usuário</h3>
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Nome</th>
                              <th>E-mail</th>
                              <th>CPF</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              echo '<tr>';
                              echo '<td>'.$prosumidor->getNome().'</td>';
                              echo '<td>'.$prosumidor->getEmail().'</td>';
                              echo '<td>'.$prosumidor->getCPF().'</td>';
                              echo '</tr>';
                            ?>
                          </tbody>
                        </table>
                        </div>

                        <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Endereço</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              echo '<tr>';
                              echo '<td>'.$prosumidor->getEndereco().'</td>';
                              echo '</tr>';
                            ?>
                          </tbody>
                        </table>
                        </div>

                        <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Telefone</th>
                              <th>Sexo</th>
                              <th>Status</th>
                              <th>Tipo</th>
                              <th>Saldo</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              echo '<tr>';
                              echo '<td>'.$prosumidor->getTelefone().'</td>';
                              echo '<td>'.$prosumidor->getSexo().'</td>';

                              if($prosumidor->getStatus() == 1 )
                                echo '<td><span class="label label-primary">Normal</span></td>';
                              else 
                                if($prosumidor->getStatus() == 2 )
                                  echo '<td><span class="label label-danger">Bloqueado</span></td>';

                              if($prosumidor->getTipo() == 1 ) 
                                echo '<td>Consumidor</td>';
                              else 
                                if($prosumidor->getTipo() == 2 )
                                  echo '<td>Prosumidor</td>';

                              echo '<td>'.$prosumidor->getSaldoConsumidor().'</td>';
                              echo '</tr>';
                            ?>
                          </tbody>
                        </table>
                        </div>
                        <a href="<?php echo $base; ?>administracao/prosumidores/pedidos/<?php echo $prosumidor->getIdProsumidor(); ?>" class="btn btn-primary">Ver Pedidos </a>
                        <?php if($prosumidor->getTipo() == 2 ){ ?>
                          <a href="<?php echo $base; ?>administracao/prosumidores/transacoes/<?php echo $prosumidor->getIdProsumidor(); ?>" class="btn btn-primary"> Ver Vendas</a>
                        <?php } ?>
                      </div>
                      <?php if($prosumidor->getTipo() == 2){ ?>
                    	<h3 class="form-title form-title-first"><i class="icon-map-marker"></i> Propriedades Cadastradas</h3>
                    	<div class="table-responsive">
          						<table class="table table-striped table-bordered table-hover">
          							<thead>
          							  <tr>
          							    <th>Nome</th>
          							    <th>Endereco</th>
          							    <th width="90">Tamanho</th>
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
          			      </div>
                      <?php } ?>
                      <a href="<?php echo $base; ?>administracao/prosumidores/" class="btn btn-primary">Voltar</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('pages/footer.php'); ?>