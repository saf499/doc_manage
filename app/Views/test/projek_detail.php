<?= $this->extend('test/main') ?>

<?= $this->section('test/header') ?>
<section class="header">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Projek Detail</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
            <li class="breadcrumb-item">Projek</li>
            <li class="breadcrumb-item active">Projek Detail</li>
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
    <!-- Projek Info -->
    <div class="card mb-4">
      <div class="card-header">
        <h3 class="card-title">Projects Detail</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <p><strong>Projek ID:</strong> 101</p>
            <p><strong>Nama Projek:</strong> Naiktaraf Dewan Utama</p>
            <p><strong>Nama Pemohon:</strong> En. Ahmad Bin Ramli</p>
            <p><strong>No Kontrak:</strong> KONTRAK-2025-001</p>
            <p><strong>Jenis Kontrak:</strong> Kerja</p>
            <p><strong>Tahun:</strong> 2025</p>
            <p><strong>Sumber Peruntukan:</strong> Mengurus</p>
            <p><strong>Status:</strong> Dalam Proses</p>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-sm-4">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-muted">Anggaran Kos</span>
                <span class="info-box-number text-muted mb-0">RM 2,500,000.00</span>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-muted">Tarikh Daftar</span>
                <span class="info-box-number text-muted mb-0">2025-01-12</span>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-muted">Status Projek</span>
                <span class="info-box-number text-muted mb-0">Aktif</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Perolehan Info -->
    <div class="card mb-4">
      <div class="card-header">
        <h3 class="card-title">Perolehan Detail</h3>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-sm-4">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-muted">Perolehan ID</span>
                <span class="info-box-number text-muted mb-0">2001</span>
                <span class="info-box-text text-muted">Projek ID</span>
                <span class="info-box-number text-muted mb-0">101</span>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-muted">Keputusan JKSU</span>
                <span class="info-box-number text-muted mb-0">Lulus Bersyarat</span>
                <span class="info-box-text text-muted">Jenis Perolehan</span>
                <span class="info-box-number text-muted mb-0">Tender</span>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-muted">Jenis Projek</span>
                <span class="info-box-number text-muted mb-0">One-Off</span>
                <span class="info-box-text text-muted">Lukisan Tender</span>
                <span class="info-box-number text-muted mb-0">Ada</span>
              </div>
            </div>
          </div>
        </div>

        <!-- File List -->
        <h5 class="text-muted mt-4">Project Files</h5>
        <table class="table table-bordered table-sm">
          <thead class="thead-light">
            <tr>
              <th>Jenis Fail</th>
              <th>Nama Fail</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Dokumen Meja Tender</td>
              <td><i class="far fa-file-pdf"></i> meja_tender.pdf</td>
              <td><a href="#">View</a></td>
            </tr>
            <tr>
              <td>Kertas Kerja</td>
              <td><i class="far fa-file-pdf"></i> kertas_kerja.pdf</td>
              <td><a href="#">View</a></td>
            </tr>
            <tr>
              <td>Laporan Tapak</td>
              <td><i class="far fa-file-pdf"></i> laporan_tapak.pdf</td>
              <td><a href="#">View</a></td>
            </tr>
            <tr>
              <td>Senarai Kuantiti</td>
              <td><i class="far fa-file-pdf"></i> kuantiti.pdf</td>
              <td><a href="#">View</a></td>
            </tr>
          </tbody>
        </table>

        <!-- Timestamps -->
        <div class="row mt-3">
          <div class="col-sm-6">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-muted">Dibuat Pada</span>
                <span class="info-box-number text-muted mb-0">2025-01-14</span>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-muted">Kemaskini Terakhir</span>
                <span class="info-box-number text-muted mb-0">2025-01-16</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Actions Section -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Actions</h3>
      </div>
      <div class="card-body">
        <!-- You can put buttons or links here like "Edit Projek", "Tambah Perolehan", etc. -->
        <p class="text-muted">Tiada tindakan tersedia buat masa ini.</p>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
