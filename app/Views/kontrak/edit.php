<?= $this->extend('layout/main') ?>

<?= $this->section('header') ?>
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
              <li class="breadcrumb-item active"><a href="<?= site_url('kontrak') ?>">Kontrak</a></li>
              <li class="breadcrumb-item active">Kemaskini Kontrak</li>
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

    // Tab functionality - Initialize when modal is shown
    $('#kontraktorModal').on('shown.bs.modal', function() {
      console.log('Modal shown');
      // Hide all role divs initially
      $('.kontraktor-list > div[data-role]').hide();
      // Show only utama by default
      $('.kontraktor-list > div[data-role="utama"]').show();
      
      // Reset tab states
      $('.nav-tabs a').removeClass('active');
      $('.nav-tabs a[data-role="utama"]').addClass('active');
      
      // Focus on first tab for accessibility
      $('.nav-tabs a[data-role="utama"]').focus();
    });
    
    // Handle modal hidden event to remove aria-hidden
    $('#kontraktorModal').on('hidden.bs.modal', function() {
      $(this).removeAttr('aria-hidden');
    });

    // Tab click handler
    $(document).on('click', '.nav-tabs a', function(e) {
      e.preventDefault();
      console.log('Tab clicked:', $(this).data('role'));
      const role = $(this).data('role');
      
      // Hide all role divs
      $('.kontraktor-list > div[data-role]').hide();
      // Show the selected role div
      $('.kontraktor-list > div[data-role="' + role + '"]').show();
      
      // Update active tab
      $('.nav-tabs a').removeClass('active');
      $(this).addClass('active');
      
      console.log('Hidden divs:', $('.kontraktor-list > div[data-role]').length);
      console.log('Shown div:', $('.kontraktor-list > div[data-role="' + role + '"]').length);
    });

    // Add contractors to list
    function addContractors() {
      const role = $('.nav-tabs .active').data('role');
      const selected = $(`[data-role="${role}"] input:checked`);

      if (selected.length === 0) {
        alert('Sila pilih sekurang-kurangnya satu kontraktor.');
        return;
      }

      selected.each(function() {
        const kontraktorId = $(this).val();
        const label = $(this).next('label').text();
        const badge = `
          <div class="kontraktor-badge">
            <input type="hidden" name="kontraktor_ids[]" value="${kontraktorId}">
            <span class="role-tag" style="background: ${role === 'utama' ? '#007bff' : '#28a745'}">
              ${role === 'utama' ? 'Utama' : 'Sub'}
            </span>
            ${label}
            <button type="button" class="btn btn-sm btn-link text-danger ml-2" onclick="$(this).parent().remove()">×</button>
          </div>
        `;
        $('#assigned-kontraktor').append(badge);
      });

      // Clear selections after adding
      $(`[data-role="${role}"] input:checked`).prop('checked', false);
      
      // Return focus to the button that opened the modal
      $('#kontraktorModal').modal('hide').on('hidden.bs.modal', function() {
        $('[data-toggle="modal"][data-target="#kontraktorModal"]').focus();
      });
    }

    // Form validation
    $('form').on('submit', function(e) {
      const kontraktorIds = $('input[name="kontraktor_ids[]"]');
      if (kontraktorIds.length === 0) {
        e.preventDefault();
        alert('Sila pilih sekurang-kurangnya satu kontraktor.');
        return false;
      }
    });
</script>
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
  .kontraktor-item {
    padding: 10px;
    border-bottom: 1px solid #eee;
  }
  .kontraktor-item:last-child {
    border-bottom: none;
  }
  .kontraktor-item input[type="radio"],
  .kontraktor-item input[type="checkbox"] {
    margin-right: 10px;
  }
  .kontraktor-item label {
    margin-bottom: 0;
    cursor: pointer;
  }
  .nav-tabs .nav-link {
    cursor: pointer;
  }
  .nav-tabs .nav-link.active {
    background-color: #007bff;
    color: white;
  }
  
  /* Ensure proper hiding/showing of tab content */
  .kontraktor-list > div[data-role] {
    display: none;
  }
  
  .kontraktor-list > div[data-role="utama"] {
    display: block;
  }
