<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
<section class="header">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Projek</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Projek</li>
              <li class="breadcrumb-item active">Archive</li>
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
      <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('success'); ?>
    </div>
      <?php elseif(session()->getFlashdata('error')): ?>
    <div class="alert alert-warning alert-dismissible">
      <?= session()->getFlashdata('error'); ?>
    </div>
    <?php endif; ?>


    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-3">
            <h2>Senarai Projek yang telah diarkibkan</h2>
            <a href="<?= site_url('projek') ?>" class="btn btn-primary">Kembali ke Senarai Projek</a>
          </div>
        </div>
      </div>

      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        ID
                    </th>
                    <th style="width: 30%">
                        Nama Projek
                    </th>
                    <th style="width: 20%">
                        Nama Pemohon
                    </th>
                    <th style="width: 8%" class="text-center">
                        Status Projek
                    </th>
                    <th style="width: 8%" class="text-center">Tarikh Diarkibkan</th>
                    <th style="width: 20%">
                        Tindakan
                    </th>
                </tr>
            </thead>
            <tbody>
              <?php if(empty($SPK_PROJEK)): ?>
                  <tr>
                      <td colspan="5" class="text-center">Tiada projek yang diarkibkan.</td>
                  </tr>
                <?php else: ?>
                  <?php foreach ($SPK_PROJEK as $p): ?>
                  <tr>
                    <td>
                      <a href="<?= site_url('projek/show/' . $p['PROJEK_ID']) ?>"><?= $p['PROJEK_ID'] ?></a>
                    </td>
                    <td>
                        <a>
                          <?= $p['NAMA_PROJEK'] ?>
                        </a>
                        <br/>
                        <small>
                          Created at: <?= $p['REG_DATE'] ?>
                        </small>
                    </td>
                    <td>
                      <?= $p['NAMA_PEMOHON'] ?>
                    </td>
                    <td class="project-state">
                        <span class="badge badge-success" ><?= $p['STATUS_PROJEK'] ?></span>
                    </td>
                    <td>
                        <?php 
                        // Format tarikh utk paparan yg lebih mesra pengguna
                        try {
                            $archivedAt = new DateTime($p['ARCHIVED_AT']);
                            echo $archivedAt->format('d/m/Y H:i:s');
                        } catch (\Exception $e) {
                            echo esc($p['ARCHIVED_AT']); // Papar tarikh asal jika format tidak sah
                        }
                         ?>
                    </td>
                    <td class="project-actions text-right">
                      <a class="btn btn-info btn-sm" href="<?= site_url('projek/edit/'.$p['PROJEK_ID']) ?>" class="btn btn-warning">
                        <i class="fas fa-pencil-alt">
                        </i>
                      </a>
                      <!-- Gunakan borang untuk tindakan post (lebih selamat) -->
                        <form action="<?= site_url('projek/unarchive/'.$p['PROJEK_ID']) ?>" method="post" class ="d-inline">
                          <?= csrf_field() ?>
                          <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Adakah anda yakin untuk membuka arkib projek ini?');">
                            <i class="fas fa-undo"></i> Nyaharkib
                          </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
      <!-- /.card -->
  </section>

<?= $this->endSection() ?>

<!-- Pastikan anda memuatkan Font Awesome jika ingin menggunakan ikon -->
<!-- Contoh: <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> -->
<!-- Pastikan anda memuatkan Bootstrap JS jika ingin menggunakan fungsi 'alert dismissible' -->
<!-- Contoh: <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->