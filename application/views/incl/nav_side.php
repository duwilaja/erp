<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="box-shadow:0 0 4px #DDD;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <?php foreach (@$this->bantuan->submenu_db($this->uri->segment(1).'/'.$this->uri->segment(2)) as $v) { ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=site_url($v->target)?>" class="nav-link"><?=$v->menu?></a>
      </li>
      <?php } ?> 
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" href="<?=site_url('Auth/logout')?>">
          <i class="fas fa-sign-out-alt"></i>
           Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center bg-white">
      <img src="<?= base_url('template/logo/logo.png');?>" alt="Matrik Logo" class=""
           style="opacity: .8; height: 40px;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="<?= base_url('template/logo/user.png');?>" alt="User Logo"  class="img-circle elevation-2" >
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$this->bantuan->getUser()['nama'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <?php foreach ($this->bantuan->menus()->get('',['type' => '1','status' => 1])->result() as $v) { ?>
          <li class="nav-item has-treeview">
            <a href="<?=site_url($v->target)?>" class="nav-link">
              <i class="<?=$v->icon;?>"></i>
              <p>
                <?=$v->menu;?>
                <?php if ($v->target == '#') { ?>
                  <i class="right fas fa-angle-left"></i>
                <?php } ?>
              </p>
            </a>
            <?php if ($this->bantuan->menus()->get('',['type' => '2','induk_menu' => $v->id,'status' => 1])->num_rows() > 0) { ?> 
            <ul class="nav nav-treeview fn14" style="display: none;">
            
             <?php foreach ($this->bantuan->menus()->get('',['type' => '2','induk_menu' => $v->id,'status' => 1])->result() as $m2) { ?>
              <li class="nav-item has-treeview">
                <a href="<?=site_url($m2->target)?>" class="nav-link">
                  <i class="<?=$m2->icon;?>"></i>
                  <p>
                    <?=$m2->menu;?>
                    <?php if ($m2->target == '#') { ?>
                      <i class="right fas fa-angle-left"></i>
                    <?php } ?>
                  </p>
                </a>

                  <?php if ($this->bantuan->menus()->get('',['type' => '3','induk_menu' => $m2->id,'status' => 1])->num_rows() > 0) { ?> 
                  <ul class="nav nav-treeview" style="display: none;">
                    <?php foreach ($this->bantuan->menus()->get('',['type' => '3','induk_menu' => $m2->id,'status' => 1])->result() as $m3) { ?>
                      <li class="nav-item">
                        <a href="<?=site_url($m3->target)?>" class="nav-link">
                            <i class="<?=$m3->icon;?>"></i>
                            <p>
                              <?=$m3->menu;?>
                            </p>
                        </a>
                      </li>
                    <?php } ?>
                  </ul>
                  <?php } ?>

              </li>
             <?php } ?>

            </ul>
            <?php } ?>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>