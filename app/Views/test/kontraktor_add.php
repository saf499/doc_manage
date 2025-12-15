<?= $this->extend('test/main') ?>

<?= $this->section('test/header') ?>
  <section class="header">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Register New Contractor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Kontraktor</li>
              <li class="breadcrumb-item active">Kontraktor Add</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

          <!-- bs-custom-file-input -->
    <script src="<?= base_url() ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Page specific script -->
    <script>
    $(function () {
      bsCustomFileInput.init();
    });
    </script>
  </section>

<?= $this->endSection() ?>

<?= $this->section('test/content') ?>
  <section class="section">
    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('success'); ?>
    </div>
      <?php elseif(session()->getFlashdata('error')): ?>
    <div class="alert alert-warning alert-dismissible">
      <?= session()->getFlashdata('error'); ?>
    </div>
    <?php endif; ?>
    <!-- ./Main content -->
    <section class="content">
      <!-- ./row -->
      <div class="row">
        <div class="col-md-6">
          <!-- <form method="post" enctype="multipart/form-data" action="/kontraktor/save"> -->
            <div class="container-fluid">
              <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Maklumat Kontraktor</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="NAMA_SYARIKAT">Nama Syarikat</label>
                    <input type="text" name="NAMA_SYARIKAT" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" rows="3" placeholder="Alamat Syarikat"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="no_phone">Nombor Phone</label>
                    <input type="text" name="no_phone" placeholder="No phone syarikat anda" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="no_syarikat">Nombor Syarikat</label>
                    <input type="text" name="no_syarikat" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="no_fax">Nombor Fax</label>
                    <input type="text" name="no_fax" placeholder="no fax syarikat anda" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="jenis_kontraktor">Jenis Kontraktor</label>
                    <select name="jenis_kontraktor" class="form-control">
                      <option value="">-- Select an option --</option>
                      <option value="utama">Kontraktor Utama</option>
                      <option value="sub">Subkontraktor</option>
                    </select>
                  </div>
                </div>
              </div><!-- /.card 1 -->
            </div>
        </div>
        <div class="col-md-6">
          <div class="container-fluid">
            <div class="card card-info"><!-- 2nd for the dokumen n so on -->
              <div class="card-header"><h3 class="card-title">Dokumen</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <!-- card-body-content -->
              <div class="card-body">
                <div class="form-group">
                  <label for="sst">Sijil Pendaftaran CIDB</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="spc">
                      <label class="custom-file-label" for="spc">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="sst">Surat Setuju Terima/Surat Pemberitahuan Inden</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="sst">
                      <label class="custom-file-label" for="sst">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.card 2 -->
          </div>
        </div>
      </div>
        <div class="row">
          <div class="col-12">
            <a href="<?= site_url('/test/home') ?>" class="btn btn-secondary">Cancel</a>
            <a href="<?= site_url('/test/kontraktor') ?>" class="btn btn-success float-right">Submit</a>
          </div>
        </div>
      <!-- </form> -->
    </section> <!-- /.content -->
  </section> <!-- /.content-wrapper -->

<?= $this->endSection() ?>