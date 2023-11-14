<style>
    table tr td, table tr td .form-control {
        font-size: 12px;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <form action="javascript:void(0);" id="formHakAkses">
            <div class="card">
                <div class="card-header">Hak Akses</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <p class="mt-2">Urutan</p>
                            <input type="hidden" name="id" id="idm" value="<?=$this->input->get('idm');?>">
                            <div><input type="number" class="form-control" name="urutan" id="urutan"></div>
                        </div>
                        <div class="col-md-7">
                            <p class="mt-2">Menu</p>
                            <div><input type="text" class="form-control" name="menu" id="menu"></div>
                        </div>
                        <div class="col-md-4">
                            <p class="mt-2">Target Link</p>
                            <div><input type="text" class="form-control" name="target" id="target"></div>
                        </div>
                        <div class="col-md-12">
                            <p class="mt-2">Icon</p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i id="x-icon"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="icon" placeholder="Icon" aria-label="icom" name="icon" aria-describedby="basic-addon1">
                            </div>
                            <div><a href="https://fontawesome.com/icons?d=gallery">Link icon di sini</a></div>
                        </div>
                        <div class="col-md-6">
                            <p class="mt-2">Level</p>
                            <div>
                                <select class="form-control w-100" name="level[]" onchange="getKaryawanLevel()" id="level" multiple>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="mt-2">Block Akses</p>
                            <div>
                                <select class="form-control w-100" name="block[]" id="block" multiple>
                                    <option value="">Tidak Ada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-4 mb-4">Submenu</div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Urutan</td>
                                        <td>Submenu</td>
                                        <td>Link</td>
                                        <td>Block</td>
                                        <td><button type="button" id="add" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button></td>
                                    </tr>
                                </thead>
                                <tbody id="bsub">
                                    <tr class="t">
                                        <td style="width: 100px;"><input type="number" class="form-control form-control-sm" name="no" id="no"></td>
                                        <td><input type="text" class="form-control form-control-sm" name="submenu" id="submenu"></td>
                                        <td><input type="text" class="form-control form-control-sm" name="sub_target" id="sub_target"></td>
                                        <td>
                                            <select class="form-control w-100" class="form-control" name="sub_block" id="sub_block" multiple>
                                                <option value="">Tidak Ada</option>
                                            </select>
                                        </td>
                                        <td><button type="button" id="del" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="reset" class="btn btn-dark">Reset</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>