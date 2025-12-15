<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
<section class="header">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Bon</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Bon</li>
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
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php endif; ?>
      <?php if(session()->getFlashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-3">
            <button type="button" class="btn btn-block btn-info">
              <a href="<?= site_url('projek') ?>" style="color:white;">
                <i class="fas fa-plus"></i> Tambah Bon Baru
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
                    <th style="width: 5%">
                        ID
                    </th>
                    <th style="width: 20%">
                        Nama Projek
                    </th>
                    <th style="width: 15%">
                        Jenis Bon
                    </th>
                    <th style="width: 15%">
                        No. Jaminan
                    </th>
                    <th style="width: 10%">
                        Jumlah
                    </th>
                    <th style="width: 10%">
                        Status
                    </th>
                    <th style="width: 15%">
                        Tarikh Mula
                    </th>
                    <th style="width: 10%">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
              <?php if(empty($bonData)): ?>
                  <tr>
                      <td colspan="8" class="text-center">Tiada bon yang dijumpai</td>
                  </tr>
                <?php else: ?>
                  <?php foreach ($bonData as $bon): ?>
                  <tr>
                    <td>
                      <?= $bon['bon_id'] ?>
                    </td>
                    <td>
                      <a href="<?= site_url('projek/show/' . $bon['kontrak_id']) ?>">
                        <?= $bon['NAMA_PROJEK'] ?? 'N/A' ?>
                      </a>
                      <br>
                      <small class="text-muted">
                        <?= $bon['NAMA_PEMOHON'] ?? 'N/A' ?>
                      </small>
                    </td>
                    <td>
                      <?php 
                        $jenisBon = '';
                        switch($bon['jenis_bon']) {
                          case 'performance':
                            $jenisBon = 'Performance Bond';
                            break;
                          case 'wjp':
                            $jenisBon = 'Wang Jaminan Pelaksanaan (WJP)';
                            break;
                          default:
                            $jenisBon = $bon['jenis_bon'] ?? 'N/A';
                        }
                      ?>
                      <?= $jenisBon ?>
                    </td>
                    <td>
                      <?= $bon['no_jaminan'] ?? 'N/A' ?>
                    </td>
                    <td>
                      <?php if($bon['jumlah']): ?>
                        RM <?= number_format($bon['jumlah'], 2) ?>
                      <?php else: ?>
                        N/A
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php 
                        $statusClass = '';
                        $statusText = '';
                        switch($bon['status']) {
                          case 'asal':
                            $statusClass = 'badge badge-success';
                            $statusText = 'Asal';
                            break;
                          case 'lanjutan':
                            $statusClass = 'badge badge-warning';
                            $statusText = 'Lanjutan';
                            break;
                          default:
                            $statusClass = 'badge badge-secondary';
                            $statusText = $bon['status'] ?? 'N/A';
                        }
                      ?>
                      <span class="<?= $statusClass ?>"><?= $statusText ?></span>
                    </td>
                    <td>
                      <?php if($bon['tarikh_mula']): ?>
                        <?= date('d/m/Y', strtotime($bon['tarikh_mula'])) ?>
                      <?php else: ?>
                        N/A
                      <?php endif; ?>
                    </td>
                    <td class="project-actions text-right">
                      <a class="btn btn-info btn-sm" href="<?= site_url('bon/edit/' . $bon['bon_id']) ?>">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a class="btn btn-danger btn-sm" href="<?= site_url('bon/delete/' . $bon['bon_id']) ?>" 
                         onclick="return confirm('Adakah anda pasti mahu memadamkan bon ini?')">
                        <i class="fas fa-trash"></i>
                      </a>
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
