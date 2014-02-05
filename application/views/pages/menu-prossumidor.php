<?php $base = $this->config->item('base_url'); ?>

    <div class="side-bar-wrapper collapse navbar-collapse navbar-ex1-collapse">
      <a class="logo hidden-sm hidden-xs">
        <i class="icon-shopping-cart"></i>
        <span>Área Do Prosumidor</span>
      </a>

      <div class="search-box">
        <input type="text" placeholder="PROCURAR" class="form-control">
      </div>

      <ul class="side-menu">
        <li class="<?php echo($this->uri->segment(2)==='inicio')?'current':'' ?>">
          <a href="<?php echo $base ?>prosumidor/inicio">
            <i class="icon-home"></i> Início
          </a>
        </li>
      </ul>

      <div class="relative-w">
        <ul class="side-menu">
          <li class="<?php echo($this->uri->segment(2)==='editar')?'current':'' ?>">
            <a href="<?php echo $base ?>prosumidor/editar">
              <i class="icon-edit"></i> Editar Perfil
            </a>
          </li>
        <?php if($this->session->userdata('tipo') == 2){
          echo '<li class="'.(($this->uri->segment(2)==='propriedades')?'current':'').'">';
            echo '<a href="'.$base.'prosumidor/propriedades">';
              echo '<i class="icon-map-marker"></i> Minhas Terras';
            echo '</a>';
          echo '</li>';
        }?>
          <li class="<?php echo($this->uri->segment(2)==='comprar')?'current':'' ?>">
            <a href="<?php echo $base ?>prosumidor/comprar">
              <i class="icon-credit-card"></i> Comprar
            </a>
          </li>
        <?php if($this->session->userdata('tipo') == 2){
          echo '<li class="'.(($this->uri->segment(2)==='vender')?'current':'').' ">';
            echo '<a href="'.$base.'prosumidor/vender">';
              echo '<i class="icon-truck"></i> Vender';
            echo '</a>';
          echo '</li>';
        }?>
          <li>
            <a href="<?php echo $base ?>prosumidor/logout">
              <i class="icon-signin"></i> Sair
            </a>
          </li>
        </ul>
      </div>
    </div>