<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
<section class="header">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
           <h1 class="m-0">Kemaskini Kontraktor</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('kontraktor/index') ?>">Kontraktor</a></li>
            <li class="breadcrumb-item">Kemaskini Kontraktor</li>
          </ol>
        </div> <!-- /.col -->
      </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
  </div> <!-- /.header -->
</section>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <!-- Main content -->
   <section class="content">
    <form method="post" enctype="multipart/form-data" action="<?= site_url('kontraktor/update/' . $SPK_KONTRAKTOR['KONTRAKTOR_ID']) ?>">
      <?= csrf_field() ?>
      <div class="row">
        <div class="col-md-6">
          <div class="container-fluid">
            <div class="card card-primary">
              <div class="card-header"><h3 class="card-title">Maklumat Kontraktor</h3></div>
              <div class="card-body">
                <div class="form-group">
                  <label for="NAMA_SYARIKAT">Nama Syarikat</label>
                  <input type="text" name="NAMA_SYARIKAT"
                  value="<?= set_value('NAMA_SYARIKAT', $SPK_KONTRAKTOR['NAMA_SYARIKAT'] ?? '') ?>" 
                  class="form-control">
                </div>
                <div class="form-group">
                  <label for="ALAMAT">Alamat Syarikat</label>
                  <textarea name="ALAMAT" class="form-control" rows="3" placeholder="Alamat syarikat anda"><?= set_value('ALAMAT', $SPK_KONTRAKTOR['ALAMAT'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                  <label for="NO_PHONE">Nombor Telefon</label>
                  <input type="text" name="NO_PHONE"
                  value="<?= set_value('NO_PHONE', $SPK_KONTRAKTOR['NO_PHONE'] ?? '') ?>"
                  class="form-control">
                </div>
                <div class="form-group">
                  <label for="NO_SYARIKAT">Nombor Syarikat</label>
                  <input type="text" name="NO_SYARIKAT" 
                  value="<?= set_value('NO_SYARIKAT', $SPK_KONTRAKTOR['NO_SYARIKAT'] ?? '') ?>" 
                  class="form-control">
                </div>
                <div class="form-group">
                  <label for="NO_FAX">Nombor Fax</label>
                  <input type="text" name="NO_FAX" 
                  value="<?= set_value('NO_FAX', $SPK_KONTRAKTOR['NO_FAX'] ?? '') ?>"
                  placeholder="no fax syarikat anda" class="form-control">
                </div>
                <div class="form-group">
                  <label for="JENIS_KONTRAKTOR">Jenis Kontraktor</label>
                  <select name="JENIS_KONTRAKTOR" class="form-control">
                    <option value="">-- Select an option --</option>
                    <option value="utama"
                    <?= set_select('JENIS_KONTRAKTOR', 'utama', ($SPK_KONTRAKTOR['JENIS_KONTRAKTOR'] ?? '') === 'utama'); ?>>
                      Kontraktor Utama
                    </option>
                    <option value="subkontraktor"
                    <?= set_select('JENIS_KONTRAKTOR', 'subkontraktor', ($SPK_KONTRAKTOR['JENIS_KONTRAKTOR'] ?? '') === 'subkontraktor'); ?>>
                    Subkontraktor</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="container-fluid">
            <div class="card card-secondary">
              <div class="card-header"><h3 class="card-title">Dokumen</h3></div>
              <div class="card-body">

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        
      </div>
    </form>
   </section>
</section>
<?= $this->endSection() ?>