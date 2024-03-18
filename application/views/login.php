<!--
    
    =========================================================
    * Argon Dashboard - v1.1.1
    =========================================================
    
    * Product Page: https://www.creative-tim.com/product/argon-dashboard
    * Copyright 2019 Creative Tim (https://www.creative-tim.com)
    * Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)
    
    * Coded by Creative Tim
    
    =========================================================
    
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
           LOGIN ERM
        </title>
        <link href="<?=base_url('template/')?>plugins/login/undraw_resume_folder_2_arse.svg" rel="icon" type="image/png">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="<?=base_url('template/')?>plugins/login/nucleo.css" rel="stylesheet" />
        <link href="<?=base_url('template/')?>plugins/login/fontawesome-free/css/all.min.css" rel="stylesheet" />
        <!-- CSS Files -->
        <link href="<?=base_url('template/')?>plugins/login/argon-dashboard.css?v=1.1.1" rel="stylesheet" />
        <link rel="stylesheet" href="<?= base_url('template/');?>plugins/toastr/toastr.min.css">
    </head>
    
    <style>
        body{
            /* background-image: url("<?=base_url('template/')?>plugins/login/Endless-Constellation.svg"); */
        }
        .cube {
            position: absolute;
            top: 80vh;
            left: 45vw;
            width: 10px;
            height: 10px;
            opacity: 0.6;
            border: solid 1px #CCCCCC;
            -webkit-transform-origin: top left;
            transform-origin: top left;
            -webkit-transform: scale(0) rotate(0deg) translate(-50%, -50%);
            transform: scale(0) rotate(0deg) translate(-50%, -50%);
            -webkit-animation: cube 12s ease-in forwards infinite;
            animation: cube 12s ease-in forwards infinite;
        }
        .cube:nth-child(2n) {
            border-color: #CCCCCC;
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
                opacity: 0.6;
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
                opacity: 0.6;
            }
            to {
                -webkit-transform: scale(20) rotate(960deg) translate(-50%, -50%);
                transform: scale(20) rotate(960deg) translate(-50%, -50%);
                opacity: 0;
            }
        }
    </style>
    
    <body style="background-color: #FAFAFA;">
        
        
        <div class="main-content">
            <!-- Navbar -->
            
            <!-- Header -->
            <div class="header py-7 py-lg-8">
                
                <!-- <div class="separator separator-bottom separator-skew zindex-100">
                    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <polygon class="fill-darkr" points="2560 0 2560 100 0 100"></polygon>
                    </svg>
                </div> -->
                <div class="hero"> 
                    <div class="cube"></div>
                    <div class="cube"></div>
                    <div class="cube"></div>
                    <div class="cube"></div>
                    <div class="cube"></div>
                    <div class="cube"></div>
                </div>
            </div>
            <!-- Page content -->
            <div class="container mt--8 pb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-10" style="margin-top: -38px;">
                        <div class="card bg-secondary shadow border-0" >
                            <div class="card-body px-lg-5 py-lg-5" style="background-color: #fff;">
                                <div class="row" style="padding-top: 50px;">
                                    <div class="col-md-6 text-center">
                                        <img style="margin-top: 20px;" src="<?=base_url('template/')?>logo/welcome-estrada.png" width="100%" alt="">
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-12 offset-md-1">
                                        <div class="text-center text-muted mb-4">
                                            <img src="<?=base_url('template/')?>logo/logo-estrada.png" width="80px" alt="">
                                            <h4 style="color: white;">Application System</h4>
                                            <br>
                                        </div>
                                        <form action="<?=site_url('auth/proses_login')?>" method="POST">
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <input class="form-control" name="username" placeholder="Username/Email" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                                                    </div>
                                                    <input class="form-control" name="password" placeholder="Password" type="password">
                                                </div>
                                            </div>
                                            <div class="custom-control custom-control-alternative custom-checkbox">
                                                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                                <label class="custom-control-label" for=" customCheckLogin">
                                                    <span class="text-muted">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn my-4" style="width: 100%; background-color: #750012; color:#FFF;">Sign in</button>
                                            </div>
                                            
                                            <div class="sdas" style="text-align:center;">
                                                <span style="font-size:12px;background: white;padding: 0 10px;border: solid 1px #DDD;color: #999;border-radius: 10px;">Version 0.1</span>
                                            </div>

                                        </form>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!--   Core   -->
        <script src="<?=base_url('template/')?>plugins/jquery/jquery.min.js"></script>
        <script src="<?=base_url('template/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!--   Optional JS   -->
        <!--   Argon JS   -->
        <script src="<?=base_url('template/')?>plugins/login/argon-dashboard.min.js?v=1.1.1"></script>
        <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
        <script src="<?= base_url('template/');?>plugins/toastr/toastr.min.js"></script>
        <script>
            window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "argon-dashboard-free"
            });
        </script>
        
        <?php if($this->session->flashdata('gagal')){?>
            <script>
                toastr.error("<?=$this->session->flashdata('gagal')?>");
            </script>
            <?php } ?>
        </body>
        
        </html>