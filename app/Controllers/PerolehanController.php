<?php

namespace App\Controllers;

use App\Models\PerolehanModel;
use App\Models\ProjekModel;

class PerolehanController extends BaseController{

    public function create($PROJEK_ID){
        if (!$PROJEK_ID) {
            // Check if projek_id is passsed as query parameter (from ProjekControlller store redirect)
            $PROJEK_ID = $this->request->getGet('PROJEK_ID');
        }

        if (!$PROJEK_ID) {
            // Redirect back if no projek_id is found
            return redirect()->to ('/projek')->with('error', 'ID Projek diperlukan untuk membuat perolehan.');
        }

        $projekM = new ProjekModel();
        $projek = $projekM->getProjekById($PROJEK_ID); // Ensure projek exists n is not archived

        if (!$projek || $projek['IS_ARCHIVED'] == 1) {
            return redirect()->to('/projek')->with('error', 'Projek tidak ditemukan atau telah diarchive.');
        }

        $perolehanM = new PerolehanModel();
        $existingPerolehan = $perolehanM->getPerolehanByProjekId($PROJEK_ID);
        if ($existingPerolehan) {
            return redirect()->to('/perolehan/edit/' . $existingPerolehan['PEROLEHAN_ID'])->with('info', 'Perolehan sudah ada untuk projek ini.');
        }

        // Pass the projek_id to the view
        return view('perolehan/create', ['PROJEK_ID' => $PROJEK_ID, 'projek' => $projek]);
    }

    public function store(){
        
        $perolehanM = new PerolehanModel();
        $projekM = new ProjekModel();

        $PROJEK_ID = $this->request->getPost('PROJEK_ID');

        // Validate projek_id
        if (!$PROJEK_ID || !$projekM->getProjekById($PROJEK_ID)) {
            return redirect()->back()->with('error', 'Projek Id tidak sah.');
        }

        // Check if perolehan already exists for this projek
        $existingPerolehan = $perolehanM->getPerolehanByProjekId($PROJEK_ID);
        if ($existingPerolehan) {
            return redirect()->back()->with('error', 'Perolehan sudah ada untuk projek ini.');
        }

        // Set validation rules
        $valid = \Config\Services::validation();
        $valid->setRules([
            'PROJEK_ID' => 'required',
            'KEPUTUSAN' => 'permit_empty',
            'JENIS_PEROLEHAN' => 'permit_empty',
            'JENIS_PROJEK' => 'permit_empty',
            'LUKISAN_TENDER' => 'permit_empty|in_list[1,0]',
            'LUKISAN_TENDER_FILE' => 'permit_empty|max_size[LUKISAN_TENDER_FILE,5120]|ext_in[LUKISAN_TENDER_FILE,pdf]',
            'DOKUMEN_MEJA_TENDER' => 'permit_empty|max_size[DOKUMEN_MEJA_TENDER,5120]|ext_in[DOKUMEN_MEJA_TENDER,pdf]',
            'RO_PINDAAN' => 'permit_empty|max_size[RO_PINDAAN,5120]|ext_in[RO_PINDAAN,pdf]',
            'KERTAS_KERJA' => 'permit_empty|max_size[KERTAS_KERJA,5120]|ext_in[KERTAS_KERJA,pdf]',
            'BORANG_47A_47B' => 'permit_empty|max_size[BORANG_47A_47B,5120]|ext_in[BORANG_47A_47B,pdf]',
            'TAPAK' => 'permit_empty|max_size[TAPAK,5120]|ext_in[TAPAK,pdf]',
            'PELAN_PROJEK' => 'permit_empty|max_size[PELAN_PROJEK,5120]|ext_in[PELAN_PROJEK,pdf]',
            'KUANTITI' => 'permit_empty|max_size[KUANTITI,5120]|ext_in[KUANTITI,pdf]'
        ]);

        // If validation fails, it means it's incomplete and saved as 'draft'
        $isValid = $valid->withRequest($this->request)->run();
        if (!$isValid) {
            return redirect()->back()->withInput()->with('error', 'Perolehan saved as draft.');
        }

        // Prepare the main form data
        $options = [
            'PROJEK_ID' => $PROJEK_ID,
            'KEPUTUSAN' => $this->request->getPost('KEPUTUSAN'),
            'JENIS_PEROLEHAN' => $this->request->getPost('JENIS_PEROLEHAN'),
            'JENIS_PROJEK' => $this->request->getPost('JENIS_PROJEK'),
            'LUKISAN_TENDER' => (int)$this->request->getPost('LUKISAN_TENDER')
        ];

        // Files will be stored as BLOB in database
 
        // Initialize files array
        $files = [];

        // Handle LUKISAN_TENDER_FILE based on LUKISAN_TENDER selection
        switch ($this->request->getPost('LUKISAN_TENDER')) {
            case 1:
                $lukisanFile = $this->request->getFile('LUKISAN_TENDER_FILE');
                $files['LUKISAN_TENDER_FILE'] = ($lukisanFile && $lukisanFile->isValid() && !$lukisanFile->hasMoved())
                    ? file_get_contents($lukisanFile->getTempName())
                    : null;
                break;
            default:
                $files['LUKISAN_TENDER_FILE'] = null;
                break;
        }

        // Handle other file uploads
        $fileFields = [
            'DOKUMEN_MEJA_TENDER',
            'RO_PINDAAN', 
            'KERTAS_KERJA',
            'BORANG_47A_47B',
            'TAPAK',
            'PELAN_PROJEK',
            'KUANTITI'
        ];

        foreach ($fileFields as $field) {
            $file = $this->request->getFile($field);
            $files[$field] = ($file && $file->isValid() && !$file->hasMoved())
                ? file_get_contents($file->getTempName())
                : null;
        }

        // Merge the form data with the uploaded file names
        $data = array_merge($options, $files);

        // Save the data to the database
        // Remove PEROLEHAN_ID from data - Oracle trigger will handle it automatically

        if ($perolehanM->insert($data)) {
            return redirect()->to('/projek/show/' . $PROJEK_ID)->with('success', 'Perolehan berjaya ditambah.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambah perolehan.');
        }
    }

