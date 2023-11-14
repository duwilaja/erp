<section class="content">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    
    <script>
        tinymce.init({
            selector: '.mytext'
        });
        
    </script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tambah Lowongan
                </div>
                <div class="card-body">
                    <form action="<?=site_url('hcm/inLowongan')?>" method="post">
                        <div class="form-row">
                            <div class="col-12">
                                <Label>Pekerjaan</Label>
                                <input type="text" class="form-control" name="pekerjaan"> 
                            </div>
                            <div class="col-6">
                                <label for="">Tanggal Mulai</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="far fa-calendar-minus"></i></div>
                                    </div>
                                    <input name="tgl_mulai" type="date" class="form-control" id="inlineFormInputGroup" placeholder="Mulai">
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="">Tanggal  Berkahir</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="far fa-calendar-minus"></i></div>
                                    </div>
                                    <input name="tgl_akhir" type="date" class="form-control" id="inlineFormInputGroup" placeholder="Akhir">
                                </div>
                            </div>
                            <div class="col">
                                <Label>Pengalaman</Label>
                                <input type="text" class="form-control" placeholder="1 tahun" name="pengalaman">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="">Deskripsi Pekerjaaan</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control mytext" rows="15"></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="">Kualifikasi</label>
                            <textarea name="kualifikasi"  class="form-control mytext" rows="15"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger"> Submit </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    let tim = document.querySelector("#tim");
    let tipe = document.querySelector("#tipe");
    
    
    $(document).ready(function(){
        
        tipe.addEventListener("click", function(){
            if(tipe.value === "tim"){
                $("#tim").fadeIn();
            }else{
                $("#tim").fadeOut();
            }
        });
    });
    
    
</script>