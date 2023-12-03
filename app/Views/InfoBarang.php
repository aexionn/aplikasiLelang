<?= $this->extend('Templates/MainTemplate'); ?>

<?= $this->section('content'); ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Info Barang</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Info Barang</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <?php foreach($lelang as $data): ?>
        <section class="section">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <td><img src="/Append/Append/assets/img/<?= $data['gambar']; ?>" class="card-img-top" alt="..."></td>
                    </div>
                    <div class="card">
                        <table class="table table-striped">
                            <thead>
                                <th>Uraian Lainnya : </th>
                            </thead>
                            <tbody>                                
                                <tr><td>No Rangka: <?= $data['no_rangka'] ?></td></tr>
                                <tr><td>No Mesin: <?= $data['no_mesin'] ?></td></tr>
                                <tr><td>Info Mesin: <?= $data['info_mesin'] ?></td></tr>
                                <tr><td>Turbo: <?= $data['turbo'] ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title text-center" style="font-size: 4em;"><?= $data['nama_barang'] ?></h1>
                            <h4 class="card-subtitle mb-2 text-body-secondary text-center"><?= $data['type'] ?></h4>
                        </div>
                        <div class="card-body">
                            <br>
                            <span>Nilai Limit: </span>
                            <h2><?= number_to_currency($data['harga_awal'], 'IDR', 'id_ID') ?></h2>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Status Lelang</td>
                                        <td><?= $data['status'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pemilik</td>
                                        <td><?= $data['nama_pemilik'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dilelang Sejak</td>
                                        <td><?= $data['tgl_lelang'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Batas Lelang</td>
                                        <td><?= $data['tgl_akhir'] ?></td>
                                    </tr>
                                    <tr>
                                        
                                        <?php if(!$data['harga_akhir']  == null){ ?>
                                            <td>Penawaran Tertinggi (Saat ini)</td>
                                            <td><?= number_to_currency($data['harga_akhir'], 'IDR', 'id_ID') ?></td>
                                        <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <a href="/participate/<?= $data['id_lelang'] ?>" class="btn btn-primary btn-block btn-lg w-100"><span>Ikuti Lelang</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endforeach; ?>
    </main><!-- End #main -->
    <!-- <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> -->


<?= $this->endSection(); ?>