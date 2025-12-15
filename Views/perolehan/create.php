<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
  <section class="header">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Daftar Perolehan Baru</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Perolehan</li>
                <li class="breadcrumb-item active">Perolehan Add</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
  </section>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="section">
    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
    <?php endif; ?>
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
            <form method="post" enctype="multipart/form-data" action="<?= site_url('perolehan/store') ?>">
                <script src="<?= base_url('js/ifhasdoc.js') ?>"></script>

                <input type="hidden" name="PROJEK_ID" value="<?= $PROJEK_ID ?>">

                <div class="form-group">
                    <label for="KEPUTUSAN">Keputusan JKSU/LP</label>
                    <select name="KEPUTUSAN" class="form-control">
                        <option value="">- Select an option -</option>
                        <option value="lulus">Lulus</option>
                        <option value="lulus bersyarat">Lulus Bersyarat</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="JENIS_PEROLEHAN">Jenis Perolehan</label>
                    <select name="JENIS_PEROLEHAN" class="form-control">
                        <option value="">- Select an option -</option>
                        <option value="sebutharga">Sebutharga</option>
                        <option value="tender">Perolehan Tender</option>
                        <option value="rfp">Request For Proposal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="JENIS_PROJEK">Jenis Projek: </label>
                    <select name="JENIS_PROJEK" class="form-control">
                        <option value="">- Select an option -</option>
                        <option value="one-off">One-off</option>
                        <option value="berkala">Berkala</option>
                    </select>
                </div>
                <div class="form-group" id="docCh">
                    <label for="LUKISAN_TENDER">Ada dokumen lukisan tender yang perlu disertakan?</label>
                    <div>
                        <input type="radio" name="LUKISAN_TENDER" value="1" id="yes" <?= set_value('LUKISAN_TENDER') == 1 ? 'checked' : '' ?>>Yes
                        <input type="radio" name="LUKISAN_TENDER" value="0" id="no" <?= set_value('LUKISAN_TENDER') == 0 ? 'checked' : '' ?>>No
                    </div>
                </div>

                <div class="form-group" id="document-upload" style="display: none;">
                    <label for="LUKISAN_TENDER_FILE">Lukisan Tender: </label>
                    <input type="file" name="LUKISAN_TENDER_FILE" class="form-control">
                </div>

                <div class="form-group">
                    <label for="DOKUMEN_MEJA_TENDER">Dokumen Meja Tender: </label>
                    <input type="file" name="DOKUMEN_MEJA_TENDER" class="form-control">
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
                    <label for="RO_PINDAAN">R.O Pindaan 7: </label>
                    <input type="file" class="form-control" name="RO_PINDAAN">
                </div>

                <div>
                    <label for="KERTAS_KERJA">Kertas Kerja: </label>
                    <input type="file" name="KERTAS_KERJA" class="form-control">
                </div>

                <div>
                    <label for="BORANG_47A_47B">Borang 47a dan 47b: </label>
                    <input type="file" name="BORANG_47A_47B" class="form-control">
                </div>

                <div>
                    <label for="TAPAK">Laporan Pemantauan Tapak: </label>
                    <input type="file" name="TAPAK" class="form-control">
                </div>

                <div>
                    <label for="PELAN PROJEK">Pelan Projek: </label>
                    <input type="file" name="PELAN_PROJEK" class="form-control">
                </div>

                <div>
                    <label for="KUANTITI">Senarai Kuantiti: </label>
                    <input type="file" name="KUANTITI" class="form-control">
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
          <a href="<?= site_url('/home') ?>" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new Perolehan" class="btn btn-success float-right">
          <button type="button" onclick="testSubmit()" class="btn btn-info float-right mr-2">Test Submit (No Files)</button>
          </div>
      </div>
          </form>
          
          <script>
          function testSubmit() {
              // Create a simple form for testing without file uploads
              var form = document.createElement('form');
              form.method = 'POST';
              form.action = '<?= site_url('perolehan/testStore') ?>';
              
              var projekId = document.querySelector('input[name="PROJEK_ID"]').value;
              var keputusan = document.querySelector('select[name="KEPUTUSAN"]').value;
              var jenisPerolehan = document.querySelector('select[name="JENIS_PEROLEHAN"]').value;
              var jenisProjek = document.querySelector('select[name="JENIS_PROJEK"]').value;
              var lukisanTender = document.querySelector('input[name="LUKISAN_TENDER"]:checked') ? document.querySelector('input[name="LUKISAN_TENDER"]:checked').value : '';
              
              var inputs = [
                  {name: 'PROJEK_ID', value: projekId},
                  {name: 'KEPUTUSAN', value: keputusan},
                  {name: 'JENIS_PEROLEHAN', value: jenisPerolehan},
                  {name: 'JENIS_PROJEK', value: jenisProjek},
                  {name: 'LUKISAN_TENDER', value: lukisanTender}
              ];
              
              inputs.forEach(function(input) {
                  var hiddenInput = document.createElement('input');
                  hiddenInput.type = 'hidden';
                  hiddenInput.name = input.name;
                  hiddenInput.value = input.value;
                  form.appendChild(hiddenInput);
              });
              
              document.body.appendChild(form);
              form.submit();
          }
          </script>
    </section>
        <!-- /.content -->
    <!-- /.content-wrapper -->
  </section>

<?= $this->endSection() ?>
