$(document).ready(function() {
    get();
});
function get()
{
    let id = $('#id_req').val();
    let no = 1;
    $.ajax({
        type: "GET",
        url: "getReqBrng?id_req="+id,
        dataType: "json",
        success: function (r) {
            r.forEach(v => {
                console.log(v.status);
                    $('#d_inventory').append(`
                    <div class="col-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2 text-red border-right">
                                        <h1>${no++}</h1>
                                    </div>
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-4">
                                                <p>Nama Barang</p>
                                            </div>
                                            <div class="col-1">
                                                <p>:</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="text-bold">${v.nama_barang}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <p>Status</p>
                                            </div>
                                            <div class="col-1">
                                                <p>:</p>
                                            </div>
                                            <div class="col-7">
                                            ${ (v.status == 1) ? "<span class='badge badge-success'>Approve</span>" : (v.status == 0 ? "<span class='badge badge-danger'>Reject</span>" : "<span class='badge badge-warning text-white'>Pending</span>")}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <p>Catatan</p>
                                            </div>
                                            <div class="col-1">
                                                <p>:</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="text-bold">${v.catatan}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });
        }
    });
}