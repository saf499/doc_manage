<?= $this->extend('test/main') ?>

<?= $this->section('test/header') ?>
<section class="header">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Assign Contractor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Kontrak</li>
              <li class="breadcrumb-item active">Kontrak Add</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

      <!-- bs-custom-file-input -->
<script src="<?= base_url() ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<link rel="stylesheet" href="<?= base_url() ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
</section>

<style>
  .kontraktor-badge {
    display: inline-flex;
    align-items: center;
    margin: 3px;
    padding: 8px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 20px;
  }
  .kontraktor-badge .role-tag {
    background: #007bff;
    color: white;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.8em;
    margin-right: 8px;
  }
</style>

<?= $this->endSection() ?>

<?= $this->section('test/content') ?>
<section class="section">
  <!-- ... (same notifications) ... -->

  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Kontrak Baru</h3>
      </div>

      <!-- Projek Selection -->
      <div class="card-body">
        <div class="form-group">
          <label>Pilih Projek</label>
          <select class="form-control">
            <option>101 - Naiktaraf Bangunan FSKTM</option>
            <option>102 - Projek ICT Baru 2025</option>
          </select>
        </div>

        <!-- Assigned Contractors -->
        <div class="form-group">
          <label>Kontraktor Yang Ditetapkan</label>
          <div id="assigned-kontraktor" class="p-3 border rounded">
            <!-- Contoh Kontraktor Utama -->
            <div class="kontraktor-badge">
              <span class="role-tag">Utama</span>
              Tech Berjaya Engineering (768234-X)
              <button class="btn btn-sm btn-link text-danger ml-2">×</button>
            </div>

            <!-- Contoh Kontraktor Sub -->
            <div class="kontraktor-badge">
              <span class="role-tag" style="background: #28a745;">Sub</span>
              Harapan Sdn Bhd (1234567-T)
              <button class="btn btn-sm btn-link text-danger ml-2">×</button>
            </div>
          </div>
        </div>

        <!-- Button Add Contractor -->
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#kontraktorModal">
          + Tambah Kontraktor
        </button>
      </div>
    </div>
    <div class="card card-secondary">
      <div class="card-header">
        <h3 class="card-title">Kontrak 2</h3>
      </div>
      <div class="form group">
        <label>Harga Kontrak</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">RM</span>
          </div>
          <input type="number" 
            step="0.01"
            min="0.00" 
            name="harga_kontrak" 
            id="harga_kontrak" 
            class="form-control" 
            placeholder="Enter the cost estimate">
          <div class="input-group-append">
            <span class="input-group-text">.00</span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>BLR</label>
        <div class="input-group mb-3">
          <input type="number" 
            step="0.01"
            min="0.00" 
            name="blr" 
            id="blr" 
            class="form-control" 
            placeholder="Enter the percent estimate">
          <div class="input-group-append">
            <span class="input-group-text">%</span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>LAD/Hari</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">RM</span>
          </div>
          <input type="number" 
            step="0.01"
            min="0.00" 
            name="lad" 
            id="lad" 
            class="form-control" 
            placeholder="Enter the cost estimate per day">
          <div class="input-group-append">
            <span class="input-group-text">.00</span>
          </div>
        </div>
      </div>
        <div class="form-group">
          <label for="tarikh_mula">Tarikh Mula</label>
          <input type="date" name="tarikh_mula">
        </div>
        <div class="form-group">
          <label for="tarikh_akhir"> Tarikh Akhir</label>
          <input type="date" name="tarikh_akhir">
        </div>
    </div>
      

  <!-- Kontraktor Modal -->
  <div class="modal fade" id="kontraktorModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pilih Kontraktor</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <!-- Role Tabs -->
          <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
              <a class="nav-link active" data-role="utama">Kontraktor Utama</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-role="sub">Sub-Kontraktor</a>
            </li>
          </ul>

          <!-- Contractor List -->
          <div class="kontraktor-list">
            <!-- Utama List -->
            <div data-role="utama">
              <div class="kontraktor-item">
                <input type="radio" name="kontraktor_utama" id="k1">
                <label for="k1">Tech Berjaya Engineering (768234-X)</label>
              </div>
            </div>

            <!-- Sub List (hidden by default) -->
            <div data-role="sub">
              <div class="kontraktor-item">
                <input type="checkbox" id="k2">
                <label for="k2">Harapan Sdn Bhd (1234567-T)</label>
              </div>
              <div class="kontraktor-item">
                <input type="checkbox" id="k3">
                <label for="k3">ProMega Holdings (998812-A)</label>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="addContractors()">Tambah</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Tab functionality
    $('[data-role]').hide();
    $('[data-role="utama"]').show();

    $('.nav-tabs a').click(function() {
      const role = $(this).data('role');
      $('.kontraktor-list > div').hide();
      $(`[data-role="${role}"]`).show();
      $('.nav-tabs a').removeClass('active');
      $(this).addClass('active');
    });

    // Add contractors to list
    function addContractors() {
      const role = $('.nav-tabs .active').data('role');
      const selected = $(`[data-role="${role}"] input:checked`);

      selected.each(function() {
        const label = $(this).next('label').text();
        const badge = `
          <div class="kontraktor-badge">
            <span class="role-tag" style="background: ${role === 'utama' ? '#007bff' : '#28a745'}">
              ${role === 'utama' ? 'Utama' : 'Sub'}
            </span>
            ${label}
            <button class="btn btn-sm btn-link text-danger ml-2" onclick="$(this).parent().remove()">×</button>
          </div>
        `;
        $('#assigned-kontraktor').append(badge);
      });

      $('#kontraktorModal').modal('hide');
    }
  </script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url() ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- jQuery -->
  <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>

</section>
<?= $this->endSection() ?>