    public function show($PROJEK_ID, $PEROLEHAN_ID){
        $model = new PerolehanModel();
        $projekM = new ProjekModel();
        
        $perolehan = $model->find($PEROLEHAN_ID);
        $projek = $projekM->find($PROJEK_ID);

        if (!$perolehan || !$projek) {
            return redirect()->to('/projek')->with('error', 'Perolehan atau projek tidak ditemukan.');
        }

        // Map values to more readable version
        $perolehan['LUKISAN_TENDER'] = $this->mapLukisan($perolehan['LUKISAN_TENDER']);
        $perolehan['JENIS_PEROLEHAN'] = $this->mapJenisPerolehan($perolehan['JENIS_PEROLEHAN']);
        $perolehan['JENIS_PROJEK'] = $this->mapJenisProjek($perolehan['JENIS_PROJEK']);
        $perolehan['KEPUTUSAN'] = $this->mapKeputusan($perolehan['KEPUTUSAN']);

        $data = [
            'perolehan' => $perolehan,
            'projek' => $projek
        ];

        // Check which files are uploaded (BLOB data)
        $data['uploadedFiles'] = [];
        $fileFieldsInDb = [
            'LUKISAN_TENDER_FILE',
            'DOKUMEN_MEJA_TENDER',
            'RO_PINDAAN',
            'KERTAS_KERJA',
            'BORANG_47A_47B',
            'TAPAK',
            'PELAN_PROJEK',
            'KUANTITI'
        ];

        foreach ($fileFieldsInDb as $field) {
            if (isset($perolehan[$field]) && !empty($perolehan[$field])) {
                $data['uploadedFiles'][] = $field;
            }
        }

        return view('perolehan/show', $data);
    }

    public function edit($PEROLEHAN_ID) {
        $perolehanM = new PerolehanModel();
        $projekM = new ProjekModel();

        // Get the perolehan data
        $data['perolehan'] = $perolehanM->find($PEROLEHAN_ID);

        // If perolehan not found, redirect with error
        if (empty($data['perolehan'])) {
            return redirect()->to('/projek')->with('error', 'Maklumat perolehan tidak dijumpai');
        }

        // Get the associated project
        $data['projek'] = $projekM->find($data['perolehan']['PROJEK_ID']);

        // If project not found, redirect with error
        if (empty($data['projek'])) {
            return redirect()->to('/projek')->with('error', 'Maklumat projek tidak dijumpai');
        }

        return view('perolehan/edit', $data);
    }

