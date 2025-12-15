<?= $this->include('layout/header'); ?>


<body>
    <h2>Edit Perolehan</h2>

    <?php if(session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('errors') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('perolehan/update/' . $perolehan['PEROLEHAN_ID']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <script src="<?= base_url('js/ifhasdoc.js') ?>"></script>
        
        <div class="form-group">
            <label for="projek_id">Nama Projek: </label>
            <?php if (isset($projek['NAMA_PROJEK'])): ?>
                <input type="text" class="form-control" value="<?= $projek['NAMA_PROJEK'] ?>" readonly>
                <input type="hidden" name="projek_id" value="<?= $projek['PROJEK_ID'] ?>">
            <?php else: ?>
                <p class="text-danger">Projek not found</p>
            <?php endif; ?>
        </div>


        <div class="form-group">
            <label for="KEPUTUSAN">Keputusan JKSU/LP</label>
            <select name="KEPUTUSAN" class="form-control" required>
                <option value="lulus" <?= set_value('KEPUTUSAN', $perolehan['KEPUTUSAN']) == 'lulus' ? 'selected' : '' ?>>Lulus</option>
                <option value="lulus bersyarat" <?= set_value('KEPUTUSAN', $perolehan['KEPUTUSAN']) == 'lulus bersyarat' ? 'selected' : '' ?>>Lulus Bersyarat</option>
                <option value="ditolak" <?= set_value('KEPUTUSAN', $perolehan['KEPUTUSAN']) == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
            </select>
        </div>

        <div class="form-group">
            <label for="JENIS_PEROLEHAN">Jenis Perolehan</label>
            <select name="JENIS_PEROLEHAN" class="form-control" required>
                <option value="sebutharga" <?= set_value('JENIS_PEROLEHAN', $perolehan['JENIS_PEROLEHAN']) == 'sebutharga' ? 'selected' : '' ?>>Sebutharga</option>
                <option value="tender" <?= set_value('JENIS_PEROLEHAN', $perolehan['JENIS_PEROLEHAN']) == 'tender' ? 'selected' : '' ?>>Perolehan Tender</option>
                <option value="rfp" <?= set_value('JENIS_PEROLEHAN', $perolehan['JENIS_PEROLEHAN']) == 'rfp' ? 'selected' : '' ?>>Request For Proposal</option>
            </select>
        </div>

        <div class="form-group">
            <label for="JENIS_PROJEK">Jenis Projek</label>
            <select name="JENIS_PROJEK" class="form-control" required>
                <option value="one-off" <?= set_value('JENIS_PROJEK', $perolehan['JENIS_PROJEK']) == 'one-off' ? 'selected' : '' ?>>One-off</option>
                <option value="berkala" <?= set_value('JENIS_PROJEK', $perolehan['JENIS_PROJEK']) == 'berkala' ? 'selected' : '' ?>>Berkala</option>
            </select>
        </div>

        <div class="form-group" id="docCh">
            <label for="LUKISAN_TENDER">Ada dokumen yang perlu disertakan?</label>
            <div>
                <input type="radio" name="LUKISAN_TENDER" value="1" id="yes" <?= set_value('LUKISAN_TENDER', $perolehan['LUKISAN_TENDER']) == 1 ? 'checked' : '' ?>>Yes
                <input type="radio" name="LUKISAN_TENDER" value="0" id="no" <?= set_value('LUKISAN_TENDER', $perolehan['LUKISAN_TENDER']) == 0 ? 'checked' : '' ?>>No
            </div>
        </div>

        <div class="form-group" id="document-upload" style="display: none;">
            <label for="LUKISAN_TENDER_FILE">Upload File: </label>
            <input type="file" name="LUKISAN_TENDER_FILE" class="form-control">
        </div>

        <h3>Lampiran Fail Hijau</h3>

        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="RO_PINDAAN">R.O Pindaan 7: </label>
            <input type="file" name="RO_PINDAAN" class="form-control">
        </div>

        <div>
            <label for="KERTAS_KERJA">Kertas Kerja: </label>
            <input type="file" name="KERTAS_KERJA" class="form-control">
        </div>

        <div>
            <label for="BORANG_47A_47B">Borang 47a dan 47b: </label>
            <input type="file" name="BORANG_47A_47B" class="form-control">
        </div>

        <div>
            <label for="TAPAK">Laporan Pemantauan Tapak: </label>
            <input type="file" name="TAPAK" class="form-control">
        </div>

        <div>
            <label for="PELAN PROJEK">Pelan Projek: </label>
            <input type="file" name="PELAN_PROJEK" class="form-control">
        </div>

        <div>
            <label for="KUANTITI">Senarai Kuantiti: </label>
            <input type="file" name="KUANTITI" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <a href="<?= site_url('projek') ?>">Back to Projek</a>

</body>

<?= $this->include('layout/footer'); ?>
