<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
<section class="header">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Senarai Kontrak</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Kontrak</li>
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
    </div>

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-3">
                    <a href="<?= site_url('kontrak/create') ?>" class="btn btn-block btn-info">
                        Assign Contractor
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
					<th style="width: 5%">ID</th>
					<th style="width: 35%">Nama Projek</th>
					<th style="width: 15%">Kontraktor Utama</th>
					<th style="width: 10%" class="text-center">Status</th>
					<th style="width: 35%">Tindakan</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(empty($kontrak)): ?>
                        <tr>
							<td colspan="5" class="text-center">Tiada kontrak yang dijumpai</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($kontrak as $k) : ?>
                            <tr>
								<td><?= $k['ID'] ?></td>
								<td>
									<?= $k['NAMA_PROJEK'] ?><br/>
									<small>Projek ID: <?= $k['PROJEK_ID'] ?></small>
								</td>
								<td><?= $k['NAMA_SYARIKAT'] ?></td>
								<td class="project-state text-center">
									<span class="badge badge-success">Aktif</span>
								</td>
								<td class="project-actions text-right">
									<a href="<?= site_url('insurans?kontrak_id=' . $k['ID']) ?>" class="btn btn-sm btn-info">
										<i class="fas fa-shield-alt"></i> Insurans
									</a>
									<a href="<?= site_url('bon?kontrak_id=' . $k['ID']) ?>" class="btn btn-sm btn-warning">
										<i class="fas fa-file-invoice"></i> Bon
									</a>
									<a href="<?= site_url('kontrak/edit/' . $k['ID']) ?>" class="btn btn-sm btn-primary">
										<i class="fas fa-pencil-alt"></i> Edit
									</a>
									<a href="<?= site_url('kontrak/delete/' . $k['ID']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Padam kontrak ini?')">
										<i class="fas fa-trash"></i> Padam
									</a>
								</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
