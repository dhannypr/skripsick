<div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">Order</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>No</th>
                                            <th>No Meja</th>
                                            <th>Waktu Order</th>
                                            <th>Item Order</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($dataorder as $data => $user){
                                                    
                                                ?>
                                            <tr>
                                                <td><?= $no;?></td>
                                                <td><?= $user['meja'];?></td>
                                                <td><?= $user['tanggal'];?></td>
                                                <td><?= $user['item'];?></td>
                                               
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
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Order</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
             </button>
                        </div>
                         <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/create_order'); ?>">
                                <div class="form-group">
                                <label for="exampleInputEmail1">No Meja</label>
                                 <input type="text" class="form-control" name="no_meja" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Waktu Order</label>
                            <input type="date" class="form-control" name="waktu_order" required>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
      </div>
    </div>
  </div>
</div>