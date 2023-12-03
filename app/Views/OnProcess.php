<?= $this->extend('Templates/MainTemplate'); ?>

<?= $this->section('content'); ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Lelang Yang Diikuti</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Lelang Yang Diikuti</li>
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
            <?php if (!empty($lelang)) { ?>
            <?php 
                $i = 0;
                foreach ($lelang as $data) { 
            ?>
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Harga Limit</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $i+= 1 ?></th>
                            <td><?= $data['nama_barang'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= number_to_currency($data['harga_awal'], 'IDR', 'id_ID') ?></td>
                            <td>
                                <a role="button" class="btn btn-outline-primary" href="/info/<?= $data['id_lelang']?>">Lihat</a>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalBatal">Batalkan</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php } ?>
            </div>
            <?= $pager->links('onprocess', 'bootstrap_full'); ?>
        </section>
        <form action="/batal/<?= $data['id_lelang']; ?>" method="post" class="d-inline">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal fade modal-lg" id="modalBatal" tabindex="-1" aria-labelledby="modalBatalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-danger" id="modalBatalLabel">PERINGATAN !</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body text-center text-lg">
                        <h5>Anda Yakin Ingin Membatalkan Ke Ikut Sertaan Anda Dalam Lelang Ini ?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-warning">Ya</button>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Tidak</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
        <?php }else{ ?>
            <h4 class="text-center text-secondary">Tidak Ada Lelang Yang Sedang Diikuti</h4>
        <?php } ?>
    </main><!-- End #main -->
    
<?= $this->endSection(); ?>