<div class="col-lg-6">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Menu</h1>
<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/proses_edit_menu/'.$datamenu[0]['id']); ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" name="name"  required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">harga</label>
                    <input type="number" class="form-control" name="price"   required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="type"  required>
                        <option selected></option>
                        <option value="makanan">Makanan</option>
                        <option value="minuman">Minuman</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Gambar</label>
                    <input type="file" class="form-control" name="image">
                </div>

                <div>
                    <img src="<?= base_url('uploads/'.$datamenu[0]['image']) ?>" alt="" width="140">
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
        </div>
    </div>

</div>