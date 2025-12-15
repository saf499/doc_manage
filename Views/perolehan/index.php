<?= $this->include('layout/header'); ?>

<div class="container">
    <h2>Senarai Perolehan</h2>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <a href="/perolehan/create">Daftar Perolehan Baru</a>

    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Projek</th>
                <th>Keputusan JKSU/LP</th>
                <th>Jenis Perolehan</th>
                <th>Jenis Projek</th>
                <th>Dibuat Pada</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($perolehan as $p): ?>
            <tr>
                <td><a href="<?= site_url('perolehan/show/' . $p['perolehan_id']) ?>"><?= $p['perolehan_id'] ?></a></td>
                <td><?= $p['projek_id'] ?></td>
                <td><?= $p['keputusan'] ?></td>
                <td><?= $p['jenis_perolehan'] ?></td>
                <td><?= $p['jenis_projek'] ?></td>
                <td><?= $p['created_at'] ?></td>
                <td>
                    <a href="<?= site_url('perolehan/edit/'.$p['perolehan_id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= site_url('perolehan/delete/'.$p['perolehan_id']) ?>"class="btn btn-danger"
                    onclick="return confirm('Are you sure you want to delete this project?');">Delete</a><br/>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>