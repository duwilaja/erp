<script>
function exportToExcel(tableID, filename = ''){
    var downloadurl;
    var dataFileType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'export_excel_data.xls';
    
    // Create download link element
    downloadurl = document.createElement("a");
    
    document.body.appendChild(downloadurl);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTMLData], {
            type: dataFileType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
    
        // Setting the file name
        downloadurl.download = filename;
        
        //triggering the function
        downloadurl.click();
    }
}
 
</script>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9 col">
                            Report Tahunan
                        </div>
                        <div class="col-md-3 col">
                            <div class="row">
                                <div class="col-7 col-md-9">
                                <select name="bulan" id="" class="custom-select" onchange="pilih(this.value)">
                                        <?php 
                                            for ($i=20; $i < 30 ; $i++) { 
                                                $tahun = '20'.$i;
                                         ?>
                                            <option value="<?=$tahun;?>" <?= $tahun == date('y') ? 'selected' : date('y');?>><?=$tahun;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <button onclick="exportToExcel('tabelTahun', 'user-data')" class="btn btn-outline-danger"><i class="fas fa-print"></i></button>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tabelTahun" class="table tblexportData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Karyawan</th>
                                <th>Masuk</th>
                                <th>Cuti</th>
                                <th>Izin</th>
                                <th>Sakit</th>
                                <th>Telat</th>
                                <th></th>
                            </tr>
                        </thead>    
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>N32423</td>
                                <td>Sahrul Rizal</td>
                                <td>342</td>
                                <td>8</td>
                                <td>10</td>
                                <td>20</td>
                                <td>
                                    <a href="<?=site_url('absensi/detail_rekap_tahunan')?>" class="btn btn-outline-danger">Detail</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>