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
    <?php endif; ?>


    <!-- Default box -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Projects</h3>

          <div>
            <button type="button" class="btn btn-block btn-info">Add</button>
          </div>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          ID
                      </th>
                      <th style="width: 20%">
                          Nama Projek
                      </th>
                      <th style="width: 30%">
                          Nama Pemohon
                      </th>
                      <th>
                          Progres Projek
                      </th>
                      <th style="width: 8%" class="text-center">
                          Status Projek
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php if(empty($projek)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Tiada projek yang dijumpai</td>
                    </tr>
                 <?php else: ?>
                    <?php foreach ($projek as $p): ?>
                    <tr>
                      <td>
                        <a href="<?= site_url('projek/show/' . $p['projek_id']) ?>"><?= $p['projek_id'] ?></a>
                      </td>
                      <td>
                          <a>
                            <?= $p['nama_projek'] ?>
                          </a>
                          <br/>
                          <small>
                            Created at: <?= $p['reg_date'] ?>
                          </small>
                      </td>
                      <td>
                        <?= $p['nama_pemohon'] ?>
                      </td>
                      <td class="project_progress">
                          <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                              </div>
                          </div>
                          <small>
                              57% Complete
                          </small>
                      </td>
                      <td class="project-state">
                          <span class="badge badge-success" ><?= $p['status_projek'] ?></span>
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="<?= site_url('projek/edit/'.$p['projek_id']) ?>" class="btn btn-warning">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="<?= site_url('projek/delete/'.$p['projek_id']) ?>"
                          onclick="return confirm('Are you sure you want to delete this project?');">
                              <i class="fas fa-trash">
                              </i>
                              Delete
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