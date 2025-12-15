<?php

namespace App\Controllers;

use App\Models\PerolehanModel;
use App\Models\ProjekModel;
use CodeIgniter\Controller;

class PerolehanController extends Controller{

    public function create(){
        $projek_id = $this->request->getGet('projek_id');

        if (!$projek_id) {
            // Redirect back if no projek_id is found
            return redirect()->to ('/projek')->with('error', 'Projek ID is missing');
        }

        // Pass the projek_id to the view
        return view('perolehan/create', ['projek_id' => $projek_id]);
    }

    public function store(){
        
        $perolehanM = new PerolehanModel();
        $projekM = new ProjekModel();

        // Set validation rules
        $valid = \Config\Services::validation();
        $valid->setRules([
            'projek_id' => 'required',
            'keputusan' => 'required',
            'jenis_perolehan' => 'required',
            'jenis_projek' => 'required',
            'lukisan_tender' => 'required',
            'lukisan_tender_file' => 'if_exist|uploaded[lukisan_tender_file]|max_size[lukisan_tender_file,2048]|ext_in[lukisan_tender_file,pdf]',
            'dokumen_meja_tender' => 'uploaded[dokumen_meja_tender] |mime_in[dokumen_meja_tender,application/pdf]|max_size[dokumen_meja_tender,2048]',
            'ro_pindaan' => 'uploaded[ro_pindaan]|mime_in[ro_pindaan,application/pdf]|max_size[ro_pindaan,2048]',
            'kertas_kerja' => 'uploaded[kertas_kerja]|mime_in[kertas_kerja,application/pdf]|max_size[kertas_kerja,2048]',
            'borang_47a_47b' => 'uploaded[borang_47a_47b]|mime_in[borang_47a_47b,application/pdf]|max_size[borang_47a_47b,2048]',
            'tapak' => 'uploaded[tapak] |mime_in[tapak,application/pdf]|max_size[tapak,2048]',
            'pelan_projek' => 'uploaded[pelan_projek]|mime_in[pelan_projek,application/pdf]|max_size[pelan_projek,2048]',
            'kuantiti' => 'uploaded[kuantiti]|mime_in[kuantiti,application/pdf]|max_size[kuantiti,2048]'
        ]);

        // Run validation
        // if ($valid->withRequest($this->request)->run() === false) {
        //     return redirect()->back()->withInput()->with('errors', $valid->getErrors());
        // }

        // If validation fails, it means it's incomplete and saved as 'draft'
        $isValid = $valid->withRequest($this->request)->run();

        // Prepare the main form data
        $options = [
            'projek_id' => $this->request->getPost('projek_id'),
            'keputusan' => $this->request->getPost('keputusan'),
            'jenis_perolehan' => $this->request->getPost('jenis_perolehan'),
            'jenis_projek' => $this->request->getPost('jenis_projek'),
            'lukisan_tender' => $this->request->getPost('lukisan_tender')
        ];

        // Set status based on validation
        $projekStatus = $isValid ? 'completed' : 'draft';

        // Update 'projek' table with the new status
        $projekData = [
            'status' => $projekStatus
        ];

        // Update the projek table where the projek_id matches
        $projekM->update($this->request->getPost('projek_id'), $projekData);

        $perolehanM->save($options);
        $perolehan_id = $perolehanM->getInsertID();

        // Create directory for perolehan files based on perolehan_id
        $uploadPath = "./upload/perolehan/{$perolehan_id}";
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true); // Create folder if it doesn't exist
        }
 
        // Handle whether has or no document
        $files = [];

        if ($this->request->getPost('lukisan_tender') == 1) { // Yes option
            $document = $this->request->getFile('lukisan_tender_file');
            if($document->isValid() && !$document->hasMoved()) {
                $document->move($uploadPath); // Store the file and get the path
                $files['lukisan_tender_file'] = $document->getName();
            }else {
                return redirect()->back()->withInput()->with('error', 'Please attach a valid document.');
            }
        }

        //Handle file uploads
        foreach ($this->request->getFiles() as $key => $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $file->move($uploadPath);
                $files[$key] = $file->getName();
            }
        }

        //Merge the form data with the uploaded file names
        $data = array_merge($options, $files);

        // Save the data to the database
        $perolehanM->save($data);

        // Redirect to perolehan list with appropriate message
        if ($isValid) {
            return redirect()->to('/perolehan')->with('success', 'Perolehan submitted and project status updated to completed.');
        } else {
            return redirect()->to('/perolehan')->with('success', 'Perolehan saved as draft and project status updated to draft.');
        }
    }

    public function show($perolehan_id){
        $model = new PerolehanModel();
        $data['perolehan'] = $model->find($perolehan_id);

        if (!$data['perolehan']){
            // if no project is found, redirect or show an error
            return redirect()->to('/perolehan');
        }

        // Directory where the files are stored for this perolehan
        $directory = WRITEPATH . 'uploads/perolehan/' . $perolehan_id;

        // Check if the directory exists and fetch the files
        if (is_dir($directory)) {
            $data['uploadedFiles'] = array_diff(scandir($directory), ['..', '.']);
        } else {
            $data['uploadedFiles'] = [];
        }

        // Map values to more readable version
        $data['perolehan']['lukisan_tender'] = $this->mapLukisan($data['perolehan']['lukisan_tender']);
        $data['perolehan']['jenis_perolehan'] = $this->mapJenisPerolehan($data['perolehan']['jenis_perolehan']);
        $data['perolehan']['jenis_projek'] = $this->mapJenisProjek($data['perolehan']['jenis_projek']);
        $data['perolehan']['keputusan'] = $this->mapKeputusan($data['perolehan']['keputusan']);

        return view('perolehan/show', $data);
    }

    public function edit($perolehan_id) {
        $perolehanM = new PerolehanModel();
        $data['perolehan'] = $perolehanM->find($perolehan_id);
        $projekM = new ProjekModel();
        $data['projek'] = $projekM->findAll();

        // Find the associated projek by its id in perolehan
        if (!empty($data['perolehan'])) {
            $data['projek'] = $projekM->find($data['perolehan']['projek_id']);
        }

        if (empty($data['perolehan']) || empty($data['projek'])) {
            // Handle case if no perolehan or projek found
            return redirect()->to('/perolehan')->with('error', 'Perolehan or Projek not found');
        }

        return view('perolehan/edit', $data);
    }

    public function update($perolehan_id) {
        $perolehanM = new PerolehanModel();
        $projekM = new ProjekModel();

        // Set validation rules
        $valid = \Config\Services::validation();
        $valid->setRules([
            'projek_id' => 'required',
            'keputusan' => 'required',
            'jenis_perolehan' => 'required',
            'jenis_projek' => 'required',
            'lukisan_tender' => 'required',
            'lukisan_tender_file' => 'if_exist|uploaded[lukisan_tender_file]|max_size[lukisan_tender_file,2048]|ext_in[lukisan_tender_file,pdf]',
            'dokumen_meja_tender' => 'uploaded[dokumen_meja_tender] |mime_in[dokumen_meja_tender,application/pdf]|max_size[dokumen_meja_tender,2048]',
            'ro_pindaan' => 'uploaded[ro_pindaan]|mime_in[ro_pindaan,application/pdf]|max_size[ro_pindaan,2048]',
            'kertas_kerja' => 'uploaded[kertas_kerja]|mime_in[kertas_kerja,application/pdf]|max_size[kertas_kerja,2048]',
            'borang_47a_47b' => 'uploaded[borang_47a_47b]|mime_in[borang_47a_47b,application/pdf]|max_size[borang_47a_47b,2048]',
            'tapak' => 'uploaded[tapak] |mime_in[tapak,application/pdf]|max_size[tapak,2048]',
            'pelan_projek' => 'uploaded[pelan_projek]|mime_in[pelan_projek,application/pdf]|max_size[pelan_projek,2048]',
            'kuantiti' => 'uploaded[kuantiti]|mime_in[kuantiti,application/pdf]|max_size[kuantiti,2048]'
        ]);

        // Run validation
        $isValid = $valid->withRequest($this->request)->run();

        $perolehan = $perolehanM->find($perolehan_id);

        // Create directory for perolehan files based on perolehan_id
        $uploadPath = "./upload/perolehan/{$perolehan_id}";
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true); // Create folder if it doesn't exist
        }

        // Prepare the main form data
        $options = [
            'projek_id' => $perolehan['projek_id'],
            'keputusan' => $this->request->getPost('keputusan'),
            'jenis_perolehan' => $this->request->getPost('jenis_perolehan'),
            'jenis_projek' => $this->request->getPost('jenis_projek'),
            'lukisan_tender' => $this->request->getPost('lukisan_tender')
        ];

        // Set status based on validation
        $projekStatus = $isValid ? 'completed' : 'draft';

        $projekData = [
            'status' => $projekStatus
        ];

        // Handle whether has or no document
        $files = [];

        if ($this->request->getPost('lukisan_tender') == 1) { // Yes option
            $document = $this->request->getFile('lukisan_tender_file');
            if($document->isValid() && !$document->hasMoved()) {
                $document->move($uploadPath); // Store the file and get the path
                $files['lukisan_tender_file'] = $document->getName();
            }else {
                return redirect()->back()->withInput()->with('error', 'Please attach a valid document.');
            }
        }

        //Handle file uploads
        foreach ($this->request->getFiles() as $key => $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $file->move($uploadPath);
                $files[$key] = $file->getName();
            }
        }

        //Merge the form data with the uploaded file names
        $data = array_merge($options, $files);

        // Update the data in the database
        $perolehanM->update($perolehan_id, $data);
        
        $projekM->update($this->request->getPost('projek_id'), $projekData);

        // Now update the projek table's status based on the perolehan completeness
        if($this->isComplete($data)) {
            // Update status to 'completed' in the projek table
            $projekM->update($perolehan['projek_id'], ['status' => 'completed']);
        } else {
            $projekM->update($perolehan['projek_id'], ['status' => 'draft']);
        }
    }

    public function delete($perolehan_id) {
        $perolehanM = new PerolehanModel();
        $perolehanM->delete($perolehan_id);

        return redirect()->to('/perolehan')->with('status', 'Perolehan deleted successfully.');
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

    public function index() {
        $perolehanM = new PerolehanModel();
        $perolehan = $perolehanM->findAll();

        foreach ($perolehan as &$p) {
            $p['jenis_perolehan'] = $this->mapJenisPerolehan($p['jenis_perolehan']);
            $p['jenis_projek'] = $this->mapJenisProjek($p['jenis_projek']);
            $p['keputusan'] = $this->mapKeputusan($p['keputusan']);
        }

        return view('perolehan/index', ['perolehan' => $perolehan]);
    }

    private function isComplete($data) {
        return !empty($data['keputusan']) && !empty($data['jenis_perolehan']) && !empty($data['jenis_projek']) && !empty($data['lukisan_tender']);
    }

    public function viewFile($files) {
        $filepath = WRITEPATH . 'uploads/perolehan/' . $files;

        // Check if the file exists
        if (file_exists($filepath)) {
            // Get the file's mime type and send headers
            $mimeType = mime_content_type($filepath);
            header('Content-Type' . $mimeType);
            header('Content-Disposition: inline; filename="' . basename($filepath) . '"');
            header('Content-Length: ' . filesize($filepath));

            // Output the file content
            readfile($filepath);
            exit;
        } else {
            // File does not exist, show error or redirect
            return redirect()->back()->with('error', 'File not found.');
        }
    }

    public function downloadFile($files) {
        $filepath = WRITEPATH . 'uploads/perolehan/' . $files;

        // Check if the file exists
        if (file_exists($filepath)) {
            return $this->response->download($filepath, null)->setFileName($files);
        } else {
            // File does not exist, show error or redirect
            return redirect()->back()->with('error', 'File not found');
        }
    }
}
