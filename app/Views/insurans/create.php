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
            <form method="post" action="/insurans/store">
            <div id="in-entries">

              <input type="hidden" name="insurans[0][projek_id]" value="<?= $projek_id; ?>">

              <div class="form-group">
                <label for="jenis_insurans">Jenis Insurans</label>
                  <select name="insurans[0][jenis_insurans]" class="form-control">
                    <option value="">
                      - Select an option -
                    </option>
                    <option value="workmen">
                      Workmen's Compensation
                    </option>
                    <option value="car">
                      Contractor All Risk (CAR / EAR)
                    </option>
                    <option value="public">
                      Public Liability
                    </option>
                    <option value="socso">
                      SOCSO
                    </option>
                    <option value="iow">
                      Insurance of Works
                    </option>
                  </select>
              </div>
              <div class="form-group">
                <label for="nama_bank">Nama Bank / Syarikat Insurans</label>
                <input type="text" name="insurans[0][nama_bank]" class="form-control">
              </div>
              <div class="form-group">
                <label for="no_polisi">No. Polisi</label>
                <input type="text" name="insurans[0][no_polisi]" class="form-control">
              </div>
              <div class="form-group">
                <label for="tempoh_dlp">Tempoh DLP</label>
                <input type="number" 
                  step="1"
                  min="0"
                  name="insurans[0][tempoh_dlp]" 
                  id="tempoh_dlp" 
                  class="form-control" 
                  placeholder="Enter the total">
              </div>
              <div class="form-group">
                <label>Jumlah Insurans</label>
                <input type="number" 
                  step="0.01"
                  min="0.00"
                  name="insurans[0][jumlah_insurans]" 
                  id="jumlah_insurans" 
                  class="form-control" 
                  placeholder="Enter the total">
              </div>
              <div class="form-group">
                <label for="tarikh_mula">Tarikh Mula</label>
                <input type="date" name="insurans[0][tarikh_mula]">
              </div>
              <div class="form-group">
                <label for="tarikh_akhir">Tarikh Akhir</label>
                <input type="date" name="insurans[0][tarikh_akhir]">
              </div>
              <div>
                <label for="status">Status</label>
                <select name="insurans[0][status]" class="form-control">
                  <option value="">- Select an option -</option>
                  <option value="asal">Asal</option>
                  <option value="lanjutan">Lanjutan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="tarikh_asal">Tarikh Asal</label>
                <input type="date" name="insurans[0][tarikh_asal]">
              </div>
              <div class="form-group">
                <label for="tarikh_lanjutan">Tarikh Lanjutan</label>
                <input type="date" name="insurans[0][tarikh_lanjutan]">
              </div>
              </div>
              <button type="button" class="btn btn-primary" id="add-in-entry">+ Add Insurans</button>
              <!-- /.card-body -->
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
          <a href="<?= site_url('/home') ?>" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new Porject" class="btn btn-success float-right">
        </div>
      </div>
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->
  </section>

<?= $this->endSection() ?>