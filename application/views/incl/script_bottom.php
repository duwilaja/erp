<!-- jQuery -->
<script src="<?= base_url('template/');?>plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url('template/');?>plugins/socket_io.js"></script>
<script src="<?=site_url('template/plugins/time/jquery.timepicker.min.js');?>"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('template/');?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
<script src="<?= base_url('template/');?>dist/js/infinite-scroll.pkgd.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button);
  var url="<?= base_url();?>";
</script>
<!-- Bootstrap 4 -->

<script src="<?= base_url('template/');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('template/');?>plugins/chart.js/Chart.min.js"></script>
<!-- JQVMap -->
<script src="<?= base_url('template/');?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('template/');?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<!-- <script src="<?= base_url('template/');?>plugins/jquery-knob/jquery.knob.min.js"></script> -->
<!-- daterangepicker -->
<script src="<?= base_url('template/');?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('template/');?>plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url('template/');?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('template/');?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('template/');?>plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?= base_url('template/');?>plugins/easynotify/easyNotify.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('template/');?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('template/');?>dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<?php if(@$fileScript){ ?>
  <script src="<?= base_url('template/');?>dist/js/pages/<?=$fileScript;?>"></script>
  <script src="<?= base_url('template/plugins/sticky/sticky.js');?>"></script>
<?php } ?>

<?php if(@$jsUtama){ ?>
  <script src="<?= base_url('template/');?>dist/js/pages/<?=$jsUtama;?>"></script>
<?php } ?>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('template/');?>plugins/jquery.serializeToJSON.js"></script>
<script src="<?= base_url('template/');?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('template/');?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url('template/');?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('template/');?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('template/');?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script>/*
const socket = io.connect('https://erp.matrik.co.id:3003/');
console.log(Notification.permission);
   if (Notification.permission === "granted") {
      console.log('notif masuk');
   } else if (Notification.permission !== "denied") {
      Notification.requestPermission().then(permission => {
         console.log(permission);
      });
   }

socket.emit('register',<?=$this->session->userdata('karyawan_id');?>);
socket.on('chat message', function(msg){
  toastr.info(msg);
  var options = {
      title: "Notifikasi Ticketing",
      options: {
        body: msg,
        lang: 'id',
      }
    };

  $("#easyNotify").easyNotify(options);

});

socket.on('notif', function(data){
  toastr.info(data.msg);
var options = {
    title: "Notifikasi Ticketing",
    options: {
      body: data.msg,
      lang: 'id',
    }
  };

$("#easyNotifys").easyNotify(options);

});*/
</script>

<?php if ($this->session->flashdata('success')) { ?> 
<script>
  Swal.fire({
    icon: 'success',
    title: 'Success',
    text: '<?=$this->session->flashdata('success');?>',
  })
</script>
<?php }else if($this->session->userdata('error')){ ?>
  <script>
  Swal.fire({
    icon: 'error',
    title: 'Failed',
    text: '<?=$this->session->flashdata('error');?>',
  })
  </script>
<?php } ?>
