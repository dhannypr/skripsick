
    
      
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h4>Silahkan Scan QR pada meja anda</h4>
                                <hr>
                                <video src="" id="preview" width="230" height="300">
                                </video>
                                <form action="<?= base_url('android/submit_meja') ?>" method="POST">
                                    <input type="text" class="form-control" name="meja" id="hasil" readonly>
                                    <br>
                                    <button id="menu" class="btn btn-success">Lihat Menu</button>
                                    <a href=" <?=base_url('android')?>" id="scan" class="btn btn-warning">Scan Ulang</a>
                                </form>
                            </center>
                            
                        </div>
                    </div>
                </div>
            </div>
           