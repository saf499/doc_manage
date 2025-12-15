<?php

namespace App\Controllers;
use App\Models\KontraktorModel;
use CodeIgniter\Controller;

class KontraktorController extends Controller {
    protected $kontraktorModel;

    public function __construct() {
        $this->kontraktorModel = new KontraktorModel();
    }

    public function index() {
        // Fetch data from each table based on the projek_id
        $kontraktorData = $this->kontraktorModel->findAll();

        $data = [
            'SPK_KONTRAKTOR' => $kontraktorData,
        ];

        return view('kontraktor/index', $data);
    }

    public function create() {
        return view('kontraktor/create');
    }

    public function save(){
        // Set validation rules
        $valid = \Config\Services::validation();
        
        $valid->setRules([
            'NAMA_SYARIKAT' => 'permit_empty',
            'ALAMAT' => 'permit_empty',
            'NO_PHONE' => 'permit_empty',
            'NO_SYARIKAT' => 'permit_empty',
            'NO_FAX' => 'permit_empty',
            'JENIS_KONTRAKTOR' => 'permit_empty',
            'SPC' => 'permit_empty|uploaded[SPC]|mime_in[SPC,application/pdf]|max_size[SPC,2048]',
            'SST' => 'permit_empty|uploaded[SST]|mime_in[SST,application/pdf]|max_size[SST,2048]'
        ]);

        if ($valid->withRequest($this->request)->run()) {
            // Collect regular inputs
            $data = [
                'NAMA_SYARIKAT' => $this->request->getPost('NAMA_SYARIKAT'),
                'ALAMAT' => $this->request->getPost('ALAMAT'),
                'NO_PHONE' => $this->request->getPost('NO_PHONE'),
                'NO_SYARIKAT' => $this->request->getPost('NO_SYARIKAT'),
                'NO_FAX' => $this->request->getPost('NO_FAX'),
                'JENIS_KONTRAKTOR' => $this->request->getPost('JENIS_KONTRAKTOR'),
            ];
        }

        // Handle file uploads
        $uploadPath = "./upload/kontraktor/";
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true); // Create folder if it doesn't exist
        }

        $files = ['SPC', 'SST'];

        foreach ($files as $fileKey) {
            $file = $this->request->getFile($fileKey);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);
                $data[$fileKey] = $newName;
            } else {
                $data[$fileKey] = null;
            }
        }

        // Save contractor data
        $this->kontraktorModel->insert($data);

        return redirect()->to('/kontraktor')->with('success', 'Kontraktor saved successfully!');
    }

    public function edit($KONTRAKTOR_ID) {
        $kontraktor = $this->kontraktorModel->find($KONTRAKTOR_ID);
        if (!$kontraktor) {
            return redirect()->to('/kontraktor')->with('error', 'Kontraktor not found');
        }

        return view('kontraktor/edit', ['SPK_KONTRAKTOR' => $kontraktor]);
    }

    public function update($KONTRAKTOR_ID) {
        $kontraktor = $this->kontraktorModel->find($KONTRAKTOR_ID);
        if (!$kontraktor) {
            return redirect()->to('/kontraktor')->with('error', 'Kontraktor not found');
        }

        // Set validation rules
        $valid = \Config\Services::validation();
        $valid->setRules([
            'NAMA_SYARIKAT' => 'permit_empty',
            'ALAMAT' => 'permit_empty',
            'NO_PHONE' => 'permit_empty',
            'NO_SYARIKAT' => 'permit_empty',
            'NO_FAX' => 'permit_empty',
            'JENIS_KONTRAKTOR' => 'required',
            'SPC' => 'permit_empty|uploaded[SPC]|mime_in[SPC,application/pdf]|max_size[SPC,2048]',
            'SST' => 'permit_empty|uploaded[SST]|mime_in[SST,application/pdf]|max_size[SST,2048]'
        ]);

        if (!$valid->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', 'Validation failed!');
        }

        // Collect form data
        $data = [
            'NAMA_SYARIKAT' => $this->request->getPost('NAMA_SYARIKAT'),
            'ALAMAT' => $this->request->getPost('ALAMAT'),
            'NO_PHONE' => $this->request->getPost('NO_PHONE'),
            'NO_SYARIKAT' => $this->request->getPost('NO_SYARIKAT'),
            'NO_FAX' => $this->request->getPost('NO_FAX'),
            'JENIS_KONTRAKTOR' => $this->request->getPost('JENIS_KONTRAKTOR')
        ];

        // Handle file uploads
        $uploadPath = "./uploads/kontraktor/";

        foreach (['SPC', 'SST'] as $fileKey) {
            $file = $this->request->getFile($fileKey);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);
                $data[$fileKey] = $newName;
            }
        }

        // Update kontraktor data
        $this->kontraktorModel->update($KONTRAKTOR_ID, $data);

        return redirect()->to('/kontraktor')->with('success', 'Kontraktor updated successfully!');
    }

    public function delete($KONTRAKTOR_ID) {
        $this->kontraktorModel->delete($KONTRAKTOR_ID);
        return redirect()->to('/kontraktor')->with('success', 'Kontraktor deleted successfully!');
    }
}