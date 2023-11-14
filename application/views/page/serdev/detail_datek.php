<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<style>
    /* Variables */
    /* Fonts */
    
    
    /* Layout */
    * {
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }
    
    /* Styling */
    .timeline {
        position: relative;
        max-width: 46em;
    }
    .timeline:before {
        background-color: #eeeeee;
        content: '';
        margin-left: -1px;
        position: absolute;
        top: 0;
        left: 2em;
        width: 2px;
        height: 100%;
    }
    
    .timeline-event {
        position: relative;
    }
    .timeline-event:hover .timeline-event-icon {
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        background-color: tomato;
    }
    .timeline-event:hover .timeline-event-thumbnail {
        -moz-box-shadow: inset 40em 0 0 0 tomato;
        -webkit-box-shadow: inset 40em 0 0 0 tomato;
        box-shadow: inset 40em 0 0 0 tomato;
    }
    
    .timeline-event-copy {
        padding: 2em;
        position: relative;
        top: -1.875em;
        left: 4em;
        width: 80%;
    }
    .timeline-event-copy h3 {
        font-size: 1.75em;
    }
    .timeline-event-copy h4 {
        font-size: 1.2em;
        margin-bottom: 1.2em;
    }
    .timeline-event-copy strong {
        font-weight: 700;
    }
    .timeline-event-copy p:not(.timeline-event-thumbnail) {
        padding-bottom: 1.2em;
    }
    
    .timeline-event-icon {
        -moz-transition: -moz-transform 0.2s ease-in;
        -o-transition: -o-transform 0.2s ease-in;
        -webkit-transition: -webkit-transform 0.2s ease-in;
        transition: transform 0.2s ease-in;
        border-radius: 50%;
        background-color: #cccccc;
        outline: 10px solid white;
        display: block;
        margin: 0.5em 0.5em 0.5em -0.5em;
        position: absolute;
        top: 0;
        left: 2em;  
        width: 1em;
        height: 1em;
    }
    
    .timeline-event-thumbnail {
        -moz-transition: box-shadow 0.5s ease-in 0.1s;
        -o-transition: box-shadow 0.5s ease-in 0.1s;
        -webkit-transition: box-shadow 0.5s ease-in;
        transition: box-shadow 0.5s ease-in 0.1s;
        color: white;
        font-size: 0.75em;
        background-color: black;
        -moz-box-shadow: inset 0 0 0 0em #ef795a;
        -webkit-box-shadow: inset 0 0 0 0em #ef795a;
        box-shadow: inset 0 0 0 0em #ef795a;
        display: inline-block;
        margin-bottom: 1.2em;
        padding: 0.25em 1em 0.2em 1em;
    }
    
    ul{
        list-style: none;
    }
    
    .tm{
        transition: all 2s linear;
        display: block;
    }
    
    .hidden {
        transition: all 2s linear;
        display: none;
    }
    
