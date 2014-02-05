<?php $base = $this->config->item('base_url'); ?>

    <div class="side-bar-wrapper collapse navbar-collapse navbar-ex1-collapse">
      <a class="logo hidden-sm hidden-xs">
        <i class="icon-bolt"></i>
        <span>Área Do Administrador</span>
      </a>

      <div class="search-box">
        <input type="text" placeholder="PROCURAR" class="form-control">
      </div>

      <ul class="side-menu">
        <li class="<?php echo($this->uri->segment(2)==='inicio')?'current':'' ?>">
          <a href="<?php echo $base ?>administracao/inicio">
            <i class="icon-home"></i> Início
          </a>
        </li>
      </ul>

      <div class="relative-w">
        <ul class="side-menu">
          <li class="<?php echo($this->uri->segment(2)==='administradores')?'current':'' ?>">
            <a href="<?php echo $base ?>administracao/administradores/">
              <i class="icon-bolt"></i> Administradores
            </a>
          </li>
          <li class="<?php echo($this->uri->segment(2)==='prosumidores')?'current':'' ?>">
            <a href="<?php echo $base ?>administracao/prosumidores/">
              <i class="icon-user"></i> Usuários
            </a>
          </li>
          <li class="<?php echo($this->uri->segment(2)==='produtos')?'current':'' ?>">
            <a href="<?php echo $base ?>administracao/produtos">
              <i class="icon-ticket"></i> Produtos
            </a>
          </li>
          <li class="<?php echo($this->uri->segment(2)==='categorias')?'current':'' ?>">
            <a href="<?php echo $base ?>administracao/categorias/">
              <i class="icon-list-ul"></i> Categorias
            </a>
          </li>
          <li class="<?php echo($this->uri->segment(2)==='classificacoes')?'current':'' ?>">
            <a href="<?php echo $base ?>administracao/classificacoes/">
              <i class="icon-sort-by-attributes"></i> Classificações
            </a>
          </li>
          <li>
            <a href="<?php echo $base ?>administracao/logout">
              <i class="icon-signin"></i> Sair
            </a>
          </li>
        </ul>
      </div>
    </div>