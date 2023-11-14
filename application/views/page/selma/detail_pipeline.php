<style>
    /* Variables */
    /* Fonts */
    
    
    /* Layout */
    * {
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .xas{
        width:400px;
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
    
</style>


<section class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Detail Pipeline
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 offset-md-1" style="padding-top: 50px;">
                       <div class="xas">
                        <div class="container-fluid" style="border: solid 1px #eeeeee; padding-top: 20px; padding-left: 20px;">
                            <div class="row">
                                <div class="col-md-5 col"><strong>ID</strong></div>
                                <div class="col-md-7 col">
                                    <p><?=$d->id;?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col"><strong>Customer</strong></div>
                                <div class="col-md-7 col">
                                    <p><?=$d->customer;?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col"><strong>End Customer</strong> </div>
                                <div class="col-md-7 col">
                                    <p><?=$d->custend;?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col"><strong>Sales</strong></div>
                                <div class="col-md-7 col">
                                    <p><?=$d->nama;?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col"><strong>Category</strong></div>
                                <div class="col-md-7 col">
                                    <p><?=$category;?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col"><strong>Solution</strong></div>
                                <div class="col-md-7 col">
                                    <p><?=$d->solution;?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col"><strong>Product</strong> </div>
                                <div class="col-md-7 col">
                                    <p><?=$d->product;?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col"><strong>Contact PIC</strong></div>
                                <div class="col-md-7 col">
                                    <p>
                                        <?=$d->pic;?> <br>
                                        <!-- Account Manager <br> -->
                                        <?=$d->telp;?> <br>
                                        <?=$d->email;?> <br>
                                        <!-- Telkom LandMark Tower --> 
                                    </p>
                                </div>
                            </div>
                        </div>
                       </div>
                    </div>
                    <div class="col-md-6" style="padding-top: 50px;">
                        <ul class="timeline">
                            <?php 
                                foreach ($act as $k => $v) { 
                                    if ($v['v'] != 0) {
                            ?>
                            <li class="timeline-event">
                                <label class="timeline-event-icon"></label>
                                <div class="timeline-event-copy">
                                    <p class="timeline-event-thumbnail"><?php 
                                        if (@$v['data']->start_date != '') {
                                            echo $this->bantuan->tgl_indo(@$v['data']->start_date);
                                        }else if (@$v['data']->present_date != '') {
                                            echo $this->bantuan->tgl_indo(@$v['data']->present_date);
                                        }else if(@$v['data']->created_date  != ''){
                                            echo @$this->bantuan->tgl_indo($v['data']->created_date);
                                        }else if(@$v['data']->ctdDate  != ''){
                                            echo @$this->bantuan->tgl_indo($v['data']->ctdDate);
                                        }else if(@$v['data']->date  != ''){
                                            echo @$this->bantuan->tgl_indo($v['data']->date);
                                        }
                                       ?>
                                    </p>
                                    <h4><strong><?=$v['nama']?></strong></h4>
                                    <?php
                                        if(@$v['data']->mom != '' && $v['no'] == 2) echo '<a href="'.site_url('data/sls/mom/').@$v['data']->mom.'" class="btn btn-sm btn-outline-danger">View MOM</a>'; 
                                        if(@$v['data']->cust_need != '' && $v['no'] == 2) echo '<a href="'.site_url('data/sls/cust_need/').@$v['data']->cust_need.'" class="btn btn-sm btn-outline-danger ml-2">View Cust Need</a>'; 
                                       
                                        if(@$v['data']->mom != '' && $v['no'] == 3) echo '<a href="'.site_url('data/sls/mom/').@$v['data']->mom.'" class="btn btn-sm btn-outline-danger">View MOM</a>'; 
                                        if(@$v['data']->cust_need != '' && $v['no'] == 3) echo '<a href="'.site_url('data/sls/cust_need/').@$v['data']->cust_need.'" class="btn btn-sm btn-outline-danger ml-2">View Cust Need</a>'; 
                                      
                                        if(@$v['data']->mom != '' && $v['no'] == 4) echo '<a href="'.site_url('data/sls/mom/').@$v['data']->mom.'" class="btn btn-sm btn-outline-danger">View MOM</a>'; 
                                        
                                        if($v['no'] == 5){
                                            echo "<div class='mb-2'><b>".@$v['data']->judul_p.'</b></div>';
                                            echo "<div class='mb-2'>No SPH : ".@$v['data']->no.'</div>';
                                            if(@$v['data']->fcapex != '') echo '<a href="'.site_url('data/sls/sph_capex/').@$v['data']->fcapex.'" class="btn btn-sm btn-outline-danger">View CAPEX</a>'; 
                                            if(@$v['data']->fopex != '') echo '<a href="'.site_url('data/sls/sph_opex/').@$v['data']->fopex.'" class="btn btn-sm btn-outline-danger ml-2">View OPEX</a>'; 
                                            if(@$v['data']->sph != '') echo '<a href="'.site_url('data/sls/sph/').@$v['data']->sph.'" class="btn btn-sm btn-outline-danger ml-2">View SPH</a>'; 
                                        }
                                        
                                        if($v['no'] == 6){
                                           echo "<b>".@$v['data']->service_title."</b>"; 
                                           echo "<div class='mb-2'>Nominal : ".@$v['data']->nominal."</div>";
                                           if(@$v['data']->bakn != '' && $v['no'] == 6) echo '<a href="'.site_url('data/sls/bakn/').@$v['data']->bakn.'" class="btn btn-sm btn-outline-danger">View BAKN</a>'; 
                                        }   

                                        if ($v['no'] == 7) {  
                                            echo "<div><b>".@$v['data']->service_title."</b></div>";  
                                            echo "<div>No PO : ".@$v['data']->no."</div>";  
                                            echo "<div>Jumlah : ".@$v['data']->jml."</div>";  
                                            echo "<div>Nominal : ".@$v['data']->nominal."</div>";  
                                            echo "<div class='mb-3'><span class='badge badge-warning'>".@$this->bantuan->tgl_indo($v['data']->start_date).' - '.@$this->bantuan->tgl_indo($v['data']->end_date)."</span></div>";  
                                            if(@$v['data']->po != '') echo '<a href="'.site_url('data/sls/po/').@$v['data']->po.'" class="btn btn-sm btn-outline-danger">View PO</a>'; 
                                        }

                                        if($v['no'] == 10){
                                            if(@$v['data']->kontrak != '' && $v['no'] == 10) echo '<a href="'.site_url('data/sls/kontrak/').@$v['data']->kontrak.'" class="btn btn-sm btn-outline-danger">View Kontrak</a>'; 
                                        }
                                        
                                        if($v['note'] != '') echo "<div class='mt-2'><b>NOTE</b> : <p style='background: #fffff2;border: solid 1px #FFEB3B;padding: 10px;color: #777518;'>".$v['note']."</p></div>";
                                   ?>
                                </div>
                            </li>
                            <?php } } ?>
                        </ul>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>