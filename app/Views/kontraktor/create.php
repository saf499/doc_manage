<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
  <section class="header">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Kontractor</h1>
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

<?= $this->section('content') ?>
  <section class="section">
    <!-- <script src="<?= base_url('js/changefilename.js') ?>"></script> -->
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
          <form method="post" enctype="multipart/form-data" action="/kontraktor/save">
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
                    <label for="ALAMAT">Alamat</label>
                    <textarea class="form-control" rows="3" placeholder="alamat syarikat anda"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="NO_PHONE">Nombor Phone</label>
                    <input type="text" name="NO_PHONE" placeholder="No phone syarikat anda" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="NO_SYARIKAT">Nombor Syarikat</label>
                    <input type="text" name="NO_SYARIKAT" placeholder="No. pendaftaran syarikat anda" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="NO_FAX">Nombor Fax</label>
                    <input type="text" name="NO_FAX" placeholder="no fax syarikat anda" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="JENIS_KONTRAKTOR">Jenis Kontraktor</label>
                    <select name="JENIS_KONTRAKTOR" class="form-control">
                      <option value="">-- Select an option --</option>
                      <option value="utama">Kontraktor Utama</option>
                      <option value="subkontraktor">Subkontraktor</option>
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
            <a href="<?= site_url('/home') ?>" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create" class="btn btn-success float-right">
          </div>
        </div>
      </form>
    </section> <!-- /.content -->
  </section> <!-- /.content-wrapper -->

<?= $this->endSection() ?>