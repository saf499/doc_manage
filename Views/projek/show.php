<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
  <section class="header">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Projek Detail</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                <li class="breadcrumb-item">Projek</li>
                <li class="breadcrumb-item active">Projek Detail</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
  </section>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="section">
    <div class="section-body">
        <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Projects Detail</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <?php if (isset($projek)): ?>
            <div class="row">
              <div class="info-box bg-light">
                <div class="info-box-content">
                  <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                      <div class="col-12 col-sm-4">
                        <span class="info-box-text text-muted">Projek ID:</span>
                        <span class="info-box-number text-muted mb-0"><?= $projek['projek_id'] ?></span>
                        <span class="info-box-text text-muted">Nama Projek:</span>
                        <p><strong>Nama Projek:</strong> <?= $projek['nama_projek'] ?></p>
                        <p><strong>Nama Pemohon:</strong> <?= $projek['nama_pemohon'] ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                      <div class="col-12 col-sm-4">
                        <p><strong>No Kontrak:</strong> <?= $projek['no_kontrak'] ?></p>
                        <p><strong>Jenis Kontrak:</strong> <?= $projek['jenis_kontrak'] ?></p>
                        <p><strong>Tahun:</strong> <?= $projek['tahun'] ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                      <div class="col-12 col-sm-4">
                        <p><strong>Sumber Peruntukan:</strong> <?= $projek['sumber_peruntukan'] ?></p>
                        <p><strong>Status: </strong><?= $projek['status'] ?></p>

                    <!-- Add other fields here -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
          <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
            <div class="row">
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-muted">Anggaran kos</span>
                    <span class="info-box-number text-muted mb-0"><?= $projek['anggaran_kos'] ?></span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-muted">Tarikh Daftar</span>
                    <span class="info-box-number text-muted mb-0"><?= $projek['reg_date'] ?></span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-muted">Status Projek</span>
                    <span class="info-box-number text-muted mb-0"><?= $projek['status_projek'] ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php else: ?>
            <span class="info-box-text text-center text-muted">Projek tidak ditemui</span>
        <?php endif; ?>
        </div>
        </div>
      </div>  

    <div class="card">
      <div class="card-header">
      <h3 class="card-title">Perolehan Detail</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
        <?php if (isset($perolehan)): ?>
          <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
            <div class="row">
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-muted">Perolehan ID:</span>
                    <span class="info-box-number text-muted mb-0"><?= $perolehan['perolehan_id'] ?></span>
                    <span class="info-box-text text-muted">Projek ID:</span>
                    <span class="info-box-number text-muted mb-0"><?= $perolehan['projek_id'] ?></span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-muted">Keputusan JKSU/LP:</span>
                    <span class="info-box-number text-muted mb-0"><?= $perolehan['keputusan'] ?></span>
                    <span class="info-box-text text-muted">Jenis Perolehan:</span>
                    <span class="info-box-number text-muted mb-0"><?= $perolehan['jenis_perolehan'] ?></span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-muted">Jenis Projek:</span>
                    <span class="info-box-number text-muted mb-0"><?= $perolehan['jenis_projek'] ?></span>
                    <span class="info-box-text text-muted">Lukisan Tender:</span>
                    <span class="info-box-number text-muted mb-0"><?= $perolehan['lukisan_tender'] ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php else: ?>
            <span class="info-box-text text-center text-muted">Projek tidak ditemui</span>
        <?php endif; ?>
        </div>

        <div class="info-box-content">
        <h5 class="mt-5 text-muted">Project files</h5>
          <table>
            <tr>
              <th>Jenis Fail</th>
              <th>Nama Fail</th>
              <th>Tindakan</th>
            </tr>

            <?php if (!empty($perolehan['lukisan_tender_file'])): ?>
            <tr>
              <th>Dokumen Lukisan Tender</th>
              <td>
                <a href="<?= base_url('upload/perolehan/' . $perolehan['lukisan_tender_file']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $perolehan['lukisan_tender_file'] ?></a>
              </td>
              <td>Delete</td>
            </tr>
            <?php endif; ?>
            
            <?php if (!empty($perolehan['dokumen_meja_tender'])): ?>
            <tr>
              <th>Dokumen Meja Tender</th>
                <td>
                  <a href="<?= base_url('upload/perolehan/' . $perolehan['dokumen_meja_tender']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $perolehan['dokumen_meja_tender'] ?></a>
                </td>
                <td>Delete</td>
            </tr>
            <?php endif; ?>

            <?php if (!empty($perolehan['ro_pindaan'])): ?>
              <tr>
                <th>R.O Pindaan 7</th>
                <td>
                  <a href="<?= base_url('upload/perolehan/' . $perolehan['ro_pindaan']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $perolehan['ro_pindaan'] ?></a>
                </td>
                <td>Delete</td>
              </tr>
            <?php endif; ?>
                      
            <?php if (!empty($perolehan['kertas_kerja'])): ?>
              <tr>
                <th>Kertas Kerja</th>
                <td>
                  <a href="<?= base_url('upload/perolehan/' . $perolehan['kertas_kerja']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $perolehan['kertas_kerja'] ?></a>
                </td>
                <td>Delete</td>
              </tr>
            <?php endif; ?>

            <?php if (!empty($perolehan['borang_47a_47b'])): ?>
              <tr>
                <th>Borang 47a dan 47b</th>
                <td>
                  <a href="<?= base_url('upload/perolehan/' . $perolehan['borang_47a_47b']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $perolehan['borang_47a_47b'] ?></a>
                </td>
                <td>Delete</td>
              </tr>
            <?php endif; ?>

            <?php if (!empty($perolehan['tapak'])): ?>
              <tr>
                <th>Laporan Pemantauan Tapak</th>
                <td>
                  <a href="<?= base_url('upload/perolehan/' . $perolehan['tapak']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $perolehan['tapak'] ?></a>
                </td>
                <td>Delete</td>
              </tr>
            <?php endif; ?>

            <?php if (!empty($perolehan['pelan_projek'])): ?>
              <tr>
                <th>Pelan Projek</th>
                <td>
                  <a href="<?= base_url('upload/perolehan/' . $perolehan['pelan_projek']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $perolehan['pelan_projek'] ?></a>
                </td>
                <td>Delete</td>
              </tr>
            <?php endif; ?>

            <?php if (!empty($perolehan['kuantiti'])): ?>
              <tr>
                <th>Senarai Kuantiti</th>
                <td>
                  <a href="<?= base_url('upload/perolehan/' . $perolehan['kuantiti']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $perolehan['kuantiti'] ?></a>
                </td>
                <td>Delete</td>
              </tr>
            <?php endif; ?>

          </table>
          </div>
          <br>

          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Dibuat Pada</span>
                      <span class="info-box-number text-center text-muted mb-0"><?= $perolehan['created_at'] ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Kemaskini</span>
                      <span class="info-box-number text-center text-muted mb-0"><?= $perolehan['updated_at'] ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="card">
      <div class="card-header">
          <h3 class="card-title">Actions</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="info-box bg-light">
            <div class="info-box-content">
                    <!-- jQuery -->
                    <script src="<?= base_url() ?>template/plugins/jquery/jquery.min.js"></script>
                    <!-- Bootstrap 4 -->
                    <script src="<?= base_url() ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <!-- jsGrid -->
                    <script src="<?= base_url() ?>template/plugins/jsgrid/demos/db.js"></script>
                    <script src="<?= base_url() ?>template/plugins/jsgrid/jsgrid.min.js"></script>
                    <!-- AdminLTE App -->
                    <script src="<?= base_url() ?>template/dist/js/adminlte.min.js"></script>
                    <!-- AdminLTE for demo purposes -->
                    <script src="<?= base_url() ?>template/dist/js/demo.js"></script>
                    <!-- Page specific script -->
                    <script>
                    $(function () {
                        $("#jsGrid1").jsGrid({
                            height: "100%",
                            width: "100%",

                            sorting: true,
                            paging: true,

                            data: db.clients,

                            fields: [
                                { name: "Name", type: "text", width: 150 },
                                { name: "Age", type: "number", width: 50 },
                                { name: "Address", type: "text", width: 200 },
                                { name: "Country", type: "select", items: db.countries, valueField: "Id", textField: "Name" },
                                { name: "Married", type: "checkbox", title: "Is Married" }
                            ]
                        });
                    });
                    </script>
                </div>
            </div>
          </div>
        </div>  
    </div>
    </div>

    </div>
  </section>
  <?= $this->endSection() ?>