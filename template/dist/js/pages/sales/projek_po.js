$(document).ready(function() {
    showtableProjekPo()
});

function showtableProjekPo() {
    $('#tbl_projekPo').DataTable({
        // Processing indicator
        "bAutoWidth": false,
        "destroy": true,
        "searching": true,
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        "scrollX": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": url+'SelMa/dtProjekPo',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,5],
            "orderable": false
        }]
    });
}