 
$(document).ready(function () {
    dt_trouble();
  });

  function GetURLParameter(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) 
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return sParameterName[1];
            }
        }
    }

    let pk = GetURLParameter('pk');

  function dt_trouble(pk_id=pk) {
    $('#tabel').DataTable({
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
            "url": url+'pm/dt_trouble/'+pk_id,
            "type": "GET",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,2],
            "orderable": false
        }]
    });
  }