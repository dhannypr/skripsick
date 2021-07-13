<div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">Meja</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                <button class="btn btn-success ml-2 my-4"   type="button" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-plus"></i>
                                Tambah
                                </button>
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>No</th>
                                            <th>Kode QR</th>
                                            <th>No Meja</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($datameja as $data => $user){   
                                                ?>
                                            <tr>
                                                <td><?= $no;?></td>
                                                <td><img src="<?= base_url('uploads/'.$user['barcode']) ?>" alt="" width="100"></td>
                                                <td><?= $user['no_meja'];?></td>
                                                <td>
                                                    <a href="<?= base_url('dashboard/delete_meja/'.$user['id'])?>" class="btn btn-danger btn-circle">
                                                       Delete
                                                </a>
                                                
                                                <a href="<?= base_url('dashboard/edit_meja/'.$user['id'])?>" class="btn btn-primary btn-circle">
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
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                 <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Meja</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
             </button>
                        </div>
                         <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/create_meja'); ?>">
                                <div class="form-group">
                                <label for="exampleInputEmail1">No Meja</label>
                                 <input type="text" class="form-control" name="no_meja" required>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
      </div>
    </div>
  </div>
</div>