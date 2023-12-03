<?= $this->extend('Templates/AuthTemplate'); ?>

<?= $this->section('content'); ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <?php if(session()->getFlashData('logMsg')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <div class="alert-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <b>Error !</b>
                                    <?= session()->getFlashData('logMsg'); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Masuk Ke Dalam Akun Anda</h5>
                            <p class="text-center small">Masukkan Nama Beserta Kata Sandi Anda</p>
                        </div>

                        <form method="post" action="/loginStep" class="row g-3 needs-validation">

                            <div class="col-12">
                                <label for="yourName" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                                    <input type="text" name="email" class="form-control" id="yourName" required>
                                    <div class="invalid-feedback">Tolong, Masukkan Nama Anda.</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="yourPassword" class="form-label">Sandi</label>
                                <input type="password" name="password" class="form-control" id="yourPassword" required>
                                <div class="invalid-feedback">Tolong, Masukkan Kata Sandi Anda.</div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Masuk</button>
                            </div>
                            <div class="col-12">
                                <p class="small mb-0">Belum Memiliki Akun ? <a href="/register">Buat Akun</a></p>
                            </div>
                        </form>

                    </div>
                </div>
<?= $this->endSection(); ?>  