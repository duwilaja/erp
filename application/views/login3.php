<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Matrik | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('template/')?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?=base_url('template/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('template/')?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('template/');?>plugins/toastr/toastr.min.css">
</head>

<style>
    
    @import url("https://fonts.googleapis.com/css?family=Montserrat:700");

    body{
        background-image: linear-gradient(-20deg, #e9defa 0%, #fbfcdb 100%); !important;
    }

    .hero__title {
        color: #fff;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        font-size: 50px;
        z-index: 1;
    }
    
    .cube {
        position: absolute;
        top: 80vh;
        left: 45vw;
        width: 10px;
        height: 10px;
        border: solid 1px #FFF;
        -webkit-transform-origin: top left;
        transform-origin: top left;
        -webkit-transform: scale(0) rotate(0deg) translate(-50%, -50%);
        transform: scale(0) rotate(0deg) translate(-50%, -50%);
        -webkit-animation: cube 12s ease-in forwards infinite;
        animation: cube 12s ease-in forwards infinite;
    }
    .cube:nth-child(2n) {
        border-color: #fff;
    }
    .cube:nth-child(2) {
        -webkit-animation-delay: 2s;
        animation-delay: 2s;
        left: 25vw;
        top: 40vh;
    }
    .cube:nth-child(3) {
        -webkit-animation-delay: 4s;
        animation-delay: 4s;
        left: 75vw;
        top: 50vh;
    }
    .cube:nth-child(4) {
        -webkit-animation-delay: 6s;
        animation-delay: 6s;
        left: 90vw;
        top: 10vh;
    }
    .cube:nth-child(5) {
        -webkit-animation-delay: 8s;
        animation-delay: 8s;
        left: 10vw;
        top: 85vh;
    }
    .cube:nth-child(6) {
        -webkit-animation-delay: 10s;
        animation-delay: 10s;
        left: 50vw;
        top: 10vh;
    }
    
    @-webkit-keyframes cube {
        from {
            -webkit-transform: scale(0) rotate(0deg) translate(-50%, -50%);
            transform: scale(0) rotate(0deg) translate(-50%, -50%);
            opacity: 1;
        }
        to {
            -webkit-transform: scale(20) rotate(960deg) translate(-50%, -50%);
            transform: scale(20) rotate(960deg) translate(-50%, -50%);
            opacity: 0;
        }
    }
    
    @keyframes cube {
        from {
            -webkit-transform: scale(0) rotate(0deg) translate(-50%, -50%);
            transform: scale(0) rotate(0deg) translate(-50%, -50%);
            opacity: 1;
        }
        to {
            -webkit-transform: scale(20) rotate(960deg) translate(-50%, -50%);
            transform: scale(20) rotate(960deg) translate(-50%, -50%);
            opacity: 0;
        }
    }
    
    
</style>

<body class="hold-transition login-page" style="background:rgb(247, 247, 247);">
    
    <div class="hero"> 
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
    </div>
    
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body" style="border-radius: 10px;">
                <div class="login-logo">
                    <a href="#">
                        <img src="<?=base_url('template/logo/logo.png')?>" alt="logo">
                    </a>
                </div>
                
                <p class="login-box-msg">Application System</p>
                
                <form action="<?=site_url('auth/proses_login')?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-danger btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    
    <!-- jQuery -->
    <script src="<?=base_url('template/')?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url('template/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('template/');?>plugins/toastr/toastr.min.js"></script>

    <?php if($this->session->flashdata('gagal')){?>
    <script>
    toastr.error("<?=$this->session->flashdata('gagal')?>");
    </script>
    <?php } ?>
    
    <script src="<?=base_url('template/')?>dist/js/adminlte.min.js"></script>
    
</body>
</html>
