<?= $this->extend('test/main') ?>

<?= $this->section('test/header') ?>
<section class="header">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Insurans</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('/test/insurans') ?>">Insurans</a></li>
            <li class="breadcrumb-item active">Tambah Baru</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Date Picker CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
  <script src="<?= base_url() ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script>
  $(function () {
    // Initialize datepicker
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
    
    // Conditional fields
    $('#status').change(function() {
      if($(this).val() === 'lanjutan') {
        $('#tarikh-lanjutan-group').show();
        $('#tarikh-asal-group').hide();
      } else {
        $('#tarikh-lanjutan-group').hide();
        $('#tarikh-asal-group').show();
      }
    });
  });
  </script>
</section>
<?= $this->endSection() ?>

<?= $this->section('test/content') ?>
<section class="section">
  <div class="container-fluid">
    <!-- Notifikasi -->

    <!-- <form method="post" action="<?= site_url('/test/insurans/save') ?>" enctype="multipart/form-data"> -->
      <div class="row">
        <div class="col-md-8">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Maklumat Insurans</h3>
            </div>
            
            <div class="card-body">
              <!-- Pilih Kontrak -->
              <div class="form-group">
                <label>Pilih Kontrak <span class="text-danger">*</span></label>
                <select name="kontrak_id" class="form-control select2" required>
                  <option>- Pilih Kontrak -</option>
                  <option>Naiktaraf Bangunan FSKTM</option>
                  <option>Projek ICT Baru 2025</option>8
                </select>
              </div>

              <!-- Jenis Insurans -->
              <div class="form-group">
                <label>Jenis Insurans <span class="text-danger">*</span></label>
                <select name="jenis_insurans" class="form-control" required>
                  <option value="">- Pilih Jenis -</option>
                  <option value="car">Contractor All Risk (CAR/EAR)</option>
                  <option value="liab">Public Liability</option>
                  <option value="workmen">Workmen's Compensation</option>
                </select>
              </div>

              <!-- Maklumat Polisi -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>No. Polisi <span class="text-danger">*</span></label>
                    <input type="text" name="no_polisi" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Syarikat Insurans <span class="text-danger">*</span></label>
                    <input type="text" name="syarikat_insurans" class="form-control" required>
                  </div>
                </div>
              </div>

              <!-- Tempoh & Nilai -->
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Nilai Pertanggungan (RM)</label>
                    <input type="number" name="nilai" step="0.01" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Tarikh Mula <span class="text-danger">*</span></label>
                    <input type="text" name="tarikh_mula" class="form-control datepicker" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Tarikh Tamat <span class="text-danger">*</span></label>
                    <input type="text" name="tarikh_tamat" class="form-control datepicker" required>
                  </div>
                </div>
              </div>

              <!-- Status & Lampiran -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="aktif">Aktif</option>
                      <option value="tamat">Tamat</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Muat Naik Sijil Insurans</label>
                    <div class="custom-file">
                      <input type="file" name="dokumen" class="custom-file-input" id="customFile">
                      <label class="custom-file-label" for="customFile">Pilih fail</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sidebar untuk Maklumat Kontrak -->
        <div class="col-md-4">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Maklumat Kontrak</h3>
            </div>
            <div class="card-body">
              <dl class="dl-horizontal">
                <dt>No. Kontrak:</dt>
                <dd id="kontrak-no">-</dd>
                
                <dt>Projek:</dt>
                <dd id="kontrak-projek">-</dd>
                
                <dt>Kontraktor:</dt>
                <dd id="kontrak-kontraktor">Harapan Gemilang Sdn Bhd</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>

      <!-- Button Submit -->
      <div class="row">
        <div class="col-12">
          <a href="<?= site_url('/test/insurans') ?>" class="btn btn-secondary">Batal</a>
          <button type="submit" class="btn btn-success float-right">
            <i class="fas fa-save"></i> Simpan Insurans
          </button>
        </div>
      </div>
    <!-- </form> -->
  </div>
</section>
<?= $this->endSection() ?>