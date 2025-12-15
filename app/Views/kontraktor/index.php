<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
<section class="header">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kontraktor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Kontraktor</li>
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
                    <a href="/kontraktor/create" style="color:white;">+ Kontraktor</a>
                </button>
            </div>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">ID</th>
                    <th style="width: 25%">Nama Syarikat</th>
                    <th style="width: 20%">No Syarikat</th>
                    <th>Jenis Kontraktor</th>
                    <th style="width: 20%"></th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($SPK_KONTRAKTOR)): ?>
                    <tr>
                        <td colspan="5" class="text-center">No data found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($SPK_KONTRAKTOR as $kontraktor): ?>
                        <tr>
                            <td><a href="/kontraktor/show/<?= $kontraktor['KONTRAKTOR_ID'] ?>"><?= $kontraktor['KONTRAKTOR_ID'] ?></a></td>
                            <td><?= $kontraktor['NAMA_SYARIKAT'] ?></td>
                            <td><?= $kontraktor['NO_SYARIKAT'] ?></td>
                            <td><?= $kontraktor['JENIS_KONTRAKTOR'] ?></td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="/kontraktor/edit/<?= $kontraktor['KONTRAKTOR_ID'] ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
                                <a class="btn btn-danger btn-sm" href="/kontraktor/delete/<?= $kontraktor['KONTRAKTOR_ID'] ?>"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>