<?= $this->extend('test/main') ?>

<?= $this->section('test/header') ?>
<section class="header">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kontrak</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('/test/home') ?>">Home</a></li>
              <li class="breadcrumb-item active">Kontrak List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('test/content') ?>
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

    <!-- Default box for Kontraktor -->
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-3">
        <button type="button" class="btn btn-block btn-info">
          <a href="/test/kontrak_add" style="color:white;">Create New Kontrak</a>
        </button>
      </div>
    </div>
  </div>

<div class="card">
  <div class="card-body p-0">
    <table class="table table-striped projects">
      <thead>
        <tr>
          <th style="width: 5%">ID</th>
          <th style="width: 35%">Nama Projek</th>
          <th style="width: 15%">Kontraktor Utama</th>
          <th style="width: 10%" class="text-center">Status</th>
          <th style="width: 30%"></th>
        </tr>
      </thead>
      <tbody>
        <!-- Row 1 -->
        <tr>
          <td>K001</td>
          <td>
            Naiktaraf Bangunan FSKTM<br/>
            <small>Projek ID: 101</small>
          </td>
          <td>Tech Berjaya Engineering (768234-X)</td>
          <td class="project-state text-center">
            <span class="badge badge-success">Aktif</span>
          </td>
          <td class="project-actions text-right">
            <a href="/test/insurans?kontrak_id=KONTRAK-001" class="btn btn-sm btn-info">
            <i class="fas fa-shield-alt"></i> Insurans
            </a>
            <a href="/test/bon?kontrak_id=KONTRAK-001" class="btn btn-sm btn-warning">
              <i class="fas fa-file-invoice"></i> Bon
            </a>
          </td>
        </tr>

        <!-- Row 2 -->
        <tr>
          <td>K002</td>
          <td>
            Projek ICT Baru 2025<br/>
            <small>Projek ID: 102</small>
          </td>
          <td>Harapan Sdn Bhd (1234567-T)</td>
          <td class="project-state text-center">
            <span class="badge badge-warning">Dalam Proses</span>
          </td>
          <td class="project-actions text-right">
            <a href="/test/insurans?kontrak_id=KONTRAK-001" class="btn btn-sm btn-info">
            <i class="fas fa-shield-alt"></i> Insurans
            </a>
            <a href="/test/bon?kontrak_id=KONTRAK-001" class="btn btn-sm btn-warning">
              <i class="fas fa-file-invoice"></i> Bon
            </a>
          </td>
        </tr>

        <!-- Row 3 -->
        <tr>
          <td>K003</td>
          <td>
            Penyelenggaraan Dewan Kuliah<br/>
            <small>Projek ID: 103</small>
          </td>
          <td>ProMega Holdings (998812-A)</td>
          <td class="project-state text-center">
            <span class="badge badge-secondary">Tamat</span>
          </td>
          <td class="project-actions text-right">
            <a href="/test/insurans?kontrak_id=KONTRAK-001" class="btn btn-sm btn-info">
            <i class="fas fa-shield-alt"></i> Insurans
            </a>
            <a href="/test/bon?kontrak_id=KONTRAK-001" class="btn btn-sm btn-warning">
              <i class="fas fa-file-invoice"></i> Bon
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

      <!-- /.card -->
  </section>

<?= $this->endSection() ?>