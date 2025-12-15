<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
  <section class="header">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Kemaskini Projek</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Projek</li>
                <li class="breadcrumb-item active">Projek Edit</li>
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
            <form method="post" action="<?= site_url('projek/update/' . $projek['projek_id']) ?>">
              <div class="form-group">
                <label for="nama_projek">Nama Projek</label>
                <input type="text" name="nama_projek" 
                value="<?= set_value('nama_projek'), $projek['nama_projek'] ?>" 
                class="form-control" required>
              </div>
              <div class="form-group">
                <label for="nama_pemohon">Nama Pemohon</label>
                <input type="text" name="nama_pemohon" 
                value="<?= set_value('nama_pemohon'), $projek['nama_pemohon'] ?>"
                class="form-control" required>
              </div>
              <div class="form-group">
                <label for="no_kontrak">No Kontrak</label>
                <input type="text" name="no_kontrak" 
                value="<?= set_value('no_kontrak'), $projek['no_kontrak'] ?>"
                class="form-control">
              </div>
              <div class="form-group">
                <label>Anggaran Kos: RM</label>
                <input type="number" 
                  step="0.01"
                  min="0.00" 
                  name="anggaran_kos" 
                  id="anggaran_kos"
                  value="<?= set_value('anggaran_kos'), $projek['anggaran_kos'] ?>" 
                  class="form-control" 
                  placeholder="Enter the cost estimate">
              </div>
              <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type = "number"
                  name = "tahun" id = "tahun" 
                  min = "1900" max = "2999" 
                  step = "1" class = "form-control"
                  value="<?= set_value('tahun'), $projek['tahun'] ?>">
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
                <option value="">Select an option</option>
                <option value="d.e" 
                    <?= set_select('sumber_peruntukan', 'd.e', ($projek['sumber_peruntukan'] ?? '') === 'd.e'); ?>>
                    D.E
                </option>
                <option value="rezab" 
                    <?= set_select('sumber_peruntukan', 'rezab', ($projek['sumber_peruntukan'] ?? '') === 'rezab'); ?>>
                    Rezab
                </option>
                <option value="mengurus" 
                    <?= set_select('sumber_peruntukan', 'mengurus', ($projek['sumber_peruntukan'] ?? '') === 'mengurus'); ?>>
                    Mengurus
                </option>
                <option value="lain-lain" 
                    <?= set_select('sumber_peruntukan', 'lain-lain', ($projek['sumber_peruntukan'] ?? '') === 'lain-lain'); ?>>
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
                  <option value="perkhidmatan"
                    <?= set_select('jenis_kontrak', 'perkhidmatan', ($projek['jenis_kontrak'] ?? '') === 'perkhidmatan'); ?>>
                    Perkhidmatan
                  </option>
                  <option value="bekalan"
                    <?= set_select('jenis_kontrak', 'bekalan', ($projek['jenis_kontrak'] ?? '') === 'bekalan'); ?>>
                    Bekalan
                  </option>
                  <option value="kerja"
                    <?= set_select('jenis_kontrak', 'kerja', ($projek['jenis_kontrak'] ?? '') === 'kerja'); ?>>
                    Kerja
                  </option>
                </select>
              </div>
              <div>
                <label for="status_projek">Status Projek</label>
                <select name="status_projek" class="form-control">
                    <option value="perancangan"
                        <?= set_select('status_projek', 'perancangan', ($projek['status_projek'] ?? '') === 'perancangan'); ?>>
                        Perancangan
                    </option>
                    <option value="aktif"
                        <?= set_select('status_projek', 'aktif', ($projek['status_projek'] ?? '') === 'aktif'); ?>>
                        Aktif
                    </option>
                    <option value="KIV"
                        <?= set_select('status_projek', 'KIV', ($projek['status_projek'] ?? '') === 'KIV'); ?>>
                        K.I.V
                    </option>
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
          <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </div>
      </div>
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->
  </section>

<?= $this->endSection() ?>