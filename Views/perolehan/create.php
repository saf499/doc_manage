<form method="post" enctype="multipart/form-data" action="/perolehan/store">
    <script src="<?= base_url('js/ifhasdoc.js') ?>"></script>
    <h2>Pendaftaran Perolehan</h2>
        <?= csrf_field() ?>

        <!-- Hidden projek_id field-->
        <input type="hidden" name="projek_id" value="<?= $projek_id ?>">

        <div class="form-group">
            <label for="keputusan">Keputusan JKSU/LP: </label>
            <select name="keputusan" class="form-control" required>
                <option value="lulus">Lulus</option>
                <option value="lulus bersyarat">Lulus Bersyarat</option>
                <option value="ditolak">Ditolak</option>
            </select>
        </div>

        <div class="form-group">
            <label for="jenis_perolehan">Jenis Perolehan: </label>
            <select name="jenis_perolehan" class="form-control" required>
                <option value="sebutharga">Sebutharga</option>
                <option value="tender">Perolehan Tender</option>
                <option value="rfp">Request For Proposal</option>
            </select>
        </div>

        <div class="form-group">
            <label for="jenis_projek">Jenis Projek: </label>
            <select name="jenis_projek" class="form-control" required>
                <option value="one-off">One-off</option>
                <option value="berkala">Berkala</option>
            </select>
        </div>

        <div class="form-group" id="docCh">
            <label for="lukisan_tender">Ada dokumen lukisan tender yang perlu disertakan?</label>
            <div>
                <input type="radio" name="lukisan_tender" value="1" id="yes" <?= set_value('lukisan_tender') == 1 ? 'checked' : '' ?>>Yes
                <input type="radio" name="lukisan_tender" value="0" id="no" <?= set_value('lukisan_tender') == 0 ? 'checked' : '' ?>>No
            </div>
        </div>

        <div class="form-group" id="document-upload" style="display: none;">
            <label for="lukisan_tender_file">Lukisan Tender: </label>
            <input type="file" name="lukisan_tender_file" class="form-control">
        </div>

        <div class="form-group">
            <label for="dokumen_meja_tender">Dokumen Meja Tender: </label>
            <input type="file" name="dokumen_meja_tender" class="form-control">
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

        <!-- Repeat for other files -->
        
        <button type="submit" name="save" class="btn btn-secondary">Save</button>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>

</form>