</style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <!-- Notifications -->
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
  <?php if(session()->getFlashdata('errors')): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="mb-0">
      <?php foreach(session()->getFlashdata('errors') as $error): ?>
        <li><?= $error ?></li>
      <?php endforeach; ?>
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php endif; ?>

  <form method="post" action="<?= site_url('kontrak/update/' . $SPK_KONTRAK['ID']) ?>">
    <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Kemaskini Kontrak</h3>
        </div>

        <!-- Projek Selection -->
        <div class="card-body">
          <div class="form-group">
            <label>Pilih Projek</label>
            <select name="projek_id" class="form-control" required>
              <option value="">Pilih Projek</option>
              <?php foreach($projek as $p): ?>
                <option value="<?= $p['PROJEK_ID'] ?>" <?= set_select('projek_id', $p['PROJEK_ID'], $SPK_KONTRAK['PROJEK_ID'] == $p['PROJEK_ID']) ?>>
                  <?= $p['PROJEK_ID'] ?> - <?= $p['NAMA_PROJEK'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Assigned Contractors -->
          <div class="form-group">
            <label>Kontraktor Yang Ditetapkan</label>
            <div id="assigned-kontraktor" class="p-3 border rounded">
              <!-- Current contractor -->
              <?php if(isset($SPK_KONTRAK['KONTRAKTOR_ID'])): ?>
                <div class="kontraktor-badge">
                  <input type="hidden" name="kontraktor_ids[]" value="<?= $SPK_KONTRAK['KONTRAKTOR_ID'] ?>">
                  <span class="role-tag" style="background: #007bff">
                    Utama
                  </span>
                  <?php 
                    // Find contractor name
                    $contractorName = '';
                    foreach($kontraktor as $k) {
                      if($k['KONTRAKTOR_ID'] == $SPK_KONTRAK['KONTRAKTOR_ID']) {
                        $contractorName = $k['NAMA_SYARIKAT'];
                        break;
                      }
                    }
                    echo $contractorName;
                  ?>
                  <button type="button" class="btn btn-sm btn-link text-danger ml-2" onclick="$(this).parent().remove()">×</button>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Button Add Contractor -->
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#kontraktorModal">
            + Tambah Kontraktor
          </button>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="card card-secondary">
        <div class="card-header">
          <div class="card-title">Bajet</div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Harga Kontrak</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">RM</span>
              </div>
              <input type="number" 
                step="0.01"
                min="0.00" 
                name="harga" 
                id="harga" 
                class="form-control" 
                value="<?= set_value('harga', $SPK_KONTRAK['HARGA'] ?? '') ?>"
                placeholder="Enter the cost estimate"
                required>
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
                value="<?= set_value('blr', $SPK_KONTRAK['BLR'] ?? '') ?>"
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
                value="<?= set_value('lad', $SPK_KONTRAK['LAD'] ?? '') ?>"
                placeholder="Enter the cost estimate per day">
              <div class="input-group-append">
                <span class="input-group-text">.00</span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="t_mula">Tarikh Mula</label>
            <input type="date" name="t_mula" value="<?= set_value('t_mula', $SPK_KONTRAK['T_MULA'] ? date('Y-m-d', strtotime($SPK_KONTRAK['T_MULA'])) : '') ?>" required>
          </div>
          <div class="form-group">
            <label for="t_akhir">Tarikh Akhir</label>
            <input type="date" name="t_akhir" value="<?= set_value('t_akhir', $SPK_KONTRAK['T_AKHIR'] ? date('Y-m-d', strtotime($SPK_KONTRAK['T_AKHIR'])) : '') ?>" required>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <a href="<?= site_url('kontrak') ?>" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Kemaskini" class="btn btn-success float-right">
      </div>
    </div>
  </form>

     <!-- Kontraktor Modal -->
   <div class="modal fade" id="kontraktorModal" tabindex="-1" role="dialog" aria-labelledby="kontraktorModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="kontraktorModalLabel">Pilih Kontraktor</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
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
              <?php foreach($kontraktor as $k): ?>
                <?php if($k['JENIS_KONTRAKTOR'] == 'utama'): ?>
                  <div class="kontraktor-item">
                    <input type="radio" name="kontraktor_utama" id="utama_<?= $k['KONTRAKTOR_ID'] ?>" value="<?= $k['KONTRAKTOR_ID'] ?>">
                    <label for="utama_<?= $k['KONTRAKTOR_ID'] ?>"><?= $k['NAMA_SYARIKAT'] ?> (<?= $k['NO_SYARIKAT'] ?>)</label>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>

            <!-- Sub List (hidden by default) -->
            <div data-role="sub">
              <?php foreach($kontraktor as $k): ?>
                <?php if($k['JENIS_KONTRAKTOR'] == 'subkontraktor'): ?>
                  <div class="kontraktor-item">
                    <input type="checkbox" id="sub_<?= $k['KONTRAKTOR_ID'] ?>" value="<?= $k['KONTRAKTOR_ID'] ?>">
                    <label for="sub_<?= $k['KONTRAKTOR_ID'] ?>"><?= $k['NAMA_SYARIKAT'] ?> (<?= $k['NO_SYARIKAT'] ?>)</label>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

                 <div class="modal-footer">
           <button type="button" class="btn btn-primary" onclick="addContractors()">Tambah</button>
           <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Cancel">Batal</button>
         </div>
      </div>
    </div>
  </div>

</section>
<?= $this->endSection() ?>