<div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="<?= base_url('android') ?>" class="simple-text">
                        Kopi Enuk
                    </a>
                </div>
                <ul class="nav">
                    <?php 
                        if($cekmeja == 1){
                    ?>        
                    <li class="nav-item active" id="ourmenu">
                        <a class="nav-link" href="<?= base_url('android/menu_utama') ?>">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Our Menu</p>
                        </a>
                    </li>
                    <li id="cart">
                        <a class="nav-link" href="<?= base_url('android/cart') ?>">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Keranjang Saya</p>
                        </a>
                    </li>
                    <li id="order">
                        <a class="nav-link" href="<?= base_url('android/pesanan') ?>">
                            <i class="nc-icon nc-notes"></i>
                            <p>Pesanan Saya</p>
                        </a>
                    </li>
                  <?php  
                }
                ?>
                </ul>
            </div>
        </div>