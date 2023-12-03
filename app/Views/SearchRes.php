<?= $this->extend('Templates/MainTemplate') ?>   

<?= $this->section('content') ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
            <?php foreach ($lelang as $data) { ?>
                <a href="/info/<?= $data['id_lelang']?>">
                <div class="col-lg-7">
                    <div class="card">
                        <img src="/Append/Append/assets/img/<?= $data['gambar']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title"><?= $data['nama_barang'] ?></h5>
                        <p class="card-subtitle mb-2 text-body-secondary"><i class="ri-map-pin-2-fill"></i> <?= $data['alamat'] ?></p>
                        <span><?= number_to_currency($data['harga_awal'], 'IDR', 'id_ID') ?></span>
                        </div>
                    </div>
                </div>
                </a>
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
            <?= $pager->links('note', 'bootstrap_full'); ?>
        </section>

    </main><!-- End #main -->
        <!-- <form action="/delete/" method="post" class="d-inline">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">>
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title">Peringatan !</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Apakah Anda Yakin Ingin Menghapus Catatan ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ya</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    </div>
                    </div>
                </div>
            </div>
        </form> -->
<?= $this->endSection() ?>