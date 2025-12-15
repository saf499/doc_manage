<?php

namespace App\Controllers;
use App\Models\ProjekModel;
use App\Models\BonModel;
use CodeIgniter\Controller;

class BonController extends Controller {
    protected $bonM;
    
    public function index() {
        $this->bonM = new BonModel();
        $projekM = new ProjekModel();
        
        // Get all bon records with project information
        $bonData = $this->bonM->select('spk_bon.*, SPK_PROJEK.NAMA_PROJEK, SPK_PROJEK.NAMA_PEMOHON, spk_kontrak.projek_id')
                              ->join('spk_kontrak', 'spk_kontrak.id = spk_bon.kontrak_id', 'left')
                              ->join('SPK_PROJEK', 'SPK_PROJEK.PROJEK_ID = spk_kontrak.projek_id', 'left')
                              ->findAll();
        
        return view('bon/index', ['bonData' => $bonData]);
    }
    
    public function create($projek_id){
        if (!$projek_id) {
            return redirect()->to ('/projek')->with('error', 'Projek ID is missing');
        }

        return view ('bon/create', ['projek_id' => $projek_id]);
    }

    public function store() {
        $this->bonM = new BonModel();
        $projekM = new ProjekModel();

        $projek_id = $this->request->getPost('projek_id');
        if (!$projekM->find($projek_id)) {
            return redirect()->back()->with('error', 'Invalid Projek ID.');
        }

        // Set validation rules
        $valid = \Config\Services::validation();
        $valid->setRules([
            'projek_id' => 'required',
            'jenis_bon' => 'permit_empty',
            'no_jaminan' => 'permit_empty',
            'no_pendaftaran_syarikat' => 'permit_empty', 
            'jumlah' => 'permit_empty',
            'tarikh_mula' => 'permit_empty',
            'tarikh_akhir' => 'permit_empty',
            'status' => 'permit_empty',
            'tarikh_asal' => 'permit_empty',
            'tarikh_lanjutan' => 'permit_empty',
            'bon_file' => 'permit_empty|uploaded[bon_file]|mime_in[bon_file,application/pdf]|max_size[bon_file,2048]'
        ]);

        // If validation fails, it means it's incomplete and saved as 'draft'
        $isValid = $valid->withRequest($this->request)->run();

        $data = [
            'projek_id' => $this->request->getPost('projek_id'),
            'jenis_bon' => $this->request->getPost('jenis_bon'),
            'no_jaminan' => $this->request->getPost('no_jaminan'),
            'no_pendaftaran_syarikat' => $this->request->getPost('no_pendaftaran_syarikat'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tarikh_mula' => $this->request->getPost('tarikh_mula'),
            'tarikh_akhir' => $this->request->getPost('tarikh_akhir'),
            'status' => $this->request->getPost('status'),
            'tarikh_asal' => $this->request->getPost('tarikh_asal'),
            'tarikh_lanjutan' => $this->request->getPost('tarikh_lanjutan')
        ];

        $uploadPath = "./upload/bon/{$projek_id}";
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $file = $this->request->getFile('bon_file');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $file->move($uploadPath);
            $data['bon_file'] = $file->getName();
        } else {
            $file = null;
        }

        // Save bond data
        $bonData = $this->request->getPost('bon') ?? [];
        foreach ($bonData as $bon) {
            $bon['projek_id'] = $projek_id;
            $this->bonM->save($bon);
        }

        if ($isValid) {
            return redirect()->to('/insurans/create/' . $projek_id)->with('success', 'Bon submitted');
        } else {
            return redirect()->to('/insurans/create/' . $projek_id)->with('success', 'Bon saved as draft.');
        }
    }

    public function edit($bon_id) {
        $this->bonM = new BonModel();
        $projekM = new ProjekModel();
        
        $bon = $this->bonM->find($bon_id);
        if (!$bon) {
            return redirect()->to('/bon')->with('error', 'Bon tidak dijumpai');
        }
        
        // Get project information through kontrak relationship
        $projek = $projekM->select('SPK_PROJEK.*')
                         ->join('spk_kontrak', 'spk_kontrak.projek_id = SPK_PROJEK.PROJEK_ID', 'left')
                         ->where('spk_kontrak.id', $bon['kontrak_id'])
                         ->first();
        
        return view('bon/edit', ['bon' => $bon, 'projek' => $projek]);
    }

    public function update($bon_id) {
        $this->bonM = new BonModel();
        
        $bon = $this->bonM->find($bon_id);
        if (!$bon) {
            return redirect()->to('/bon')->with('error', 'Bon tidak dijumpai');
        }
        
        // Set validation rules
        $valid = \Config\Services::validation();
        $valid->setRules([
            'jenis_bon' => 'permit_empty',
            'no_jaminan' => 'permit_empty',
            'no_pendaftaran_syarikat' => 'permit_empty', 
            'jumlah' => 'permit_empty',
            'tarikh_mula' => 'permit_empty',
            'tarikh_akhir' => 'permit_empty',
            'status' => 'permit_empty',
            'tarikh_asal' => 'permit_empty',
            'tarikh_lanjutan' => 'permit_empty',
            'bon_file' => 'permit_empty|uploaded[bon_file]|mime_in[bon_file,application/pdf]|max_size[bon_file,2048]'
        ]);

        $data = [
            'jenis_bon' => $this->request->getPost('jenis_bon'),
            'no_jaminan' => $this->request->getPost('no_jaminan'),
            'no_pendaftaran_syarikat' => $this->request->getPost('no_pendaftaran_syarikat'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tarikh_mula' => $this->request->getPost('tarikh_mula'),
            'tarikh_akhir' => $this->request->getPost('tarikh_akhir'),
            'status' => $this->request->getPost('status'),
            'tarikh_asal' => $this->request->getPost('tarikh_asal'),
            'tarikh_lanjutan' => $this->request->getPost('tarikh_lanjutan')
        ];

        // Handle file upload if provided
        $file = $this->request->getFile('bon_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = "./upload/bon/{$bon['kontrak_id']}";
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $file->move($uploadPath);
            $data['bon_file'] = $file->getName();
        }

        if ($this->bonM->update($bon_id, $data)) {
            return redirect()->to('/bon')->with('success', 'Bon berjaya dikemaskini');
        } else {
            return redirect()->back()->with('error', 'Gagal mengemaskini bon');
        }
    }

    public function delete($bon_id) {
        $this->bonM = new BonModel();
        
        $bon = $this->bonM->find($bon_id);
        if (!$bon) {
            return redirect()->to('/bon')->with('error', 'Bon tidak dijumpai');
        }
        
        if ($this->bonM->delete($bon_id)) {
            return redirect()->to('/bon')->with('success', 'Bon berjaya dipadamkan');
        } else {
            return redirect()->to('/bon')->with('error', 'Gagal memadamkan bon');
        }
    }
}

?>