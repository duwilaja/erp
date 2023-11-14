<?php if ($bread['nama'] != '') { ?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=$bread['nama'];?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <?php foreach ($bread['data'] as $v) { ?>
              <li class="breadcrumb-item <?=$v['active'];?>"><?= $v['active'] == 'active' ? $v['nama'] :'<a class="text-gray-dark" href="'.$v['link'].'">'.$v['nama'].'</a>';?></li>
              <?php  } ?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<?php }else{ echo "<div class='mt-3'></div>"; } ?>