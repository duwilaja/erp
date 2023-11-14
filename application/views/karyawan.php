<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

<form action="<?=site_url('karyawan/index')?>" method="post">
    
    <select class="form-control" id="k" name="karyawan">
        <?php foreach ($karyawan as $v) { ?>
            <option value="<?=$v->id;?>"><?=$v->nama;?></option>
        <?php } ?>
    </select>

    <select class="form-control" id="jabatan" name="jabatan">
        <?php foreach ($jabatan as $j) { ?>
            <option value="<?=$j->id;?>"><?=$j->nma_jabatan;?></option>
        <?php } ?>
    </select>

    <input type="submit" name="btn" value="Simpan">
</form>

<table border="1">
    <tr>
        <td>ID</td>
        <td>Nama</td>
        <td>Nik</td>
        <td>Jabatan</td>
        <td>Singkronisasi Karyawan</td>
    </tr>
    <?php foreach ($karyawan as $v) { ?>
    <tr>
        <td><?=$v->id;?></td>
        <td><?=$v->nama;?></td>
        <td><?=$v->nip;?></td>
        <td><?= @$this->mj->get($v->jabatan_id)->row()->nma_jabatan;?></td>
        <td><?=$this->mu->get('',['username' => $v->nip,'password' => md5($v->nip)])->num_rows() > 0 ? 'Bisa Login' : 'Gak Bisa Login';?></td>
    </tr>
    <?php } ?>
</table>

<script src="<?= base_url('template/');?>plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script>
    $('#k').select2();
    $('#jabatan').select2();
</script>