<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
  <section class="header">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Isi Kandungan Projek dan Perolehan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
              <li class="breadcrumb-item">Projek</li>
              <li class="breadcrumb-item active">Isi Kandungan Projek</li>
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
      <div class="card"> <!-- Default box -->
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
          <?php if (isset($SPK_PROJEK)): ?>
            <div class="row">
              <div class="info-box bg-light">
                <div class="info-box-content">
                  <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                      <div class="col-12 col-sm-4">
                        <p><strong>Projek ID:</strong> <?= $SPK_PROJEK['PROJEK_ID'] ?></p>
                        <p><strong>Nama Projek:</strong> <?= $SPK_PROJEK['NAMA_PROJEK'] ?></p>
                        <p><strong>Nama Pemohon:</strong> <?= $SPK_PROJEK['NAMA_PEMOHON'] ?></p>
                        <p><strong>No Kontrak:</strong> <?= $SPK_PROJEK['NO_KONTRAK'] ?></p>
                        <p><strong>Jenis Kontrak:</strong> <?= $SPK_PROJEK['JENIS_KONTRAK'] ?></p>
                        <p><strong>Tahun:</strong> <?= $SPK_PROJEK['TAHUN'] ?></p>
                        <p><strong>Sumber Peruntukan:</strong> <?= $SPK_PROJEK['SUMBER_PERUNTUKAN'] ?></p>
                        <p><strong>Status: </strong><?= $SPK_PROJEK['STATUS_PROJEK'] ?></p>
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
                        <span class="info-box-number text-muted mb-0"><?= $SPK_PROJEK['ANGGARAN_KOS'] ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-muted">Tarikh Daftar</span>
                        <span class="info-box-number text-muted mb-0"><?= $SPK_PROJEK['REG_DATE'] ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-muted">Status Projek</span>
                        <span class="info-box-number text-muted mb-0"><?= $SPK_PROJEK['STATUS_PROJEK'] ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php if (empty($SPK_PEROLEHAN)): ?>
              <div class="mb-3">
                <a href="<?= site_url('perolehan/create/' . $SPK_PROJEK['PROJEK_ID']) ?>" class="btn btn-primary">
                  Tambah Perolehan
                </a>
              </div>
            <?php else: ?>
              <div class="card"><!-- Card 2 open -->
                <div class="card-header">
                  <h3 class="card-title">Perolehan Detail</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                      <div class="row">
                        <div class="col-12 col-sm-4">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-muted">Perolehan ID:</span>
                              <span class="info-box-number text-muted mb-0"><?= $SPK_PEROLEHAN['PEROLEHAN_ID'] ?></span>
                              <span class="info-box-text text-muted">Projek ID:</span>
                              <span class="info-box-number text-muted mb-0"><?= $SPK_PEROLEHAN['PROJEK_ID'] ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-4">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-muted">Keputusan JKSU/LP:</span>
                              <span class="info-box-number text-muted mb-0"><?= $SPK_PEROLEHAN['KEPUTUSAN'] ?></span>
                              <span class="info-box-text text-muted">Jenis Perolehan:</span>
                              <span class="info-box-number text-muted mb-0"><?= $SPK_PEROLEHAN['JENIS_PEROLEHAN'] ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-4">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-muted">Jenis Projek:</span>
                              <span class="info-box-number text-muted mb-0"><?= $SPK_PEROLEHAN['JENIS_PROJEK'] ?></span>
                              <span class="info-box-text text-muted">Lukisan Tender:</span>
                              <span class="info-box-number text-muted mb-0"><?= $SPK_PEROLEHAN['LUKISAN_TENDER'] ?></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="info-box-content">
                    <h5 class="mt-5 text-muted">Project files</h5>
                    <table>
                      <tr>
                        <th>Jenis Fail</th>
                        <th>Nama Fail</th>
                        <th>Tindakan</th>
                      </tr>
                      <?php if (!empty($SPK_PEROLEHAN['LUKISAN_TENDER_FILE'])): ?>
                      <tr>
                        <th>Dokumen Lukisan Tender</th>
                        <td>
                          <a href="<?= base_url('upload/perolehan/' . $SPK_PEROLEHAN['LUKISAN_TENDER_FILE']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $SPK_PEROLEHAN['LUKISAN_TENDER_FILE'] ?></a>
                        </td>
                        <td>Delete</td>
                      </tr>
                      <?php endif; ?>
                      <?php if (!empty($SPK_PEROLEHAN['DOKUMEN_MEJA_TENDER'])): ?>
                      <tr>
                        <th>Dokumen Meja Tender</th>
                        <td>
                          <a href="<?= base_url('upload/perolehan/' . $SPK_PEROLEHAN['DOKUMEN_MEJA_TENDER']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $SPK_PEROLEHAN['DOKUMEN_MEJA_TENDER'] ?></a>
                        </td>
                        <td>Delete</td>
                      </tr>
                      <?php endif; ?>
                      <?php if (!empty($SPK_PEROLEHAN['RO_PINDAAN'])): ?>
                      <tr>
                        <th>R.O Pindaan 7</th>
                        <td>
                          <a href="<?= base_url('upload/perolehan/' . $SPK_PEROLEHAN['RO_PINDAAN']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $SPK_PEROLEHAN['RO_PINDAAN'] ?></a>
                        </td>
                        <td>Delete</td>
                      </tr>
                      <?php endif; ?>
                      <?php if (!empty($SPK_PEROLEHAN['KERTAS_KERJA'])): ?>
                      <tr>
                        <th>Kertas Kerja</th>
                        <td>
                          <a href="<?= base_url('upload/perolehan/' . $SPK_PEROLEHAN['KERTAS_KERJA']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $SPK_PEROLEHAN['KERTAS_KERJA'] ?></a>
                        </td>
                        <td>Delete</td>
                      </tr>
                      <?php endif; ?>
                      <?php if (!empty($SPK_PEROLEHAN['BORANG_47A_47B'])): ?>
                      <tr>
                        <th>Borang 47a dan 47b</th>
                        <td>
                          <a href="<?= base_url('upload/perolehan/' . $SPK_PEROLEHAN['BORANG_47A_47B']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $SPK_PEROLEHAN['BORANG_47A_47B'] ?></a>
                        </td>
                        <td>Delete</td>
                      </tr>
                      <?php endif; ?>
                      <?php if (!empty($SPK_PEROLEHAN['TAPAK'])): ?>
                      <tr>
                        <th>Laporan Pemantauan Tapak</th>
                        <td>
                          <a href="<?= base_url('upload/perolehan/' . $SPK_PEROLEHAN['TAPAK']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $SPK_PEROLEHAN['TAPAK'] ?></a>
                        </td>
                        <td>Delete</td>
                      </tr>
                      <?php endif; ?>
                      <?php if (!empty($SPK_PEROLEHAN['PELAN_PROJEK'])): ?>
                      <tr>
                        <th>Pelan Projek</th>
                        <td>
                          <a href="<?= base_url('upload/perolehan/' . $SPK_PEROLEHAN['PELAN_PROJEK']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $SPK_PEROLEHAN['PELAN_PROJEK'] ?></a>
                        </td>
                        <td>Delete</td>
                      </tr>
                      <?php endif; ?>
                      <?php if (!empty($SPK_PEROLEHAN['KUANTITI'])): ?>
                      <tr>
                        <th>Senarai Kuantiti</th>
                        <td>
                          <a href="<?= base_url('upload/perolehan/' . $SPK_PEROLEHAN['KUANTITI']) ?>" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> <?= $SPK_PEROLEHAN['KUANTITI'] ?></a>
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
                              <span class="info-box-number text-center text-muted mb-0"><?= $SPK_PEROLEHAN['REG_DATE'] ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-4">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Kemaskini</span>
                              <span class="info-box-number text-center text-muted mb-0"><?= $SPK_PEROLEHAN['UPDATE_DATE'] ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <a href="<?= site_url('perolehan/edit/' . $SPK_PEROLEHAN['PEROLEHAN_ID']) ?>" class="btn btn-warning">
                            Edit Perolehan
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <span class="info-box-text text-center text-muted">Projek tidak ditemui</span>
          <?php endif; ?>
        </div>
      </div><!-- Card 1 close -->
    </div>
  </section>
<?= $this->endSection() ?>