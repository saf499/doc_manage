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

    // Simple tab functionality like W3.CSS example
    function openTab(evt, tabName) {
      var i, tabcontent, tablinks;
      
      // Hide all tab content
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      
      // Remove active class from all tab links
      tablinks = document.getElementsByClassName("tablink");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
      }
      
      // Show the selected tab content and add active class to button
      document.getElementById(tabName).style.display = "block";
      evt.currentTarget.classList.add("active");
    }
    
    // Initialize first tab when modal opens
    $('#kontraktorModal').on('shown.bs.modal', function() {
      // Show first tab by default
      document.getElementById('utama-tab').style.display = "block";
      document.getElementsByClassName("tablink")[0].classList.add("active");
    });

    // Add contractors to list
    function addContractors() {
      // Get the active tab
      const activeTab = document.querySelector('.tablink.active');
      const role = activeTab ? activeTab.getAttribute('data-role') : 'utama';
      
      // Get selected contractors from the active tab
      const activeTabContent = document.getElementById(role + '-tab');
      const selected = activeTabContent.querySelectorAll('input:checked');

      if (selected.length === 0) {
        alert('Sila pilih sekurang-kurangnya satu kontraktor.');
        return;
      }

      selected.forEach(function(input) {
        const kontraktorId = input.value;
        const label = input.nextElementSibling.textContent;
        const badge = `
          <div class="kontraktor-badge">
            <input type="hidden" name="kontraktor_ids[]" value="${kontraktorId}">
            <span class="role-tag" style="background: ${role === 'utama' ? '#007bff' : '#28a745'}">
              ${role === 'utama' ? 'Utama' : 'Sub'}
            </span>
            ${label}
            <button type="button" class="btn btn-sm btn-link text-danger ml-2" onclick="this.parentElement.remove()">×</button>
          </div>
        `;
        document.getElementById('assigned-kontraktor').insertAdjacentHTML('beforeend', badge);
      });

      // Clear selections after adding
      selected.forEach(function(input) {
        input.checked = false;
      });
      
      // Close modal
      $('#kontraktorModal').modal('hide');
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
  
     /* W3.CSS Tab Styles */
   .tabcontent {
     display: none;
     padding: 6px 12px;
     border: 1px solid #ccc;
     border-top: none;
   }
   
   .tablink {
     background-color: inherit;
     float: left;
     border: none;
     outline: none;
     cursor: pointer;
     padding: 14px 16px;
     transition: 0.3s;
     font-size: 17px;
   }
   
   .tablink:hover {
     background-color: #ddd;
   }
   
   .tablink.active {
     background-color: #007bff;
     color: white;
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

  <form method="post" action="<?= site_url('kontrak/store') ?>">
    <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Kontrak Baru</h3>
        </div>

        <!-- Projek Selection -->
        <div class="card-body">
          <div class="form-group">
            <label>Pilih Projek</label>
            <select name="projek_id" class="form-control" required>
              <option value="">Pilih Projek</option>
              <?php foreach($projek as $p): ?>
                <option value="<?= $p['PROJEK_ID'] ?>" <?= set_select('projek_id', $p['PROJEK_ID']) ?>>
                  <?= $p['PROJEK_ID'] ?> - <?= $p['NAMA_PROJEK'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Assigned Contractors -->
          <div class="form-group">
            <label>Kontraktor Yang Ditetapkan</label>
            <div id="assigned-kontraktor" class="p-3 border rounded">
              <!-- Contractors will be added here dynamically -->
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
                value="<?= set_value('harga') ?>"
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
                value="<?= set_value('blr') ?>"
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
                value="<?= set_value('lad') ?>"
                placeholder="Enter the cost estimate per day">
              <div class="input-group-append">
                <span class="input-group-text">.00</span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="t_mula">Tarikh Mula</label>
            <input type="date" name="t_mula" value="<?= set_value('t_mula') ?>" required>
          </div>
          <div class="form-group">
            <label for="t_akhir">Tarikh Akhir</label>
            <input type="date" name="t_akhir" value="<?= set_value('t_akhir') ?>" required>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <a href="<?= site_url('kontrak') ?>" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Tambah" class="btn btn-success float-right">
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
           <div class="w3-bar w3-border-bottom">
             <button class="tablink w3-bar-item w3-button active" onclick="openTab(event, 'utama-tab')" data-role="utama">Kontraktor Utama</button>
             <button class="tablink w3-bar-item w3-button" onclick="openTab(event, 'sub-tab')" data-role="sub">Sub-Kontraktor</button>
           </div>

           <!-- Contractor List -->
           <!-- Utama List -->
           <div id="utama-tab" class="tabcontent">
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
           <div id="sub-tab" class="tabcontent" style="display:none">
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

          <div class="modal-footer">
           <button type="button" class="btn btn-primary" onclick="addContractors()">Tambah</button>
           <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Cancel">Batal</button>
         </div>
      </div>
    </div>
  </div>

</section>
<?= $this->endSection() ?>