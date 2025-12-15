<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
  <section class="header">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Kemaskini Bon</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('bon') ?>">Bon</a></li>
                <li class="breadcrumb-item active">Edit Bon</li>
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
            <form method="post" action="/bon/update/<?= $bon['bon_id'] ?>" enctype="multipart/form-data">
              <div id="bon-entries">
                    
                <input type="hidden" name="bon_id" value="<?= $bon['bon_id']; ?>">

                <div class="form-group">
                  <label for="jenis_bon">Jenis Bon</label>
                    <select name="jenis_bon" class="form-control">
                      <option value="">Select an option</option>
                      <option value="performance" <?= ($bon['jenis_bon'] == 'performance') ? 'selected' : '' ?>>
                        Performance Bond
                      </option>
                      <option value="wjp" <?= ($bon['jenis_bon'] == 'wjp') ? 'selected' : '' ?>>
                        Wang Jaminan Pelaksanaan (WJP)
                      </option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="no_jaminan">No. Jaminan</label>
                  <input type="text" name="no_jaminan" class="form-control" value="<?= $bon['no_jaminan'] ?? '' ?>">
                </div>
                <div class="form-group">
                  <label for="no_pendaftaran_syarikat">No. Pendaftaran Syarikat</label>
                  <input type="text" name="no_pendaftaran_syarikat" class="form-control" value="<?= $bon['no_pendaftaran_syarikat'] ?? '' ?>">
                </div>
                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="number" 
                    step="0.01"
                    min="0.00"
                    name="jumlah" 
                    id="jumlah" 
                    class="form-control" 
                    placeholder="Enter the total"
                    value="<?= $bon['jumlah'] ?? '' ?>">
                </div>
                <div class="form-group">
                  <label for="tarikh_mula">Tarikh Mula</label>
                  <input type="date" name="tarikh_mula" value="<?= $bon['tarikh_mula'] ?? '' ?>">
                </div>
                <div class="form-group">
                  <label for="tarikh_akhir">Tarikh Akhir</label>
                  <input type="date" name="tarikh_akhir" value="<?= $bon['tarikh_akhir'] ?? '' ?>">
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" class="form-control">
                    <option value="">- Select an option -</option>
                    <option value="asal" <?= ($bon['status'] == 'asal') ? 'selected' : '' ?>>Asal</option>
                    <option value="lanjutan" <?= ($bon['status'] == 'lanjutan') ? 'selected' : '' ?>>Lanjutan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tarikh_asal">Tarikh Asal</label>
                  <input type="date" name="tarikh_asal" value="<?= $bon['tarikh_asal'] ?? '' ?>">
                </div>
                <div class="form-group">
                  <label for="tarikh_lanjutan">Tarikh Lanjutan</label>
                  <input type="date" name="tarikh_lanjutan" value="<?= $bon['tarikh_lanjutan'] ?? '' ?>">
                </div>
                <div class="form-group">
                  <label for="bon_file">Fail Bon (PDF)</label>
                  <input type="file" name="bon_file" class="form-control" accept=".pdf">
                  <?php if(!empty($bon['bon_file'])): ?>
                    <small class="form-text text-muted">
                      Fail semasa: <?= $bon['bon_file'] ?>
                    </small>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Maklumat Projek</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <?php if(isset($projek)): ?>
                <div class="form-group">
                  <label>ID Projek</label>
                  <input type="text" class="form-control" value="<?= $projek['PROJEK_ID'] ?? 'N/A' ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Nama Projek</label>
                  <input type="text" class="form-control" value="<?= $projek['NAMA_PROJEK'] ?? 'N/A' ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Nama Pemohon</label>
                  <input type="text" class="form-control" value="<?= $projek['NAMA_PEMOHON'] ?? 'N/A' ?>" readonly>
                </div>
              <?php else: ?>
                <div class="alert alert-info">
                  Maklumat projek tidak tersedia
                </div>
              <?php endif; ?>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="<?= site_url('/bon') ?>" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Update" class="btn btn-success float-right">
        </div>
      </div>
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->
  </section>

<?= $this->endSection() ?>

