<?php 
  if ($this->session->userdata('id') == '') {
    redirect('/','refresh');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('template/');?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('template/');?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('template/');?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('template/');?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('template/');?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('template/');?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('template/');?>plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url('template/');?>plugins/toastr/toastr.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('template/');?>plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url('template/');?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  
  <link rel="stylesheet" href="<?= base_url('template/');?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <link rel="stylesheet" type="text/css" href="<?=site_url('template/plugins/time/jquery.timepicker.min.css');?>">
  <script src="<?=base_url('template/dist/js/pages/all.js')?>"></script>
</head>
<style>

.status{
    padding: 4px 14px;
    border-radius: 10px;
    font-size: 12px;
    text-transform: uppercase;
    font-weight: bold;
}
.status.pending{
    background: #FFEB3B;
}
.status.on_progress{
  background: #03A9F4;
  color:#FFF;
}
.status.paid{
  background: #4CAF50;
  color:#FFF;
}
.status.td{
  background: #9E9E9E;
  color:#FFF;
}

.status.tolak{
  background: #E91E63;
    color: #FFF;
}
.status.batal{
  background: #FF5722;
    color: #FFF;
}

  .tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -60px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}

.ani-getar {
  animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
  transform: translate3d(0, 0, 0);
  backface-visibility: hidden;
  perspective: 1000px;
}

.select2.select2-container{
    width:100% !important;
}

@keyframes shake {
  10%, 90% {
    transform: translate3d(-1px, 0, 0);
  }
  
  20%, 80% {
    transform: translate3d(2px, 0, 0);
  }

  30%, 50%, 70% {
    transform: translate3d(-4px, 0, 0);
  }

  40%, 60% {
    transform: translate3d(4px, 0, 0);
  }
}
</style>
