<?php $this->load->view('incl/head');?>
<style>
	table thead tr td,table tfoot tr td{
		font-weight :bold; 
	}
	.hapus{
		background: #9b2424;
		color: #FFF;
		padding: 6px 10px;
		font-size: 14px;
		border-radius: 4px;
  }
  .card-black{
    background:#FFF;
    color:#666;
    border-top: solid 2px #dc3545;
  }
  .fn14{
    font-size: 14px;
  }
  .select2-container .select2-selection--single {
    height: calc(2.25rem + 2px);
  }

  .bg-success{
    background :#555; 
  }
 #addHref{
    border-color : #ED0714;
    color : #ED0714;
 }

 #addHref:hover{
    border-color : #ED0714;
    color : white;
    background-color: #ED0714;
 }

 .btn-primary{
   border-color: #ED0714;
   background-color:#ED0714;
 }

 .btn-primary:hover{
    border-color: #ED0714;
    background-color:white;
    color: #ED0714;
 }

.pagination > li > a
{
    background-color: white;
    color: #ED0714;
}

.pagination > li > a:focus,
.pagination > li > a:hover,
.pagination > li > span:focus,
.pagination > li > span:hover
{
    color: #ED0714;
    background-color: #eee;
    border-color: #ddd;
}

.pagination > .active > a
{
    color: white;
    background-color: #ED0714 !Important;
    border: solid 1px #ED0714 !Important;
}

.pagination > .active > a:hover
{
    background-color: #ED0714 !Important;
    border: solid 1px #ED0714;
}

 /* Absolute Center Spinner */
 .loading {
  z-index: 1051 !important;
  position: fixed;
  height: 2em;
  width: 2em;
  overflow: visible;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}



</style>
<body class="hold-transition sidebar-mini layout-fixed <?=$this->uri->segment('1') == "oprations" ? 'sidebar-collapse' : ''?>" style="background:#f7f7f7;">
<div class="wrapper">

  <?php 
    if ($this->session->userdata('level') == '1') { 
      $this->load->view('incl/nav_side');
    }else{
      
      $this->load->view('incl/nav_side_user');

      if($this->session->userdata('level') == '4'){
      }
    }
    
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <?php $this->load->view('incl/breadcumb'); ?>

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
		 <?php $this->load->view($linkView);?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?=date('Y');?> <a href="#">PT. Madina Mitra Teknik</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 0.1
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php $this->load->view('incl/script_bottom'); ?>
</body>
</html>
