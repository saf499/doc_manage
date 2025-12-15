<?= $this->extend('test/main') ?>

<?= $this->section('test/header') ?>
<section class="header">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kontraktor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('/test/home') ?>">Home</a></li>
              <li class="breadcrumb-item active">Kontraktor List</li>
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
          <a href="/test/kontraktor_add" style="color:white;">Create New Kontraktor</a>
        </button>
      </div>
    </div>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 5%">ID</th>
                <th style="width: 25%">Nama Syarikat</th>
                <th style="width: 20%">No Syarikat</th>
                <th>Jenis Kontraktor</th>
                <th style="width: 10%" class="text-center">Status</th>
                <th style="width: 20%"></th>
            </tr>
        </thead>
        <tbody>
            <!-- Mock Row 1 -->
            <tr>
                <td><a href="/test/kontraktor_detail">K001</a></td>
                <td>
                    <a>Sykt Pembinaan Harapan Sdn Bhd</a><br/>
                    <small>Tarikh Mula: 01 Jan 2025</small>
                </td>
                <td>1234567-T</td>
                <td>Utama</td>
                <td class="project-state text-center">
                    <span class="badge badge-success">Aktif</span>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
                </td>
            </tr>

            <!-- Mock Row 2 -->
            <tr>
                <td><a href="/test/kontraktor_detail">K002</a></td>
                <td>
                    <a>Tech Berjaya Engineering</a><br/>
                    <small>Tarikh Mula: 12 Feb 2025</small>
                </td>
                <td>768234-X</td>
                <td>Sub</td>
                <td class="project-state text-center">
                    <span class="badge badge-warning">Tangguh</span>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
                </td>
            </tr>

            <!-- Mock Row 3 -->
            <tr>
                <td><a href="/test/kontraktor_detail">K003</a></td>
                <td>
                    <a>ProMega Holdings</a><br/>
                    <small>Tarikh Mula: 20 Mac 2025</small>
                </td>
                <td>998812-A</td>
                <td>Utama</td>
                <td class="project-state text-center">
                    <span class="badge badge-danger">Blacklist</span>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
  </div>
</div>

      <!-- /.card -->
  </section>

<?= $this->endSection() ?>