    public function update($PEROLEHAN_ID) {
        $perolehanM = new PerolehanModel();
        $existingPerolehan = $perolehanM->find($PEROLEHAN_ID);

        if (empty($existingPerolehan)) {
            return redirect()->to('/projek')->with('error', 'Maklumat perolehan tidak dijumpai');
        }
        $PROJEK_ID = $existingPerolehan['PROJEK_ID'];

        // Set validation rules
        $valid = \Config\Services::validation();
        $valid->setRules([
            'PROJEK_ID' => 'required',
            'KEPUTUSAN' => 'permit_empty',
            'JENIS_PEROLEHAN' => 'permit_empty',
            'JENIS_PROJEK' => 'permit_empty',
            'LUKISAN_TENDER' => 'permit_empty',
            'LUKISAN_TENDER_FILE' => 'permit_empty|max_size[LUKISAN_TENDER_FILE,5120]|ext_in[LUKISAN_TENDER_FILE,pdf]',
            'DOKUMEN_MEJA_TENDER' => 'permit_empty|max_size[DOKUMEN_MEJA_TENDER,5120]|ext_in[DOKUMEN_MEJA_TENDER,pdf]',
            'RO_PINDAAN' => 'permit_empty|max_size[RO_PINDAAN,5120]|ext_in[RO_PINDAAN,pdf]',
            'KERTAS_KERJA' => 'permit_empty|max_size[KERTAS_KERJA,5120]|ext_in[KERTAS_KERJA,pdf]',
            'BORANG_47A_47B' => 'permit_empty|max_size[BORANG_47A_47B,5120]|ext_in[BORANG_47A_47B,pdf]',
            'TAPAK' => 'permit_empty|max_size[TAPAK,5120]|ext_in[TAPAK,pdf]',
            'PELAN_PROJEK' => 'permit_empty|max_size[PELAN_PROJEK,5120]|ext_in[PELAN_PROJEK,pdf]',
            'KUANTITI' => 'permit_empty|max_size[KUANTITI,5120]|ext_in[KUANTITI,pdf]'
        ]);

        // Run validation
        $isValid = $valid->withRequest($this->request)->run();

        $data = [
            'KEPUTUSAN' => $this->request->getPost('KEPUTUSAN'),
            'JENIS_PEROLEHAN' => $this->request->getPost('JENIS_PEROLEHAN'),
            'JENIS_PROJEK' => $this->request->getPost('JENIS_PROJEK'),
            'LUKISAN_TENDER' => (int)$this->request->getPost('LUKISAN_TENDER')
        ];

        // Files will be stored as BLOB in database

        $files = ['LUKISAN_TENDER_FILE', 'DOKUMEN_MEJA_TENDER',
        'RO_PINDAAN', 'KERTAS_KERJA', 'BORANG_47A_47B', 'TAPAK', 
        'PELAN_PROJEK', 'KUANTITI'
        ];

        // Set status based on validation
        // $projekStatus = $isValid ? 'completed' : 'draft';

        // $projekData = [
        //     'status' => $projekStatus
        // ];

        // Handle whether has or no document

        foreach ($files as $field) {
            $file = $this->request->getFile($field);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                // Special handling for LUKISAN_TENDER_FILE based on LUKISAN_TENDER value
                if ($field === 'LUKISAN_TENDER_FILE' && $data['LUKISAN_TENDER'] != 1) {
                    $data[$field] = null; 
                    continue;
                }
                // Store file content as BLOB
                $data[$field] = file_get_contents($file->getTempName());
            } else {
                // Keep existing file if no new file is uploaded, unless it's LUKISAN_TENDER_FILE and LUKISAN_TENDER is No
                if ($field === 'LUKISAN_TENDER_FILE' && $data['LUKISAN_TENDER'] != 1) {
                    $data[$field] = null;
                } else {
                    $data[$field] = $existingPerolehan[$field]; // Keep old file if no new one
                }
            }
        }
        
        // $projekM->update($this->request->getPost('projek_id'), $projekData);

        // Now update the projek table's status based on the perolehan completeness
        // if($this->isComplete($data)) {
        //     // Update status to 'completed' in the projek table
        //     $projekM->update($perolehan['projek_id'], ['status' => 'completed']);
        // } else {
        //     $projekM->update($perolehan['projek_id'], ['status' => 'draft']);
        // }

