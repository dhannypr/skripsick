<div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">Keranjang Saya</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>No</th>
                                            <th>Nama Menu</th>
                                            <th>Qty</th>
                                            <th>price</th>
                                            <th>subtotal</th>
                                            <th>No Meja</th>
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
                                                <td><?= $user['qty'];?></td>
                                                <td><?= $user['price'];?></td>
                                                <td><?= $user['subtotal'];?></td>
                                                <td><?= $user['meja'];?></td>
                                                <td>
                                                    <a href="<?= base_url('android/delete_cart/'.$user['id'])?>" class="btn btn-danger btn-circle">
                                                       Delete
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
                        <div class="container ">
                                    <a href="<?= base_url('android/confirm')?>" class="btn btn-success btn-circle">
                                                       Buat Pesanan
                                                </a>
                                
                        </div>
                    </div>
                </div>
            </div>
    </div>
  </div>
</div>