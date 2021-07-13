<div class="col-lg-6">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Meja</h1>
<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/proses_edit_meja/'.$datamenu[0]['id']); ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">No Meja</label>
                    <input type="text" class="form-control" name="no_meja" value="<?= set_value('no_meja',$datamenu[0]['no_meja']) ?> "  required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Kode QR</label>
                    <br>
                    <img src="<?= base_url('uploads/'.$datamenu[0]['barcode']) ?>" alt="" width="140">
                </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
        </div>
    </div>

</div>