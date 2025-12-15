<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
  <section class="header">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Perolehan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Perolehan</li>
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
                      <th>
                          ID
                      </th>
                      <th>
                          Nama Projek
                      </th>
                      <th>
                          Keputusan JKSU/LP
                      </th>
                      <th>
                          Jenis Perolehan
                      </th>
                      <th>
                          Jenis Projek
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php if(empty($perolehan)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Tiada perolehan yang dijumpai</td>
                    </tr>
                 <?php else: ?>
                    <?php foreach ($perolehan as $p): ?>
                    <tr>
                      <td>
                        <a href="<?= site_url('perolehan/show/' . $p['perolehan_id']) ?>"><?= $p['perolehan_id'] ?></a>
                        <br/>
                        <small>
                        Created at: <?= $p['created_at'] ?>
                        </small>
                      </td>
                      <td>
                        <a><?= $p['projek_id'] ?></a>
                      </td>
                      <td>
                        <?= $p['keputusan'] ?>
                      </td>
                      <td>
                        <?= $p['jenis_perolehan'] ?>
                      </td>
                      <td>
                        <?= $p['jenis_projek'] ?>
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