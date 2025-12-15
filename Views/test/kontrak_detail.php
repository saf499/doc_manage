<?= $this->extend('test/main') ?>

<?= $this->section('test/header') ?>
<section class="header">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kontrak</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('/test/home') ?>">Home</a></li>
              <li class="breadcrumb-item active">Kontrak Detail</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('test/content') ?>
  <section class="section">
    <div class="section-body">
      <?php if(session()->getFlashdata('success')): ?>
      <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
      </div>
        <?php elseif(session()->getFlashdata('error')): ?>
      <div class="alert alert-warning alert-dismissible">
        <?= session()->getFlashdata('error'); ?>
      </div>
      <?php endif; ?>

            <!-- 🔹 Maklumat Kontrak -->
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
           <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Maklumat Kontrak</h3>
              </div>
              <div class="card-body">
                <dl class="row">
                  <dt class="col-sm-3">ID Kontrak</dt>
                  <dd class="col-sm-9">KTK-2025-001</dd>

                  <dt class="col-sm-3">Nama Projek</dt>
                  <dd class="col-sm-9">Naiktaraf Dewan Utama</dd>

                  <dt class="col-sm-3">Kontraktor Utama</dt>
                  <dd class="col-sm-9">Harapan Sdn Bhd (1234567-T)</dd>

                  <dt class="col-sm-3">Sub-Kontraktor Terlibat</dt>
                  <dd class="col-sm-9">
                    <ul class="list-unstyled mb-0">
                      <li>Tech Berjaya Engineering (768234-X)</li>
                      <li>ProMega Holdings (998812-A)</li>
                    </ul>
                  </dd>

                  <dt class="col-sm-3">Harga Kontrak</dt>
                  <dd class="col-sm-9">RM 2,500,000.00</dd>

                  <dt class="col-sm-3">LAD (per hari)</dt>
                  <dd class="col-sm-9">RM 1,000</dd>

                  <dt class="col-sm-3">Bon Laksana Rundingan (BLR)</dt>
                  <dd class="col-sm-9">RM 100,000 (Tarikh: 01 Jan 2024 - 31 Dis 2024)</dd>

                  <dt class="col-sm-3">Tarikh Asal Kontrak</dt>
                  <dd class="col-sm-9">01 Jan 2024 - 31 Dis 2024</dd>
                </dl>
              </div>
              <!-- /.card-body -->
            </div>
           </div>
        </div>
        <!-- /.row -->

        <!-- 🔹 Senarai Lanjutan -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Senarai Tarikh Lanjutan Kontrak</h3>
              </div>
              <div class="card-body">
                <ul class="list-group">

                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                      01 Jan 2025 - 31 Mac 2025<br>
                      <small class="text-muted">Alasan: Permintaan Vendor</small>
                    </div>
                    <div>
                      <a class="btn btn-info btn-sm mr-1" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                      <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
                    </div>
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                      01 Apr 2025 - 30 Jun 2025<br>
                      <small class="text-muted">Alasan: Faktor Cuaca</small>
                    </div>
                    <div>
                      <a class="btn btn-info btn-sm mr-1" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                      <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
                    </div>
                  </li>

                </ul>
              </div>

              <div class="card-footer">
                <!-- 🔹 Butang Tambah Lanjutan -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#lanjutanModal">
                  Tambah Lanjutan
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal for Tambah Lanjutan -->
      <div class="modal fade" id="lanjutanModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="/kontrak/tambah_lanjutan" method="post">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Tarikh Lanjutan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <div class="modal-body">
                <input type="hidden" name="kontrak_id" value="101"> <!-- ganti ikut ID sebenar -->

                <div class="form-group">
                  <label>Tarikh Mula Lanjutan</label>
                  <input type="date" name="tarikh_mula_lanjutan" class="form-control" required>
                </div>

                <div class="form-group">
                  <label>Tarikh Tamat Lanjutan</label>
                  <input type="date" name="tarikh_tamat_lanjutan" class="form-control" required>
                </div>

                <div class="form-group">
                  <label>Alasan Lanjutan</label>
                  <textarea name="alasan_lanjutan" class="form-control" rows="2" placeholder="Contoh: Kelewatan bekalan..." required></textarea>
                </div>
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.card -->
  </section>

<?= $this->endSection() ?>