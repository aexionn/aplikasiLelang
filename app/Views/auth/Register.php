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
                        <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                        <p class="text-center small">Masukkan Data Pribadi Anda Untuk Membuat Akun</p>
                      </div>

                      <form method="post" action="/regist" class="row g-3 needs-validation">
                        <!-- <div class="col-12">
                          <label for="yourName" class="form-label">Nama Anda</label>
                          <input type="text" name="name" class="form-control" id="yourName">
                          <div class="invalid-feedback">Tolong, Masukkan Nama Anda.</div>
                        </div> -->

                        <div class="col-12">
                          <label for="yourEmail" class="form-label">Email Anda</label>
                          <input type="email" name="email" class="form-control" id="yourEmail" value="<?= session()->get('email'); ?>">
                          <div class="invalid-feedback">Tolong, Masukkan Alamat Email Dengan Format Yang Benar.</div>
                        </div>

                        <div class="col-12">
                          <label for="yourPassword" class="form-label">Sandi</label>
                          <input type="password" name="password" class="form-control" id="yourPassword">
                          <div class="invalid-feedback">Tolong, Masukkan Kata Sandi Anda.</div>
                        </div>

                        <div class="col-12">
                          <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
                        </div>

                        <div class="col-12">
                          <a href="/" class="btn btn-primary w-100" role="button">Kembali Ke Landing Page</a>
                        </div>

                        <div class="col-12">
                          <p class="small mb-0">Sudah Punya Akun? <a href="/login">Masuk Kembali</a></p>
                        </div>
                      </form>

                    </div>
                </div>   
<?= $this->endSection(); ?>           