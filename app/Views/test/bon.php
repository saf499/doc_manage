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
              <li class="breadcrumb-item active">Senarai Bon</li>
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
          <a href="/test/bon_add" style="color:white;">Tambah Bon</a>
        </button>
      </div>
    </div>
  </div>

<div class="card">
  <div class="card-body p-0">
    <table class="table table-striped projects">
      <thead>
        <tr>
          <th style="width: 10%">No. Bon</th>
          <th style="width: 25%">Jenis</th>
          <th style="width: 15%">Nilai (RM)</th>
          <th style="width: 15%">Tarikh Tamat</th>
          <th style="width: 10%" class="text-center">Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- Row 1 -->
        <tr>
          <td>B001</td>
          <td>Performance Bond</td>
          <td>500,000.00</td>
          <td>30/06/2024</td>
          <td class="project-state text-center">
            <span class="badge badge-warning">Akan Tamat</span>
          </td>
        </tr>

        <!-- Row 2 -->
        <tr>
          <td>B002</td>
          <td>Wang Jaminan Pelaksanaan (WJP)</td>
          <td>74,000.00</td>
          <td>13 Feb 2025</td>
          <td class="project-state text-center">
            <span class="badge badge-warning">Dalam Proses</span>
          </td>
        </tr>

        <!-- Row 3 -->
        <tr>
          <td>B003</td>
          <td>Wang Jaminan Pelaksanaan (WJP)</td>
          <td>250,000.00</td>
          <td>10 Mac 2025</td>
          <td class="project-state text-center">
            <span class="badge badge-secondary">Tamat</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

      <!-- /.card -->
  </section>

<?= $this->endSection() ?>