<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="box-shadow:0 0 4px #DDD;">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= $this->notif->getMeNotif('0')[1] > 0 ? 'ani-getar' : ''; ?>"  href="<?=site_url('Notif/notif')?>" style="
    background: #f3f3f3;
    border-radius: 10px;
"><i class="fas fa-bell"></i> Notification <label class="label label-warning" style="background:#fd7e14;color:#FFF;border-radius:5px;font-size:14px;padding:0 4px;"><?=$this->notif->getMeNotif('0')[1];?></label></a>
    </li>
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
    <img src="<?= base_url('template/logo/korlantas.png');?>" alt="Logo" class=""
    style="opacity: .8; height: 40px;">
  </a>
  
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?=$this->bantuan->getUser()['nama'];?></br></a>
      </div>
    </div>
    
    <nav class="mt-2" style="font-size:14px; padding-bottom: 100px;">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      
      <!-- <li class="nav-item has-treeview">
            <a href="<?=site_url('Absensi/absen_online')?>" class="nav-link">
              <i class="nav-icon fas fa-fingerprint"></i>
              <p>
                Absen Online                              
              </p>
            </a>
        </li> -->

      <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              My Profile <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview fn14" style="display: none;">
        <li class="nav-item has-treeview">
            <a href="<?=site_url('dashboard')?>" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Dashboard                              
              </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fingerprint"></i>
              <p>
                My Attendance <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview fn14" style="display: none;">
              
              <li class="nav-item has-treeview">
                <a href="<?= site_url('absensi') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Recap                                      
                  </p>
                </a>  
              </li>

              <?php if ($this->session->userdata('leader') == 1) { ?>
                <li class="nav-item has-treeview">
                  <a href="<?= site_url('absensi/absenceMember') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Recap Member                                    
                    </p>
                  </a>  
                </li>
              <?php } ?>

            </ul>
            
            <li class="nav-item">
              <a href="<?= site_url('payroll/data_gaji_karyawan'); ?>" class="nav-link">
                <i class="nav-icon far fa-money-bill-alt"></i>
                <p>
                  My Salary History
                </p>
              </a>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                My Submission <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview fn14" style="display: none;">
              <li class="nav-item has-treeview">
                <a href="<?= site_url('absensi/request') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Absence Request                                      
                  </p>
                </a>
              </li>

              <li class="nav-item has-treeview">
                <a href="<?=site_url('hcm/my_list_izin_cuti')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My List Submission</p>
                </a>    
              </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('finance/reimburse'); ?>" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Reimburse
              </p>
            </a>
        </li>
        </li>     
        <!-- <li class="nav-item">
          <a href="<?=site_url('training/list_training')?>" class="nav-link">
            <i class="nav-icon fas fa-graduation-cap"></i>
            <p>
              My Training
            </p>
          </a>
        </li> -->
        <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-car"></i>
                <p>
                Peminjaman Kendaraan <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview fn14" style="display: none;">
              <li class="nav-item has-treeview">
                <a href="<?= site_url('SCM/form_pengajuan_mobil') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Form Pengajuan                                   
                  </p>
                </a>
              </li>

              <li class="nav-item has-treeview">
                <a href="<?=site_url('SCM/pengajuan_peminjaman_mobil')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Peminjaman Saya</p>
                </a>    
              </li>
            </ul>
        </li>
        </ul>
      </li>
      <li class="nav-item has-treeview">
          <a href="<?= site_url('hcm/tracking_covk') ?>" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
              Tracking Covid
              </p>
          </a>
      </li>

      <li class="nav-header d-block" >WORK</li>
               
      <?= $this->bantuan->setup_menu();?>

      
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>