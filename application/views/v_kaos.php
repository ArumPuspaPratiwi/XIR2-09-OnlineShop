<h2>Daftar Kaos</h2>
<?= $this->session->flashdata('pesan'); ?>
<center>
  <a href="#tambah" data-toggle="modal" class="btn btn-warning">+Tambah</a>
</center>
<table id="example" class="table table-hover table-striped">
  <thead>
    <tr>
      <td>No</td>
      <td>Gambar Kaos</td>
      <td>Nama Kaos</td>
      <td>Edisi</td>
      <td>Merk</td>
      <td>Harga</td>
      <td>Stok</td>
      <td>Aksi</td>
    </tr>
  </thead>
  <tbody>
    <?php $no=0; foreach($tampil_kaos as $kaos):
    $no++; ?>
    <tr>
      <td><?= $no ?></td>
      <td><img src="<?=base_url('assets/img/'.$kaos->gambar_kaos )?>" style="width: 40px"></td>
      <td><?= $kaos->nama_kaos ?></td>
      <td><?= $kaos->edisi ?></td>
      <td><?= $kaos->nama_kategori ?></td>
      <td><?= $kaos->harga ?></td>
      <td><?= $kaos->stok ?></td>
      <td><a href="#edit" onclick="edit('<?= $kaos->id_kaos ?>')" data-toggle="modal" class="btn btn-success">Ubah</a>
        <a href="<?=base_url('index.php/kaos/hapus/'.$kaos->id_kaos)?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Hapus</a></td>
    </tr>
  <?php endforeach ?>
  <tbkody>
</table>

<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-titile">Tambah Kaos</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/kaos/tambah')?>" method="post" enctype="multipart/form-data">
          <table>
            <tr>
              <td><input type="hidden" name="id_kaos" class="form-control"></td>
            </tr>
            <tr>
              <td>Nama Kaos</td>
              <td><input type="text" name="nama_kaos" required class="form-control"></td>
            </tr>
            <tr>
              <td>Merk</td>
              <td><select name="id_kategori" class="form-control">
                <option></option>
                <?php foreach($kategori as $kat): ?>
                <option value="<?=$kat->id_kategori?>"><?=$kat->nama_kategori?></option>
                <?php endforeach ?>
              </select></td>
            </tr>
            <tr>
              <td>edisi</td>
              <td><input type="number" name="edisi" required class="form-control"></td>
            </tr>
            <tr>
              <td>Harga</td>
              <td><input type="number" name="harga" required class="form-control"></td>
            </tr>
            <tr>
              <td>Stok</td>
              <td><input type="number" name="stok" required class="form-control"></td>
            </tr>
            <tr>
              <td>Gambar Kaos</td>
              <td><input type="file" name="gambar_kaos" class="form-control"></td>
            </tr>
          </table>
          <input type="submit" name="create" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-titile">Edit Kaos</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/kaos/kaos_update')?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_kaos_lama" id="id_kaos_lama">
          <table>
            <tr>
              <td><input type="hidden" name="id_kaos" id="id_kaos" class="form-control"></td>
            </tr>
            <tr>
              <td>Nama Kaos</td>
              <td><input type="text" name="nama_kaos" id="nama_kaos" required class="form-control"></td>
            </tr>
            <tr>
              <td>Merk</td>
              <td><select name="id_kategori" class="form-control" id="id_kategori">
                <option></option>
                <?php foreach($kategori as $kat): ?>
                <option value="<?=$kat->id_kategori?>"><?=$kat->nama_kategori?></option>
                <?php endforeach ?>
              </select></td>
            </tr>
            <tr>
              <td>Edisi</td>
              <td><input type="number" name="edisi" required id="edisi" class="form-control"></td>
            </tr>
            <tr>
              <td>Harga</td>
              <td><input type="number" name="harga" required id="harga" class="form-control"></td>
            </tr>
            <tr>
              <td>Stok</td>
              <td><input type="number" name="stok" required id="stok" class="form-control"></td>
            </tr>
            <tr>
              <td>Gambar Kaos</td>
              <td><input type="file" name="gambar_kaos" id="gambar_kaos" class="form-control"></td>
            </tr>
          </table>
          <input type="submit" name="edit" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function edit(a){
    $.ajax({
      type:"post",
      url:"<?=base_url()?>index.php/kaos/edit_kaos/"+a,
      dataType:"json",
      success:function(data){
        $("#id_kaos").val(data.id_kaos);
        $("#nama_kaos").val(data.nama_kaos);
        $("#edisi").val(data.edisi);
        $("#id_kategori").val(data.id_kategori);
        $("#harga").val(data.harga);
        $("#stok").val(data.stok);
        $("#id_kaos_lama").val(data.id_kaos);
      }
    })
  }
</script>
