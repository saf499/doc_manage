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
              <a href="/projek/create" style="color:white;">
                Create new Projek
              </a>
            </button>
          </div>
          <div class="col-3">
            <button type="button" class="btn btn-block btn-info">
              <a href="<?= site_url('/projek/archived') ?>" style="color:white;">
                <i class="fas fa-archive"></i> Lihat Arkib
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
                    <th style="width: 1%">
                        ID
                    </th>
                    <th style="width: 20%">
                        Nama Projek
                    </th>
                    <th style="width: 30%">
                        Nama Pemohon
                    </th>
                    <th style="width: 8%" class="text-center">
                        Status Projek
                    </th>
                    <th style="width: 20%">
                    </th>
                </tr>
            </thead>
            <tbody>
              <?php if(empty($SPK_PROJEK)): ?>
                  <tr>
                      <td colspan="5" class="text-center">Tiada projek yang dijumpai</td>
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
                    <td class="project-actions text-right">
                      <a class="btn btn-info btn-sm" href="<?= site_url('projek/edit/'.$p['PROJEK_ID']) ?>" class="btn btn-warning">
                        <i class="fas fa-pencil-alt">
                        </i>
                      </a>
                      <form action="<?= site_url('projek/archive/' . $p['PROJEK_ID']) ?>" method="post" class="d-inline">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Anda pasti ingin mengarkibkan projek ini?')">
                            <i class="fas fa-archive"></i> Arkib
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