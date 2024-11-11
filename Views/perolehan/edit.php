<?= $this->include('layout/header'); ?>


<body>
    <h2>Edit Perolehan</h2>

    <?php if(session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('errors') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('perolehan/update/' . $perolehan['perolehan_id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <script src="<?= base_url('js/ifhasdoc.js') ?>"></script>
        
        <div class="form-group">
            <label for="projek_id">Nama Projek: </label>
            <?php if (isset($projek['nama_projek'])): ?>
                <input type="text" class="form-control" value="<?= $projek['nama_projek'] ?>" readonly>
                <input type="hidden" name="projek_id" value="<?= $projek['projek_id'] ?>">
            <?php else: ?>
                <p class="text-danger">Projek not found</p>
            <?php endif; ?>
        </div>


        <div class="form-group">
            <label for="keputusan">Keputusan JKSU/LP</label>
            <select name="keputusan" class="form-control" required>
                <option value="lulus">Lulus</option>
                <option value="lulus bersyarat">Lulus Bersyarat</option>
                <option value="ditolak">Ditolak</option>
            </select>
        </div>

        <div class="form-group">
            <label for="jenis_perolehan">Jenis Perolehan</label>
            <select name="jenis_perolehan" class="form-control" required>
                <option value="sebutharga">Sebutharga</option>
                <option value="tender">Perolehan Tender</option>
                <option value="rfp">Request For Proposal</option>
            </select>
        </div>

        <div class="form-group">
            <label for="jenis_projek">Jenis Projek</label>
            <select name="jenis_projek" class="form-control" required>
                <option value="one-off">One-off</option>
                <option value="berkala">Berkala</option>
            </select>
        </div>

        <div class="form-group" id="docCh">
            <label for="lukisan_tender">Ada dokumen yang perlu disertakan?</label>
            <div>
                <input type="radio" name="lukisan_tender" value="1" id="yes" <?= set_value('lukisan_tender', $perolehan['lukisan_tender']) == 1 ? 'checked' : '' ?>>Yes
                <input type="radio" name="lukisan_tender" value="0" id="no" <?= set_value('lukisan_tender', $perolehan['lukisan_tender']) == 0 ? 'checked' : '' ?>>No
            </div>
        </div>

        <div class="form-group" id="document-upload" style="display: none;">
            <label for="lukisan_tender_file">Upload File: </label>
            <input type="file" name="lukisan_tender_file" class="form-control">
        </div>

        <h3>Lampiran Fail Hijau</h3>

        <div class="form-group">
            <label for="ro_pindaan">R.O Pindaan 7: </label>
            <input type="file" name="ro_pindaan" class="form-control">
        </div>

        <div>
            <label for="kertas_kerja">Kertas Kerja: </label>
            <input type="file" name="kertas_kerja" class="form-control">
        </div>

        <div>
            <label for="borang_47a_47b">Borang 47a dan 47b: </label>
            <input type="file" name="borang_47a_47b" class="form-control">
        </div>

        <div>
            <label for="tapak">Laporan Pemantauan Tapak: </label>
            <input type="file" name="tapak" class="form-control">
        </div>

        <div>
            <label for="pelan projek">Pelan Projek: </label>
            <input type="file" name="pelan_projek" class="form-control">
        </div>

        <div>
            <label for="kuantiti">Senarai Kuantiti: </label>
            <input type="file" name="kuantiti" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <a href="<?= site_url('perolehan') ?>">Back to List</a>

</body>

<?= $this->include('layout/footer'); ?>
