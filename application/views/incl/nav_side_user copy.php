<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="box-shadow:0 0 4px #DDD;">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="<?=site_url('Notif/notif')?>"><i class="fas fa-bell"></i> Notification <label class="label label-warning" style="background:#fd7e14;color:#FFF;border-radius:5px;font-size:14px;padding:0 4px;"><?=$this->notif->getMeNotif('0')[1];?></label></a>
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
    <img src="<?= base_url('template/logo/logo.png');?>" alt="Matrik Logo" class=""
    style="opacity: .8; height: 40px;">
  </a>
  
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?=$this->bantuan->getUser()['nama'];?></a>
      </div>
    </div>
    
    <nav class="mt-2" style="font-size:14px; padding-bottom: 100px;">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
      
      <li class="nav-item">
        <a href="<?=site_url('training/list_training')?>" class="nav-link">
          <i class="nav-icon fas fa-graduation-cap"></i>
          <p>
            My Training
          </p>
        </a>
      </li>

      <li class="nav-header">WORK</li>


      <?php if ($this->session->userdata('level') == '54') { ?> 

        <li class="nav-item has-treeview">
          <a href="<?=site_url('payroll/data_gaji_karyawan_all')?>" class="nav-link">
            <i class="nav-icon fas fa-id-card-alt"></i>
            <p>
              Slip Gaji Karyawan
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-wallet"></i>
            <p>
              Petty Cash <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('finance/budget_request')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Budget Request</p>
              </a>    
            </li>

            <li class="nav-item has-treeview">
              <a href="<?=site_url('finance/internal')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Internal</p>
              </a>    
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('finance/project')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Project</p>
              </a>    
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cash-register"></i>
            <p>
              Financial Receipts <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('finance/list_receipts')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Receipts</p>
              </a>    
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-hand-holding-usd"></i>
            <p>
              Piutang <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('finance/piutang')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Piutang</p>
              </a>    
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-money-check-alt"></i>
            <p>
              Hutang <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('finance/hutang_internal')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Internal</p>
              </a>    
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('finance/hutang_vendor')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Vendor/Partner</p>
              </a>    
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('finance/hutang_supplier')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Supplier</p>
              </a>    
            </li>
          </ul>
        </li>
      <?php } ?>
      
      
      <!-- Menu Level 3-->
      <?php if ($this->session->userdata('level') == '3' || $this->session->userdata('level') == '33') { ?>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-fingerprint"></i>
            <p>
              Attendance <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('absensi/absensiAll')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Attendance Employess</p>
              </a>    
            </li>
            
            <li class="nav-item has-treeview">
              <a href="<?=site_url('absensi/rekap_bulanan')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Monthly Recap</p>
              </a>    
            </li>
            
            <li class="nav-item has-treeview">
              <a href="<?=site_url('absensi/rekap_tahunan')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Annual Recap</p>
              </a>    
            </li>
            
          </ul>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-wallet"></i>
            <p>
              Payroll <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item">
              <a href="<?= site_url('payroll/data_gaji_karyawan_all'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon  "></i>
                <p>
                  Salary History
                </p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              KPI <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('kpi/list_kpi/1')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List KPI</p>
              </a>    
            </li>
          </ul>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-graduation-cap"></i>
            <p>
              Training <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('training/list_training')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Training</p>
              </a>    
            </li>
          </ul>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-tie"></i>
            <p>
              Recruitment <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('hcm/list_lowongan')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Lowongan</p>
              </a>    
            </li>
          </ul>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-history"></i>
            <p>
              historical position <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('hcm/historical_position')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Karyawan</p>
              </a>    
            </li>
          </ul>
        </li>
        
      <?php } ?>

      <?php if ($this->session->userdata('leader') ||  $this->session->userdata('level') == '3' || $this->session->userdata('level') == '33') { ?>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Submissions <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('hcm/list_izin_cuti')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Request Submission</p>
              </a>    
            </li> 
            <li class="nav-item has-treeview">
              <a href="<?=site_url('hcm/list_receive')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Submission Receive</p>
              </a>    
            </li> 
            <li class="nav-item has-treeview">
              <a href="<?=site_url('hcm/list_reject')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Submission Reject</p>
              </a>    
            </li> 
          </ul>
        </li>

      <?php } ?>
      
      <?php if ($this->bantuan->accMenu('1','1',$this->session->userdata('karyawan_id'))) { ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tools"></i>
            <p>
              Preventive maintenance<i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/preventive')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Prventive Maintenance</p>
              </a>    
            </li>
          </ul>
        </li>
      <?php } ?>
      
      <!-- Menu Level 4 / Operation And maintenance-->
      <?php if ($this->session->userdata('level') == '4') { ?>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-thumbtack"></i>
            <p>
              Daily Task <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('dailytask/list_task')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Task</p>
              </a>    
            </li>
          </ul>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              KPI <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('kpi/list_kpi/1')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List KPI</p>
              </a>    
            </li>
          </ul>
        </li>
        
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa fa-tasks"></i>
            <p>Ticketing<i class="right fas fa-angle-left"></i></p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/all_ticket')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Ticket</p>
              </a>                       
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/my_ticket')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>My Ticket</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/my_group')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>My Group</p>
              </a>
              
              
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/maintenance')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Maintenance</p>
              </a>
              
              
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/report')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Report Ticket</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/report_maint')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Report Maintenance</p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Customer Technical Data <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/tcustomers_data')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Data</p>
              </a>    
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-handshake"></i>
            <p>
              Partner Request <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/partner_request')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Request</p>
              </a>    
            </li>
          </ul>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-truck-loading"></i>
            <p>
              Inventory <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/customer_device')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Customer Device</p>
              </a>    
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/stock')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Stock</p>
              </a>    
            </li>
            
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/replace')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Replace</p>
              </a>    
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/rma')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>RMA</p>
              </a>    
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Setting <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/tic_category')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Category</p>
              </a>    
            </li>
            
            <li class="nav-item has-treeview">
              <a href="<?=site_url('oprations/tic_subject')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Subject</p>
              </a>    
            </li>

          </ul>
        </li> 
      <?php } ?>

      <!-- <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-user-lock"></i>
            <p>Privilege</p> <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('privilage/privilage')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Privilage</p>
              </a>    
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('privilage/privilage_menu')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Menu</p>
              </a>    
            </li>

            <li class="nav-item has-treeview">
              <a href="<?=site_url('privilage/privilage_submenu')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sub Menu</p>
              </a>    
            </li>
          </ul>    
        </li> -->

      <!-- Menu Level 56 / Sales-->
      <?php 
      $ses = $this->session->userdata('level');

      if ($ses == '56') { ?>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
              Data Master <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('selma/data_customers')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Customers</p>
              </a>    
            </li>
            

            <li class="nav-item has-treeview">
              <a href="<?=site_url('selma/end_customers')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>End Customers</p>
              </a>    
            </li>

            <li class="nav-item has-treeview">
              <a href="<?=site_url('selma/data_sales')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sales</p>
              </a>    
            </li>

            <li class="nav-item has-treeview">
              <a href="<?=site_url('selma/data_solution')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Solution</p>
              </a>    
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('selma/data_products')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Product</p>
              </a>    
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-thumbtack"></i>
            <p>
              Pipeline <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('selma/pipeline')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Pipeline</p>
              </a>    
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="<?=site_url('selma/sales_schedule')?>" class="nav-link">
            <i class="nav-icon fas fa-calendar-day"></i>
            <p>
              Sales Schedule
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-funnel-dollar"></i>
            <p>
              Marketing Program<i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('selma/marketing_program')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Program</p>
              </a>    
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-wallet"></i>
            <p>
              Billing Process<i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('selma/contract_list')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Contract List</p>
              </a>    
            </li>

            <li class="nav-item has-treeview">
              <a href="<?=site_url('selma/invoice')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Invoice</p>
              </a>    
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fab fa-wpforms"></i>
            <p>
              Form<i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('selma/mutation')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Mutation</p>
              </a>    
            </li>

            <li class="nav-item has-treeview">
              <a href="<?=site_url('selma/dismantle')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dismantle</p>
              </a>    
            </li>
          </ul>
        </li>
      <?php } ?>
      

      <!-- Menu Level 34 / Customer Care Centre-->
      <?php if ($this->session->userdata('level') == '34') { ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
             Data Master PIC <i class="right fas fa-angle-left"></i>
           </p>
         </a>
         
         <ul class="nav nav-treeview fn14" style="display: none;">
          <li class="nav-item has-treeview">
            <a href="<?=site_url('cc/data_master')?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>List Data</p>
            </a>    
          </li>
        </ul>
      </li>

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-book"></i>
          <p>
            Customer Technical Data <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        
        <ul class="nav nav-treeview fn14" style="display: none;">
          <li class="nav-item has-treeview">
            <a href="<?=site_url('oprations/tcustomers_data')?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>List Data</p>
            </a>    
          </li>
        </ul>
      </li>

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon far fa-handshake"></i>
          <p>
            Data Partner <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        
        <ul class="nav nav-treeview fn14" style="display: none;">
          <li class="nav-item has-treeview">
            <a href="<?=site_url('cc/data_partner')?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>List Data</p>
            </a>    
          </li>
        </ul>
      </li>

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-file-contract"></i>
          <p>
            Report List <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        
        <ul class="nav nav-treeview fn14" style="display: none;">
          <li class="nav-item has-treeview">
            <a href="<?=site_url('cc/report_list')?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Daily</p>
            </a>    
          </li>
          <li class="nav-item has-treeview">
            <a href="<?=site_url('cc/report_weekly')?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Weekly</p>
            </a>    
          </li>
          <li class="nav-item has-treeview">
            <a href="<?=site_url('cc/report_monthly')?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Monthly</p>
            </a>    
          </li>
        </ul>
      </li>

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-users-cog"></i>
          <p>
            Service Quality Assurance<i class="right fas fa-angle-left"></i>
          </p>
        </a>
        
        <ul class="nav nav-treeview fn14" style="display: none;">
          <li class="nav-item has-treeview">
            <a href="<?=site_url('cc/sqa')?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Ticketing Billing</p>
            </a>    
          </li>
        </ul>
      </li>

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-paste"></i>
          <p>
            Data Preventive<i class="right fas fa-angle-left"></i>
          </p>
        </a>
        
        <ul class="nav nav-treeview fn14" style="display: none;">
          <li class="nav-item has-treeview">
            <a href="<?=site_url('cc/preventive_eos')?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Reporting EOS</p>
            </a>    
          </li>
          <li class="nav-item has-treeview">
            <a href="<?=site_url('cc/preventive_ticketing')?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Ticketing</p>
            </a>    
          </li>
        </ul>
      </li>

    <?php } ?>

    <?php if ( $this->bantuan->access('ticket',$this->session->userdata('karyawan_id')) == 1) { ?>

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa fa-tasks"></i>
          <p>Ticketing<i class="right fas fa-angle-left"></i></p>
        </a>
        
        <ul class="nav nav-treeview fn14" style="display: none;">
          
          <li class="nav-item has-treeview">
            <a href=<?=site_url("oprations/all_ticket");?> class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>All Ticket</p>
            </a>                       
          </li>
          <li class="nav-item has-treeview">
            <a href=<?=site_url("oprations/my_ticket");?> class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>My Ticket</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href=<?=site_url("oprations/my_group");?> class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>My Group</p>
            </a>
            
            
          </li>
          <li class="nav-item has-treeview">
            <a href=<?=site_url("oprations/maintenance");?> class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Maintenance</p>
            </a>
            
            
          </li>
          <li class="nav-item has-treeview">
            <a href=<?=site_url("oprations/report");?> class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Report Ticket</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href=<?=site_url("oprations/report_maint");?> class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Report Maintenance</p>
            </a>
          </li>
        </ul>
      </li>
      
    <?php } ?>

    <!-- Menu Level 10 / Project Management (PM) -->
    <?php if ($this->session->userdata('level') == '10') { ?>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-briefcase"></i>
          <p>
            Work Order<i class="right fas fa-angle-left"></i>
          </p>
        </a>
        
        <ul class="nav nav-treeview fn14" style="display: none;">
          <li class="nav-item has-treeview">
            <a href="<?=site_url('pm/work_order')?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>List Work</p>
            </a>    
          </li>
        </ul>
      </li>

      <li class="nav-item has-treeview">
        <a href="<?=site_url('pm/project_running')?>" class="nav-link">
          <i class="nav-icon fas fa-clipboard-list"></i>
          <p>
            Project Running
          </p>
        </a>
      </li>

      <li class="nav-item has-treeview">
        <a href="<?=site_url('pm/documentation')?>" class="nav-link">
          <i class="nav-icon fas fa-file-alt"></i>
          <p>
            Documentation
          </p>
        </a>
      </li>
    <?php } ?>


    <!-- Menu Level 40 / Vendor Management (VM) -->
    <?php if ($this->session->userdata('level') == '40') { ?>
      <li class="nav-item has-treeview">
        <a href="<?=site_url('vm/partner_list')?>" class="nav-link">
          <i class="nav-icon fas fa-user-friends"></i>
          <p>
            Partner List
          </p>
        </a>

        <li class="nav-item has-treeview">
          <a href="<?=site_url('vm/work_order')?>" class="nav-link">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>
              Work Order
            </p>
          </a>
        </li>


        <li class="nav-item has-treeview">
          <a href="<?=site_url('vm/partner_req')?>" class="nav-link">
            <i class="nav-icon far fa-handshake"></i>
            <p>
              Partner Request
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="<?=site_url('vm/invoice')?>" class="nav-link">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Invoice
            </p>
          </a>
        </li>
      <?php } ?>

      <?php if ($this->session->userdata('level') == '21') { ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>
              Work Order<i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('serdev/work_order')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Work</p>
              </a>    
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-poll"></i>
            <p>
              Project Summary<i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('serdev/project_summary')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Project List</p>
              </a>    
            </li>
          </ul>
        </li>

      <?php } ?>
      
      <!-- Menu Level 46 / Presales -->
      <?php if ($this->session->userdata('level') == '46') { ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
              Data Master<i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('presales/dm_team')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Team</p>
              </a>    
            </li>

            <li class="nav-item has-treeview">
              <a href="<?=site_url('presales/dm_pricing')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>pricing</p>
              </a>    
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="<?=site_url('presales/presales_activity')?>" class="nav-link">
            <i class="nav-icon fas fa-calendar-day"></i>
            <p>
              Presales Activity
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="<?=site_url('presales/file_storage')?>" class="nav-link">
            <i class="nav-icon fas fa-folder-open"></i>
            <p>
              File Storage
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="<?=site_url('presales/precalculation')?>" class="nav-link">
            <i class="nav-icon fas fa-calculator"></i>
            <p>
              Precalculation
            </p>
          </a>
        </li>

      <?php } ?>

      <?php if ($this->session->userdata('level') == '50') { ////////// warehouse ?> 			  
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-id-card"></i>
            <p>
              Vendors <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            
            <li class="nav-item has-treeview">
              <a href="<?= site_url('SCM/form_vendor') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Create                                      
                </p>
              </a>  
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= site_url('SCM/list_vendor') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  List                                      
                </p>
              </a>  
            </li>
            
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-contract"></i>
            <p>
              Quotations <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            
            <li class="nav-item has-treeview">
              <a href="<?= site_url('SCM/form_quotation') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Create                                      
                </p>
              </a>  
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= site_url('SCM/list_quotation') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  List                                      
                </p>
              </a>  
            </li>
            
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              PO <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            
            <li class="nav-item has-treeview">
              <a href="<?= site_url('SCM/form_purchase') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Create                                      
                </p>
              </a>  
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= site_url('SCM/list_purchase') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  List                                      
                </p>
              </a>  
            </li>
            
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-hdd"></i>
            <p>
              Devices <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            
            <li class="nav-item has-treeview">
              <a href="<?= site_url('SCM/form_device') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Create                    
                </p>
              </a>  
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= site_url('SCM/form_device_multi') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Multiple Device                    
                </p>
              </a>  
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= site_url('SCM/list_device') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  List                                      
                </p>
              </a>  
            </li>
            
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-warehouse"></i>
            <p>
              Warehouse Reports <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            
            <li class="nav-item has-treeview">
              <a href="<?= site_url('SCM/rpt_quotation') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Quotation                                      
                </p>
              </a>  
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= site_url('SCM/rpt_purchase') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Purchase                                      
                </p>
              </a>  
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= site_url('SCM/rpt_device') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Devices                                      
                </p>
              </a>  
            </li>
            
          </ul>
        </li>
      <?php }  //////// end of warehouse menu?>		

      <!-- Menu Level 47,22 / Collection -->
      <?php if ($this->session->userdata('level') == '22' || $this->session->userdata('level') == '6' ) { ?>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
              Tagihan<i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview fn14" style="display: none;">
            <li class="nav-item has-treeview">
              <a href="<?=site_url('tagihan/tagihan_now')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tagihan Sekarang</p>
              </a>    
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('tagihan/tagihan_next')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Next Tagihan</p>
              </a>    
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('tagihan/tagihan_aktif')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tagihan Aktif</p>
              </a>    
            </li>
            <li class="nav-item has-treeview">
              <a href="<?=site_url('tagihan/tagihan_tidak_aktif')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tagihan Tidak Aktif</p>
              </a>    
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="<?=site_url('tagihan/laporan')?>" class="nav-link">
            <i class="nav-icon fas fa-calendar-day"></i>
            <p>
              Laporan
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="<?=site_url('tagihan/pengaturan')?>" class="nav-link">
            <i class="nav-icon fa fa-cog"></i>
            <p>
              Pengaturan
            </p>
          </a>
        </li>

      <?php } ?>	  

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>