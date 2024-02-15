<script type="text/javascript">
    var la = <?php echo ($data["latitude"]); ?>;
    var lo = <?php echo ($data["longitude"]); ?>;
    var ola = <?php echo ($data["office_latitude"]); ?>;
    var olo = <?php echo ($data["office_longitude"]); ?>;
    var my_marker = '<?php echo base_url("template/") . "dist/img/location.png"; ?>';

    var tgl_masuk = '<?php echo ($data["tgl_masuk"]); ?>';
    var tgl_keluar = '<?php echo ($data["tgl_keluar"]); ?>';
    var ela = "";
    var elo = "";
    var eola = "";
    var eolo = ""
    if (tgl_masuk != tgl_keluar) {
        ela = '<?php echo ($data["end_latitude"]); ?>';
        elo = '<?php echo ($data["end_longitude"]); ?>';
        eola = '<?php echo ($data["end_office_latitude"]); ?>';
        eolo = '<?php echo ($data["end_office_longitude"]); ?>';
    }
</script>
<div class="card">
    <div class="card-header card-black">
        <h3 class="card-title">
            <?= $title; ?>
        </h3>
    </div>
    <!-- <?php print_r($data) ?> -->
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <label>NIP</label>
                    </div>
                    <div class="col-sm-6">
                        <label>
                            <?= $data["nip"] ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Geofence Status</label>
                    </div>
                    <div class="col-sm-6">
                        <label>
                            <?= $data["geofence_status"] == 1 ? "ON" : "OFF" ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Start Office Time</span>
                    </div>
                    <div class="col-sm-6">
                        <span>
                            <?= $data["office_masuk"] ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <span>End Office Time</span>
                    </div>
                    <div class="col-sm-6">
                        <span>
                            <?= $data["office_keluar"] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Start Time</span>
                    </div>
                    <div class="col-sm-6">
                        <span>
                            <?= $data["tgl_masuk"] ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <span>End Time</span>
                    </div>
                    <div class="col-sm-6">
                        <span>
                            <?= $data["tgl_masuk"] == $data["tgl_keluar"] ? "-" : $data["tgl_keluar"] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Late</span>
                    </div>
                    <div class="col-sm-6">
                        <span>
                            <?= $data["terlambat_second"] == 0 ? "-" : number_format(($data["terlambat_second"] / 60), 2, '.', '') . " minutes" ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Total Work</span>
                    </div>
                    <div class="col-sm-6">
                        <span>
                            <?= $data["total_time_second"] == 0 ? "-" : number_format(($data["total_time_second"] / 60), 2, '.', '') . " minutes" ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Start Distance</span>
                    </div>
                    <div class="col-sm-6">
                        <span>
                            <?= $data["calc_geofence_meter"] ?> meter
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <span>End Distance</span>
                    </div>
                    <div class="col-sm-6">
                        <span>
                            <?= $data["end_calc_geofence_meter"] ?> meter
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Reason In</span>
                    </div>
                    <div class="col-sm-6">
                        <span>
                            <?= $data["reason_in"] ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Reason Out</span>
                    </div>
                    <div class="col-sm-6">
                        <span>
                            <?= $data["reason_out"] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Start</span>
                    </div>
                    <div class="col-sm-6 center">
                        <img src="<?= $data['start_file_loc'] ?>" width="50%" />
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <span>End</span>
                    </div>
                    <div class="col-sm-6 center">
                        <?php if ($data['end_file_loc']) { ?>
                            <img src="<?= $data['end_file_loc'] ?>" width="50%" />
                        <?php } else { ?>
                            <span>-</span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Log Coordinate</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <style>
                #map {
                    height: 500px;
                    width: 100%;
                }
            </style>
            <div id="map"></div>
            <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0LcVlAmmXMro8eH69aK6Wh4lUqttz-Zs&callback=GMPStart"
                defer>
                </script>
        </div>

    </div>
</div>