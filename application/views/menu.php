<div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">Menu</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                <button class="btn btn-success ml-2 my-4"   type="button" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-plus"></i>
                                Tambah
                                </button>
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Type</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($datamenu as $data => $user){
                                                    
                                                ?>
                                            <tr>
                                                <td><?= $no;?></td>
                                                <td><?= $user['name'];?></td>
                                                <td><?= $user['type'];?></td>
                                                <td><img src="<?= base_url('uploads/'.$user['image']);?>" alt="" width="100"></td>
                                                <td><?= $user['price'];?></td>
                                                <td>
                                                <a href="<?= base_url('dashboard/delete_menu/'.$user['id'])?>" class="btn btn-danger btn-circle">
                                                    Delete
                                                </a>

                                                <a href="<?= base_url('dashboard/edit_menu/'.$user['id'])?>" class="btn btn-primary btn-circle">
                                                             Edit
                                                </a>
                                            </tr>
                                            <?php
                                            $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                 <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
             </button>
                        </div>
                                 <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/create_menu'); ?>">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                 <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">harga</label>
                            <input type="number" class="form-control" name="price" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Type</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name="type" required>
                                <option selected>pilih...</option>
                                <option value="makanan">Makanan</option>
                                <option value="minuman">Minuman</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Gambar</label>
                            <input type="file" class="form-control" name="image" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
      </div>
    </div>
  </div>
</div>