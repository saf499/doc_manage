<?= $this->extend('test/main') ?>

<?= $this->section('test/header') ?>
  <section class="header">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Bon</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Bon</li>
              <li class="breadcrumb-item active">Bon Add</li>
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
        <div class="col-md-12">
          <!-- <form method="post" enctype="multipart/form-data" action="/kontraktor/save"> -->
            <div class="container-fluid">
              <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Bon</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                  </div>
                </div>

                <!-- Bon Selection -->
                <div class="form-group">
                  <label for="jenis_bon">Jenis Bon</label>
                    <select name="bon[0][jenis_bon]" class="form-control">
                      <option value="">
                        Select an option
                      </option>
                      <option value="performance">
                        Performance Bond
                      </option>
                      <option value="wjp">
                        Wang Jaminan Pelaksanaan (WJP)
                      </option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="no_jaminan">No. Jaminan</label>
                  <input type="text" name="bon[0][no_jaminan]" class="form-control">
                </div>
                <div class="form-group">
                  <label for="no_pendaftaran_syarikat">No. Pendaftaran Syarikat</label>
                  <input type="text" name="bon[0][no_pendaftaran_syarikat]" class="form-control">
                </div>
                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="number" 
                    step="0.01"
                    min="0.00"
                    name="bon[0][jumlah]" 
                    id="jumlah" 
                    class="form-control" 
                    placeholder="Enter the total">
                </div>
                <div class="form-group">
                  <label for="tarikh_mula">Tarikh Mula</label>
                  <input type="date" name="bon[0][tarikh_mula]">
                </div>
                <div class="form-group">
                  <label for="tarikh_akhir">Tarikh Akhir</label>
                  <input type="date" name="bon[0][tarikh_akhir]">
                </div>
                <div>
                  <label for="status">Status</label>
                  <select name="bon[0][status]" class="form-control">
                    <option value="">- Select an option -</option>
                    <option value="asal">Asal</option>
                    <option value="lanjutan">Lanjutan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tarikh_asal">Tarikh Asal</label>
                  <input type="date" name="bon[0][tarikh_asal]">
                </div>
                <div class="form-group">
                  <label for="tarikh_lanjutan">Tarikh Lanjutan</label>
                  <input type="date" name="bon[0][tarikh_lanjutan]">
                </div>
            </div>
          </div>
        </div>
      </div>
        <div class="row">
          <div class="col-12">
            <a href="<?= site_url('/test/home') ?>" class="btn btn-secondary">Cancel</a>
            <a href="<?= site_url('/test/kontrak') ?>" class="btn btn-success float-right">Submit</a>
          </div>
        </div>
      <!-- </form> -->
    </section> <!-- /.content -->
  </section> <!-- /.content-wrapper -->

<?= $this->endSection() ?>