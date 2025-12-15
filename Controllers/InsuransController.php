<?php

namespace App\Controllers;
use App\Models\ProjekModel;
use App\Models\InsuranModel;
use CodeIgniter\Controller;

class InsuransController extends Controller {
    public function create($projek_id){
        if (!$projek_id) {
            return redirect()->to ('/projek')->with('error', 'Projek ID is missing');
        }

        return view ('insurans/create', ['projek_id' => $projek_id]);
    }

    public function store() {
        $insuranM = new InsuranModel();
        $projekM = new ProjekModel();

        $projek_id = $this->request->getPost('projek_id');
        if (!$projekM->find($projek_id)) {
            return redirect()->back()->with('error', 'Invalid Projek ID.');
        }

        // Set validation rules
        $valid = \Config\Services::validation();
        $valid->setRules([
            'projek_id' => 'required',
            'jenis_insurans' => 'permit_empty',
            'nama_bank' => 'permit_empty',
            'no_polisi' => 'permit_empty', 
            'tempoh_dlp' => 'permit_empty',
            'jumlah_insurans' => 'permit_empty',
            'tarikh_mula' => 'permit_empty',
            'tarikh_akhir' => 'permit_empty',
            'status' => 'permit_empty',
            'tarikh_asal' => 'permit_empty',
            'tarikh_lanjutan' => 'permit_empty',
            'insurans_file' => 'permit_empty|uploaded[insurans_file]|mime_in[insurans_file,application/pdf]|max_size[insurans_file,2048]'
        ]);

        // If validation fails, it means it's incomplete and saved as 'draft'
        $isValid = $valid->withRequest($this->request)->run();

        $data = [
            'projek_id' => $this->request->getPost('projek_id'),
            'jenis_insurans' => $this->request->getPost('jenis_insurans'),
            'nama_bank' => $this->request->getPost('nama_bank'),
            'no_polisi' => $this->request->getPost('no_polisi'),
            'tempoh_dlp' => $this->request->getPost('tempoh_dlp'),
            'jumlah_insurans' => $this->request->getPost('jumlah_insurans'),
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

        $file = $this->request->getFile('insurans_file');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $file->move($uploadPath);
            $data['bon_file'] = $file->getName();
        } else {
            $file = null;
        }

        $insuranM->save($data);

        if ($isValid) {
            return redirect()->to('/pelaksanaan/create/' . $projek_id)->with('success', 'Insurans submitted');
        } else {
            return redirect()->to('/pelaksanaan/create/' . $projek_id)->with('success', 'Insurans saved as draft.');
        }
    }
}

?>