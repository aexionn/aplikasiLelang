<?= $this->extend('Templates/MainTemplate'); ?>
<?= $this->section('content'); ?>

    <main id="main" class="main">

        <?php if(session()->getFlashData('sukses')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('sukses'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif(session()->getFlashData('gagal')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashData('gagal'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <div class="pagetitle">
            <h1>Halaman Lelang</h1>
            <nav>
            <?php foreach($lelang as $data): ?>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/info/<?= $data['id_lelang']?>">Info Barang</a></li>
                    <li class="breadcrumb-item active">Halaman Lelang</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-md-7">
                    <!-- <div class="card">
                        <td><img src="/Append/Append/assets/img/<?= $data['gambar']; ?>" class="card-img-top" alt="..."></td>
                    </div> -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-subtitle mb-2 text-body-secondary text-center">Sertakan Dokumen Pendukung</h4>
                            </div>
                            <div class="card-body">
                                <form action="/participateProcess/<?= $data['id_lelang']; ?>" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                                    <input type="hidden" name="_method" value="PUT">
                                    <br>
                                    <label for="formKtp" class="form-label">Foto KTP</label>
                                    <input class="form-control" type="file" name="ktp" id="formKtp">
                                    <span class="text-danger form-text "><?= $validation->getError('ktp'); ?></span>
                                    <hr>
                                    <label for="formNpwp" class="form-label">Foto NPWP</label>
                                    <input class="form-control" type="file" name="npwp" id="formNpwp">
                                    <span class="text-danger form-text "><?= $validation->getError('npwp'); ?></span>
                                    <hr>
                                    <label for="formNoRek" class="form-label">Foto Buku Rekening</label>
                                    <input class="form-control" type="file" name="norek" id="formNoRek">
                                    <span class="text-danger form-text "><?= $validation->getError('norek'); ?></span>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="tawaran" class="form-label">Tuliskan Penawaran</label>
                                        <input type="text" class="form-control" name="penawaran" id="tawaran" placeholder="Penawaran Tidak Boleh Kurang dari Harga Limit">
                                        <input type="hidden" id="limit" name="limit" value="<?= $data['harga_awal'] ?>">
                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-lg w-100"><span>Ikuti Lelang</span></button>
                                </form>
                            </div>
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
                                        <td>Tawaran Tertinggi Anda</td>
                                        <td><?= number_to_currency($data['largestbid'], 'IDR', 'id_ID')?></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            
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
    
    <script>
        // (() => {
        //     'use strict'

        //     // Fetch all the forms we want to apply custom Bootstrap validation styles to
        //     const forms = document.querySelectorAll('.needs-validation')

        //     // Loop over them and prevent submission
        //     Array.from(forms).forEach(form => {
        //         form.addEventListener('submit', event => {
        //         if (!form.checkValidity()) {
        //             event.preventDefault()
        //             event.stopPropagation()
        //         }

        //         form.classList.add('was-validated')
        //         }, false)
        //     })
        // })()
        // const inputElement = document.getElementById("tawaran");
        // const maxLength = document.getElementById("limit");

        // inputElement.addEventListener("keyup", function() {
        // const currentLength = inputElement.value;
        // if (Number(currentLength) < Number(maxLength.value)) {
        //     alert('limit')
        //     inputElement.value = maxLength.value;
        // }
        // });

        // inputElement.addEventListener("keydown", function(event) {
        // const currentLength = inputElement.value;
        // if (Number(currentLength) >= Number(maxLength.value) && event.key !== "Backspace" && event.key !== "Delete") {
        //     event.preventDefault();
        // }
        // });
  </script>

<?= $this->endSection(); ?>