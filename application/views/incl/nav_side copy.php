<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <?php foreach ($this->bantuan->submenu() as $v) { ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=site_url($v[1])?>" class="nav-link"><?=$v[0]?></a>
      </li>
      <?php } ?> 
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=site_url('main/finance')?>" class="nav-link">Finance</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=site_url('main/hcm')?>" class="nav-link">HCM</a>
      </li> -->
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
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
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url('template/');?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Matrik SAP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('template/');?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="<?=site_url('main/index')?>" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?=site_url('main/projek')?>" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Project
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview fn14">
              <li class="nav-item">
                <a href="<?=site_url('project/list_project')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Project</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('project/profitability_plan')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profitabiliy Plan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('project/project_archive')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Archive</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('project/request_invoicing')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Request for Invoicing</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Finance 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview fn14">
              <li class="nav-item">
                <a href="<?=site_url('main/tambah_finance')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Pengeluaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('main/finance')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                HCM
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview fn14">
              <li class="nav-item">
                <a href="<?=site_url('main/izin_cuti')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Izin Cuti</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('main/hcm')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Izin Cuti</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa fa-tasks"></i>
              <p>
                Oprations
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview fn14">
              <li class="nav-item">
                <a href="<?=site_url('oprations/all_ticket')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Ticket</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('oprations/my_ticket')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Ticket</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('oprations/my_group')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Group</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('oprations/report')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Report</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Payroll
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview fn14">
              <li class="nav-item">
                <a href="<?=site_url('payroll/data_gaji_karyawan')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Gaji Karyawan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview fn14" style="display: none;">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Employees
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="<?=site_url('karyawan/daftar_karyawan')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Employees List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Costumer</p>
                  <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="<?=site_url('customers/list_costumer')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Costumer List</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>