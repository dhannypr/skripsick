<div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">Pesanan Saya</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>No</th>
                                            <th>Nomor Pesanan</th>
                                            <th>Tanggal</th>
                                            <th>No Meja</th>
                                            <th>Item</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($datamenu as $data => $user){   
                                                ?>
                                            <tr>
                                                <td><?= $no;?></td>
                                                <td><?= $user['id'];?></td>
                                                <td><?= $user['tanggal'];?></td>
                                                <td><?= $user['meja'];?></td>
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
    </div>
  </div>
</div>