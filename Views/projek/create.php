<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
  <section class="header">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Daftar Projek Baru</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Projek</li>
                <li class="breadcrumb-item active">Projek Add</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
  </section>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="section">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
            <form method="post" action="/projek/store">
              <div class="form-group">
                <label for="nama_projek">Nama Projek</label>
                <input type="text" name="nama_projek" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="nama_pemohon">Nama Pemohon</label>
                <input type="text" name="nama_pemohon" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="no_kontrak">No Kontrak</label>
                <input type="text" name="no_kontrak" class="form-control">
              </div>
              <div class="form-group">
                <label>Anggaran Kos: RM</label>
                <input type="number" 
                  step="0.01"
                  min="0.00" 
                  name="anggaran_kos" 
                  id="anggaran_kos" 
                  class="form-control" 
                  placeholder="Enter the cost estimate">
              </div>
              <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type = "number"
                  name = "tahun" id = "tahun" 
                  min = "1900" max = "2999" 
                  step = "1" class = "form-control"
                  placeholder = "Enter which year">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Advance</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
              <label for="sumber_peruntukan">Sumber Peruntukan: </label>
                <select name="sumber_peruntukan" class="form-control">
                  <option value="">
                    Select an option
                  </option>
                  <option value="d.e">
                    D.E
                  </option>
                  <option value="rezab">
                    Rezab
                  </option>
                  <option value="mengurus">
                    Mengurus
                  </option>
                  <option value="lain-lain">
                    Lain-lain
                  </option>
                </select>
              </div>
              <div class="form-group">
              <label for="jenis_kontrak">Jenis Kontrak: </label>
                <select name="jenis_kontrak" class="form-control">
                  <option value="">
                    Select an option
                  </option>
                  <option value="perkhidmatan">
                    Perkhidmatan
                  </option>
                  <option value="bekalan">
                    Bekalan
                  </option>
                  <option value="kerja">
                    Kerja
                  </option>
                </select>
              </div>
              <div>
                <label for="status_projek">Status Projek</label>
                <select name="status_projek" class="form-control">
                  <option value="perancangan">Perancangan</option>
                  <option value="aktif">Aktif</option>
                  <option value="KIV">K.I.V</option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="<?= site_url('/projek') ?>" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new Porject" class="btn btn-success float-right">
        </div>
      </div>
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->
  </section>

<?= $this->endSection() ?>