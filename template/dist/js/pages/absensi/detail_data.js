let map;
let infoWindow;
let mapOptions;
let bounds;
async function GMPStart() {
    // infoWindow ini digunakan untuk menampilkan pop-up diatas marker terkait lokasi markernya
    infoWindow = new google.maps.InfoWindow;
    //  Variabel berisi properti tipe peta yang bisa diubah-ubah
    mapOptions = {
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    // Deklarasi untuk melakukan load map Google Maps API
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    // Variabel untuk menyimpan batas kordinat
    bounds = new google.maps.LatLngBounds();
    // Pengambilan data dari database MySQL

    addMarker(la, lo, "My Start Position", my_marker);
    addMarker(ola, olo, "Start Office Position");
    if (tgl_masuk != tgl_keluar) {
        addMarker(parseFloat(ela), parseFloat(elo), "My End Position", my_marker);
        addMarker(parseFloat(eola), parseFloat(eolo), "End Office Position");
    }



    // Proses membuat marker 
    var location;
    var marker;
    function addMarker(lat, lng, info, icon) {
        location = new google.maps.LatLng(lat, lng);
        bounds.extend(location);
        let opt = {
            map: map,
            position: location,
        }
        if (icon) {
            opt.icon = {
                url: icon,
                scaledSize: new google.maps.Size(40, 40), // scaled size
                // origin: new google.maps.Point(0, 0), // origin
                // anchor: new google.maps.Point(0, 0) // anchor
            };
        }
        marker = new google.maps.Marker(opt);
        map.fitBounds(bounds);
        bindInfoWindow(marker, map, infoWindow, info);
    }
    // Proses ini dapat menampilkan informasi lokasi Kota/Kab ketika diklik dari masing-masing markernya
    function bindInfoWindow(marker, map, infoWindow, html) {
        google.maps.event.addListener(marker, 'click', function () {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
        });
    }
}
$(document).ready(function () {

});