</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Detail Datek
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h5>Pengadaan Sewa Jaringan Komunikasi di Korlantas Polri</h5>
                            <br>
                            <hr>
                            <br>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5 offset-md-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 style="color: tomato;">Basic Info</h5>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">ID Datek</label></div>
                                <div class="col-md-7">
                                    <p>DTK001</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Segment</label></div>
                                <div class="col-md-7">
                                    <p>Backhaul</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Name Unit</label></div>
                                <div class="col-md-7">
                                    <p>Backhaul RTMC Polda</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Province</label></div>
                                <div class="col-md-7">
                                    <p>Bali</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Alamat</label></div>
                                <div class="col-md-7">
                                    <p>JL. WR Supratman No.06, Dangin Puri Kangin. Kec. Denpasar Utara</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Titik Kordinat</label></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Longititude</label></div>
                                <div class="col-md-7">
                                    <p>98623409283094832</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Latitude</label></div>
                                <div class="col-md-7">
                                    <p>87343209810140938490</p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 style="color: tomato;">Partner Info</h5>
                                </div>
                            </div>
                            
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Partner</label></div>
                                <div class="col-md-7">
                                    <p>Yusril</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Kontak Partner</label></div>
                                <div class="col-md-7">
                                    <p>0982340983</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Alamat Partner</label></div>
                                <div class="col-md-7">
                                    <p>JL. WR Supratman No.06, Dangin Puri Kangin. Kec. Denpasar Utara</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 style="color: tomato;">Service Info</h5>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Layanan</label></div>
                                <div class="col-md-7">
                                    <p>Astinet</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5"><label for="">Bandwidth</label></div>
                                <div class="col-md-7">
                                    <p>15 Mbps</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">IP WAN Internet</label></div>
                                <div class="col-md-7">
                                    <p>1.1.1.1</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">IP WAN VPN</label></div>
                                <div class="col-md-7">
                                    <p>1.1.1.1</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">IP LAN</label></div>
                                <div class="col-md-7">
                                    <p>1.1.1.1</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="offset-md-1 col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 style="color: tomato;">Device Info</h5>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="" class="btn btn-danger btn-sm">Export to Excel</a>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>1</th>
                                                <th>Nama Device</th>
                                                <th>SN</th>
                                                <th>MAC</th>
                                                <th>Qty</th>
                                                <th>Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>device per-project dr scm</td>
                                                <td>SN=sesuai device yang dipilih</td>
                                                <td>MAC auto sesuai sn</td>
                                                <td>1</td>
                                                <td>Unit</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3 offset-md-1">
                            <h5 style="color: tomato;">Delivery Activity <button id="tom" class="btn btn-light btn-sm"><i id="arrow" class="fas fa-sort-down"></i></button></h5>
                            
                        </div>
                        <div id="tm" class="col-md-10 offset-md-1 hidden" style="padding-top: 50px;">
                            <ul class="timeline">
                                <li class="timeline-event">
                                    <label class="timeline-event-icon"></label>
                                    <div class="timeline-event-copy">
                                        <p class="timeline-event-thumbnail">25 Januari 2020</p>
                                        <h4><strong>Online</strong></h4>
                                        
                                    </div>
                                </li>
                                <li class="timeline-event">
                                    <label class="timeline-event-icon"></label>
                                    <div class="timeline-event-copy">
                                        <p class="timeline-event-thumbnail">25 Januari 2020</p>
                                        <h4><strong>Installation</strong></h4>
                                        <a href="" class="btn btn-sm btn-outline-danger">View MIOM</a>
                                    </div>
                                </li>
                                <li class="timeline-event">
                                    <label class="timeline-event-icon"></label>
                                    <div class="timeline-event-copy">
                                        <p class="timeline-event-thumbnail">30 Januari 2020</p>
                                        <h4><strong>Survey</strong></h4>
                                        <a href="" class="btn btn-sm btn-outline-danger">View Sizing dari Presales</a>
                                    </div>
                                </li>
                                
                                <li class="timeline-event">
                                    <label class="timeline-event-icon"></label>
                                    <div class="timeline-event-copy">
                                        <p class="timeline-event-thumbnail">5 Februari 2020</p>
                                        <h4><strong>Shipping</strong></h4>
                                        <p>
                                            025/BAKN/MMT/II/2020 <br>
                                            Berita Acara Klasifikasi Negosiasi
                                            
                                        </p>
                                        <a href="" class="btn btn-sm btn-outline-danger">View SPH</a>
                                    </div>
                                </li>
                                <li class="timeline-event">
                                    <label class="timeline-event-icon"></label>
                                    <div class="timeline-event-copy">
                                        <p class="timeline-event-thumbnail">5 Februari 2020</p>
                                        <h4><strong>Stagging</strong></h4>
                                        <p>
                                            025/BAKN/MMT/II/2020 <br>
                                            Berita Acara Klasifikasi Negosiasi
                                            
                                        </p>
                                        <a href="" class="btn btn-sm btn-outline-danger">View SPH</a>
                                    </div>
                                </li>
                                
                            </ul>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var e = document.getElementById('tm');
    var ar = document.getElementById('arrow');
    var tom = document.getElementById('tom').addEventListener('click', function(){
        e.classList.toggle('hidden');
        ar.classList.toggle('fa-sort-down');
        ar.classList.toggle('fa-sort-up');
    });
    
    
</script>