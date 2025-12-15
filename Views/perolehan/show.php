<html>
<head>
    <title>Perolehan Details</title>
</head>
<body>
    <h2>Perolehan Details</h2>

    <table>
        <tr>
            <th>ID:</th>
            <td><?= $perolehan['perolehan_id'] ?></td>
        </tr>
        <tr>
            <th>Nama Projek:</th>
            <td><?= $perolehan['projek_id'] ?></td>
        </tr>
        <tr>
            <th>Keputusan JKSU/LP:</th>
            <td><?= $perolehan['keputusan'] ?></td>
        </tr>
        <tr>
            <th>Jenis Perolehan:</th>
            <td><?= $perolehan['jenis_perolehan'] ?></td>
        </tr>
        <tr>
            <th>Jenis Projek:</th>
            <td><?= $perolehan['jenis_projek'] ?></td>
        </tr>
        <tr>
            <th>Lukisan Tender</th>
            <td><?= $perolehan['lukisan_tender'] ?></td>
        </tr>
    </table>

    <h2>Dokumen Lampiran</h2>
    <table>
        <tr>
            <th>Jenis Fail</th>
            <th>Nama Fail</th>
            <th>Tindakan</th>
        </tr>

        <?php if (!empty($perolehan['lukisan_tender_file'])): ?>
        <tr>
            <th>Dokumen Lukisan Tender</th>
            <td><?= $perolehan['lukisan_tender_file'] ?></td>
            <td>
                <a href="<?= base_url('upload/perolehan/' . $perolehan['projek_id'] . '/' . $perolehan['lukisan_tender_file']) ?>" target="_blank">View / Download</a>
            </td>
        </tr>
        <?php endif; ?>

        <?php if (!empty($perolehan['dokumen_meja_tender'])): ?>
        <tr>
            <th>Dokumen Meja Tender</th>
            <td><?= $perolehan['dokumen_meja_tender'] ?></td>
            <td>
                <a href="<?= base_url('upload/perolehan/' . $perolehan['projek_id'] . '/' . $perolehan['dokumen_meja_tender']) ?>" target="_blank">View / Download</a>
            </td>
        </tr>
        <?php endif; ?>

        <?php if (!empty($perolehan['ro_pindaan'])): ?>
        <tr>
            <th>R.O Pindaan 7</th>
            <td><?= $perolehan['ro_pindaan'] ?></td>
            <td>
                <a href="<?= base_url('upload/perolehan/' . $perolehan['projek_id'] . '/' . $perolehan['ro_pindaan']) ?>" target="_blank">View / Download</a>
            </td>
        </tr>
        <?php endif; ?>

        <?php if (!empty($perolehan['kertas_kerja'])): ?>
        <tr>
            <th>Kertas Kerja</th>
            <td><?= $perolehan['kertas_kerja'] ?></td>
            <td>
                <a href="<?= base_url('upload/perolehan/' . $perolehan['projek_id'] . '/' . $perolehan['kertas_kerja']) ?>" target="_blank">View / Download</a>
            </td>
        </tr>
        <?php endif; ?>

        <?php if (!empty($perolehan['borang_47a_47b'])): ?>
        <tr>
            <th>Borang 47a dan 47b</th>
            <td><?= $perolehan['borang_47a_47b'] ?></td>
            <td>
                <a href="<?= base_url('upload/perolehan/' . $perolehan['projek_id'] . '/' . $perolehan['borang_47a_47b']) ?>" target="_blank">View / Download</a>
            </td>
        </tr>
        <?php endif; ?>

        <?php if (!empty($perolehan['tapak'])): ?>
        <tr>
            <th>Laporan Pemantauan Tapak</th>
            <td><?= $perolehan['tapak'] ?></td>
            <td>
                <a href="<?= base_url('upload/perolehan/' . $perolehan['projek_id'] . '/' . $perolehan['tapak']) ?>" target="_blank">View / Download</a>
            </td>
        </tr>
        <?php endif; ?>

        <?php if (!empty($perolehan['pelan_projek'])): ?>
        <tr>
            <th>Pelan Projek</th>
            <td><?= $perolehan['pelan_projek'] ?></td>
            <td>
                <a href="<?= base_url('upload/perolehan/' . $perolehan['projek_id'] . '/' . $perolehan['pelan_projek']) ?>" target="_blank">View / Download</a>
            </td>
        </tr>
        <?php endif; ?>

        <?php if (!empty($perolehan['kuantiti'])): ?>
        <tr>
            <th>Senarai Kuantiti</th>
            <td><?= $perolehan['kuantiti'] ?></td>
            <td>
                <a href="<?= base_url('upload/perolehan/' . $perolehan['projek_id'] . '/' . $perolehan['kuantiti']) ?>" target="_blank">View / Download</a>
            </td>
        </tr>
        <?php endif; ?>

        <tr>
            <th>Dibuat Pada:</th>
            <td><?= $perolehan['created_at'] ?></td>
        </tr>

        <tr>
            <th>Kemaskini</th>
            <td><?= $perolehan['updated_at'] ?></td>
        </tr>

        <!-- Add more fields as needed -->
    </table>
    <a href="<?= site_url('projek/edit/'.$perolehan['perolehan_id']) ?>" class="btn btn-warning">Edit</a>
    <a href="<?= site_url('perolehan/delete/'.$perolehan['perolehan_id']) ?>"class="btn btn-danger"
            onclick="return confirm('Are you sure you want to delete this project?');">Delete</a><br/>
    <a href="<?= site_url('perolehan') ?>">Back to List</a>
</body>
</html>
