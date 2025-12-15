
<?= $this->extend('test/main') ?>
<?= $this->section('test/header') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Sistem Pengurusan Kontrak</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/test/home">Home</a></li>
          <li class="breadcrumb-item"><a href="/test/projek">Perolehan</a></li>
          <li class="breadcrumb-item"><a href="/test/projek_add">Perolehan Add</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
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
            <!-- <form method="post" enctype="multipart/form-data" action="/perolehan/store"> -->
                <script src="<?= base_url('js/ifhasdoc.js') ?>"></script>

                <div class="form-group">
                    <label for="keputusan">Keputusan JKSU/LP</label>
                    <select name="keputusan" class="form-control">
                        <option value="">- Select an option -</option>
                        <option value="lulus">Lulus</option>
                        <option value="lulus bersyarat">Lulus Bersyarat</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis_perolehan">Jenis Perolehan</label>
                    <select name="jenis_perolehan" class="form-control">
                        <option value="">- Select an option -</option>
                        <option value="sebutharga">Sebutharga</option>
                        <option value="tender">Perolehan Tender</option>
                        <option value="rfp">Request For Proposal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis_projek">Jenis Projek: </label>
                    <select name="jenis_projek" class="form-control">
                        <option value="">- Select an option -</option>
                        <option value="one-off">One-off</option>
                        <option value="berkala">Berkala</option>
                    </select>
                </div>
                <div class="form-group" id="docCh">
                    <label for="lukisan_tender">Ada dokumen lukisan tender yang perlu disertakan?</label>
                    <div>
                        <input type="radio" name="lukisan_tender" value="1" id="yes" <?= set_value('lukisan_tender') == 1 ? 'checked' : '' ?>>Yes
                        <input type="radio" name="lukisan_tender" value="0" id="no" <?= set_value('lukisan_tender') == 0 ? 'checked' : '' ?>>No
                    </div>
                </div>

                <div class="form-group" id="document-upload" style="display: none;">
                    <label for="lukisan_tender_file">Lukisan Tender: </label>
                    <input type="file" name="lukisan_tender_file" class="form-control">
                </div>

                <div class="form-group">
                    <label for="dokumen_meja_tender">Dokumen Meja Tender: </label>
                    <input type="file" name="dokumen_meja_tender" class="form-control">
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
            </div>
            <div class="col-md-6">
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Lampiran Fail Hijau</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="ro_pindaan">R.O Pindaan 7: </label>
                        <input type="file" class="form-control" name="ro_pindaan">
                    </div>

                    <div>
                        <label for="kertas_kerja">Kertas Kerja: </label>
                        <input type="file" name="kertas_kerja" class="form-control">
                    </div>

                    <div>
                        <label for="borang_47a_47b">Borang 47a dan 47b: </label>
                        <input type="file" name="borang_47a_47b" class="form-control">
                    </div>

                    <div>
                        <label for="tapak">Laporan Pemantauan Tapak: </label>
                        <input type="file" name="tapak" class="form-control">
                    </div>

                    <div>
                        <label for="pelan projek">Pelan Projek: </label>
                        <input type="file" name="pelan_projek" class="form-control">
                    </div>

                    <div>
                        <label for="kuantiti">Senarai Kuantiti: </label>
                        <input type="file" name="kuantiti" class="form-control">
                    </div>

                    <!-- Repeat for other files -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <a href="<?= site_url('/test/home') ?>" class="btn btn-secondary">Cancel</a>
            <a href="<?= site_url('/test/projek_list') ?>" class="btn btn-success float-right">Submit</a>
            </div>
        </div>
    <!-- </form> -->
        </section>
        <!-- /.content -->
    <!-- /.content-wrapper -->
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->


<?= $this->endSection() ?>