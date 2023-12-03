<?= $this->extend('Templates/MainTemplate'); ?>

<?= $this->section('content'); ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Histori</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Histori</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <!-- <form class="d-flex mb-3" action="/cari" method="get" role="search">
                <input class="form-control me-2" type="search" name="cari" placeholder="Cari Berdasarkan Nama Barang atau Harga Limit" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Cari</button>
            </form> -->
            <br>
            <div class="row">
            <?php if (!empty($histori)) { ?>
            <?php foreach ($histori as $data) { ?>
                <a href="/infohistori/<?= $data['id_lelang']?>">
                <div class="col-lg-7">
                    <div class="card">
                        <img src="/Append/Append/assets/img/<?= $data['gambar']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title"><?= $data['nama_barang'] ?></h5>
                        <p class="card-subtitle mb-2 text-body-secondary"><i class="ri-map-pin-2-fill"></i> <?= $data['alamat'] ?></p>
                        <p>Harga Limit : <?= number_to_currency($data['harga_awal'], 'IDR', 'id_ID') ?></p>
                        <p>Penawaran Yang Anda Tawarkan : <?= number_to_currency($data['largestbid'], 'IDR', 'id_ID') ?></p>
                        </div>
                    </div>
                </div>
                </a>
            <?php } ?>
            <?php }else{ ?>
                <h4 class="text-center text-secondary">Anda Belum Pernah Mengikuti Lelang Sama Sekali</h4>
             <?php } ?>
                <!-- <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Example Card</h5>
                        <p>This is an examle page with no contrnt. You can use it as a starter for your custom pages.</p>
                        </div>
                    </div>
                </div> -->
            </div>
            <?= $pager->links('lelang', 'bootstrap_full'); ?>
        </section>

    </main><!-- End #main -->
    
<?= $this->endSection(); ?>