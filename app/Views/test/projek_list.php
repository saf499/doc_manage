<?= $this->extend('test/main') ?>

<?= $this->section('test/header') ?>
<section class="header">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Projek</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('/test/home') ?>">Home</a></li>
              <li class="breadcrumb-item active">Projek List</li>
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
      <!-- <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('success'); ?>
    </div>
      <?php elseif(session()->getFlashdata('error')): ?>
    <div class="alert alert-warning alert-dismissible">
      <?= session()->getFlashdata('error'); ?>
    </div>
    <?php endif; ?> -->


    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-3">
            <button type="button" class="btn btn-block btn-info">
              <a href="/test/projek_add" style="color:white;">
                Create new Projek
              </a>
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
                    <th style="width: 25%">Nama Projek</th>
                    <th style="width: 20%">Nama Pemohon</th>
                    <th>Progres Projek</th>
                    <th style="width: 10%" class="text-center">Status Projek</th>
                    <th style="width: 20%"></th>
                </tr>
            </thead>
            <tbody>
                <!-- Mock Row 1 -->
                <tr>
                    <td><a href="/test/projek_detail">101</a></td>
                    <td>
                        <a>Naiktaraf Bangunan FSKTM</a><br/>
                        <small>Created at: 12 Mac 2025</small>
                    </td>
                    <td>Amiruddin Bin Salleh</td>
                    <td>3/28</td>
                    <td class="project-state">
                        <span class="badge badge-info">Dalam Proses</span>
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>

                <!-- Mock Row 2 -->
                <tr>
                    <td><a href="/test/projek_detail">102</a></td>
                    <td>
                        <a>Projek ICT Baru 2025</a><br/>
                        <small>Created at: 27 Jan 2025</small>
                    </td>
                    <td>Noraini Binti Haji Ghazali</td>
                    <td>14/28</td>
                    <td class="project-state">
                        <span class="badge badge-warning">Sedang Jalan</span>
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>

                <!-- Mock Row 3 -->
                <tr>
                    <td><a href="/test/projek_detail">103</a></td>
                    <td>
                        <a>Penyelenggaraan Dewan Kuliah Utama</a><br/>
                        <small>Created at: 5 Feb 2025</small>
                    </td>
                    <td>Siti Nurhaliza Binti Rosli</td>
                    <td>23/28</td>
                    <td class="project-state">
                        <span class="badge badge-success">Hampir Siap</span>
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
      <!-- /.card -->
  </section>

<?= $this->endSection() ?>