        if ($perolehanM->update($PEROLEHAN_ID, $data)) {
            return redirect()->to('/projek/show/' . $PROJEK_ID)->with('success', 'Maklumat Perolehan berjaya dikemaskini.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengemaskini maklumat Perolehan.');
        }
    }

    public function delete($PEROLEHAN_ID) {
        $perolehanM = new PerolehanModel();
        $perolehan = $perolehanM->find($PEROLEHAN_ID);

        if ($perolehan) {
            // Optionally delete associated files from server
            // ... file deletion logic ...
            return redirect()->to($perolehan ? '/projek/show/' . $perolehan['PROJEK_ID'] : '/projek')->with('success', 'Maklumat Perolehan berjaya dipadam.');
        } else {
            return redirect()->to($perolehan ? '/projek/show/' . $perolehan['PROJEK_ID'] : '/projek')->with('error', 'Maklumat Perolehan tidak ditemui.');
        }
    }

    public function index() {
        $perolehanM = new PerolehanModel();
        $projekM = new ProjekModel();
        
        // Get all perolehan
        $perolehan = $perolehanM->findAll();

        foreach ($perolehan as &$p) {
            // Get project details
            $projek = $projekM->find($p['PROJEK_ID']);
            if ($projek) {
                $p['PROJEK_NAMA'] = $projek['NAMA_PROJEK'];
            }
            
            $p['JENIS_PEROLEHAN'] = $this->mapJenisPerolehan($p['JENIS_PEROLEHAN']);
            $p['JENIS_PROJEK'] = $this->mapJenisProjek($p['JENIS_PROJEK']);
            $p['KEPUTUSAN'] = $this->mapKeputusan($p['KEPUTUSAN']);
        }

        return view('perolehan/index', ['perolehan' => $perolehan]);
    }

    // Methods to view/download files from BLOB
    public function viewFile($PEROLEHAN_ID, $fieldName) {
        $perolehanM = new PerolehanModel();
        $perolehan = $perolehanM->find($PEROLEHAN_ID);
        
        if (!$perolehan || !isset($perolehan[$fieldName]) || empty($perolehan[$fieldName])) {
            return redirect()->back()->with('error', 'Fail tidak ditemui.');
        }
        
        // Set appropriate content type for PDF
        return $this->response->setHeader('Content-Type', 'application/pdf')
                              ->setBody($perolehan[$fieldName]);
    }

    public function downloadFile($PEROLEHAN_ID, $fieldName) {
        $perolehanM = new PerolehanModel();
        $perolehan = $perolehanM->find($PEROLEHAN_ID);
        
        if (!$perolehan || !isset($perolehan[$fieldName]) || empty($perolehan[$fieldName])) {
            return redirect()->back()->with('error', 'Fail tidak ditemui untuk muat turun.');
        }
        
        return $this->response->setHeader('Content-Type', 'application/pdf')
                              ->setHeader('Content-Disposition', 'attachment; filename="' . $fieldName . '.pdf"')
                              ->setBody($perolehan[$fieldName]);
    }
    
    private function mapLukisan($value) {
        return $value == 1 ? 'Yes' : 'No';
    }

    private function mapKeputusan($value) {
        $keputusanMap =[
            'lulus' => 'Lulus',
            'lulus bersyarat' => 'Lulus Bersyarat',
            'ditolak' => 'Ditolak'
        ];

        return $keputusanMap[$value] ?? $value;
    }

    private function mapJenisPerolehan($value) {
        $jenisPerolehanMap = [
            'sebutharga' => 'Sebutharga',
            'tender' => 'Perolehan Tender',
            'rfp' => 'Request For Proposal'
        ];

        return $jenisPerolehanMap[$value] ?? $value;
    }

    private function mapJenisProjek($value) {
        $jenisProjekMap = [
            'one-off' => 'One-Off',
            'berkala' => 'Berkala'
        ];

        return $jenisProjekMap[$value] ?? $value;
    }

    public function testStore(){
        // Simple test without file uploads to isolate the session issue
        $perolehanM = new PerolehanModel();
        $projekM = new ProjekModel();

        $PROJEK_ID = $this->request->getPost('PROJEK_ID');

        // Validate projek_id
        if (!$PROJEK_ID || !$projekM->getProjekById($PROJEK_ID)) {
            return redirect()->back()->with('error', 'Projek Id tidak sah.');
        }

        // Check if perolehan already exists for this projek
        $existingPerolehan = $perolehanM->getPerolehanByProjekId($PROJEK_ID);
        if ($existingPerolehan) {
            return redirect()->back()->with('error', 'Perolehan sudah ada untuk projek ini.');
        }

        // Prepare the main form data without files
        $data = [
            'PROJEK_ID' => $PROJEK_ID,
            'KEPUTUSAN' => $this->request->getPost('KEPUTUSAN'),
            'JENIS_PEROLEHAN' => $this->request->getPost('JENIS_PEROLEHAN'),
            'JENIS_PROJEK' => $this->request->getPost('JENIS_PROJEK'),
            'LUKISAN_TENDER' => (int)$this->request->getPost('LUKISAN_TENDER'),
            'LUKISAN_TENDER_FILE' => null,
            'DOKUMEN_MEJA_TENDER' => null,
            'RO_PINDAAN' => null,
            'KERTAS_KERJA' => null,
            'BORANG_47A_47B' => null,
            'TAPAK' => null,
            'PELAN_PROJEK' => null,
            'KUANTITI' => null
        ];

        if ($perolehanM->insert($data)) {
            return redirect()->to('/projek/show/' . $PROJEK_ID)->with('success', 'Perolehan berjaya ditambah (test).');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambah perolehan (test).');
        }
    }
}
