<style>
    .imgs{
        max-width:100%;
        max-height:100%;
    }
    .ket{
        border-bottom: dashed 1px #DDD;
        padding-bottom: 17px;
    }
    .img_struk li{
        list-style-type: decimal;
    }
    
</style>
<section class="content">
    <div class="card">
        <div class="card-header">
            Form Pengajuan Reimburse
        </div>
        <form action="javascript:void(0);" id="form_pengajuan_reimburse" method="post">
        <div class="card-body" style="font-size: 14px;">
            <div class="ket mb-4">
                <div class="row">
                    <div class="col-md-8">
                        <table class="w-100">
                            <tr>
                                <td>Projek/Other</td>
                                <td>
                                    <select name="p_o" onchange="pilih_p_o(this.value)" class="form-control form-control-sm">
                                        <option value="">-- Pilih Projek/Other --</option>
                                        <option value="1">Projek</option>
                                        <option value="2">Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Pilih/Isi</td>
                                <td><div id="p_o" ></div></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="data_reimburse">
                <div class="label-reimburse mb-4" style="font-size: 18px;"><b> Input Reimburse</b></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Klaim</th>
                            <th>Keterangan</th>
                            <th>Struk</th>
                            <th>Total</th>
                            <th><button class="btn btn-default btn-sm" onclick="add_form_r()"><i class="fa fa-plus"></i></button></th>
                        </tr>
                    </thead>
                    <tbody id="from_r">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div style="float:left;">
                <a href="<?=site_url('Finance/reimburse');?>" class="btn btn-default">Kembali</a>
            </div>
            <div style="float:right;">
                <button type="submit" class="btn btn-success" id="btn-save">Submit</button>
                <button class="btn btn-primary" id="btn-save-loading" style="display:none;" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
        </div>
        </form>
    </div>
</section>