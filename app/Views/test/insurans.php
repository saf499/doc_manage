<?= $this->extend('test/main') ?>

<?= $this->section('test/header') ?>
<section class="header">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pengurusan Insurans</h1> <!-- Ubah tajuk -->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('/test/home') ?>">Home</a></li>
            <li class="breadcrumb-item active">Senarai Insurans</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('test/content') ?>
<section class="section">
  <div class="section-body">
    <!-- Notifikasi -->
    <?php if(session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php elseif(session()->getFlashdata('error')): ?>
      <div class="alert alert-warning alert-dismissible"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <!-- Card Utama -->
    <div class="card">
      <div class="card-header">
        <!-- Search Form -->
        <div class="row mb-3">
          <div class="col-md-4">
            <select class="form-control select2" id="filter-projek">
              <option value="">Cari mengikut Projek</option>
              <option value="101">Naiktaraf Bangunan FSKTM</option>
              <option value="102">Projek ICT Baru 2025</option>
            </select>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder="No. Polisi..." id="search-polis">
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
          </div>
        </div>

        <!-- Button Tambah -->
        <div class="row">
          <div class="col-3">
            <a href="/test/insurans_add" class="btn btn-info">
              <i class="fas fa-plus"></i> Tambah Insurans
            </a>
          </div>
        </div>
      </div>

      <!-- Table -->
      <div class="card-body p-0">
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th>No. Polisi</th>
              <th>Projek</th>
              <th>Kontraktor</th>
              <th>Jenis Insurans</th>
              <th>Nilai (RM)</th>
              <th>Tarikh Tamat</th>
              <th>Status</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            <!-- Contoh Data Insurans -->
            <tr>
              <td>POL-001</td>
              <td>Naiktaraf Bangunan FSKTM</td>
              <td>Tech Berjaya Engineering</td>
              <td>All-Risk</td>
              <td>1,000,000.00</td>
              <td>12/02/2025</td>
              <td>
                <span class="badge badge-success">Aktif</span>
                <small class="text-muted d-block">(Tamat dalam 45 hari)</small>
              </td>
              <td>
                <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
              </td>
            </tr>

            <tr>
              <td>POL-002</td>
              <td>Projek ICT Baru 2025</td>
              <td>Harapan Sdn Bhd</td>
              <td>LIAB</td>
              <td>500,000.00</td>
              <td>05/01/2024</td>
              <td>
                <span class="badge badge-danger">Tamat</span>
              </td>
              <td>
                <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>