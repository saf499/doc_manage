<?php

namespace App\Controllers;

use App\Models\ProjekModel;
use App\Models\PerolehanModel;
// PerolehanModel might not be directly used here if ProjekModel handles cascading
// use App\Models\PerolehanModel;


class ProjekController extends BaseController{
    public function index(){
        $model = new ProjekModel();
        // Fetch only non-archived projects for the main index page
        $data['SPK_PROJEK'] = $model->getAllNonArchivedProjek();

        // Map values to more readable version
        foreach ($data['SPK_PROJEK'] as $key => $projek) {
            $data['SPK_PROJEK'][$key]['JENIS_KONTRAK'] = $this->mapJenisK($projek['JENIS_KONTRAK']);
            $data['SPK_PROJEK'][$key]['SUMBER_PERUNTUKAN'] = $this->mapSumber($projek['SUMBER_PERUNTUKAN']);
            $data['SPK_PROJEK'][$key]['STATUS_PROJEK'] = $this->mapStatus($projek['STATUS_PROJEK']);
        }
        unset($data['SPK_PROJEK']['IS_ARCHIVED']); // unset reference to the archived column

        return view('projek/index', $data);
    }

    public function create(){
        return view('projek/create');
    }

    public function store(){

        $model = new ProjekModel();
        $db = \Config\Database::connect();
        
        // Validation rules (example, expand as needed)
        $rules = [
            'NAMA_PROJEK' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Nama projek diperlukan',
                    'min_length' => 'Nama projek mestilah sekurang-kurangnya 3 aksara',
                    'max_length' => 'Nama projek tidak boleh melebihi 255 aksara'
                ]
            ],
            'NAMA_PEMOHON' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Nama pemohon diperlukan',
                    'min_length' => 'Nama pemohon mestilah sekurang-kurangnya 3 aksara',
                    'max_length' => 'Nama pemohon tidak boleh melebihi 255 aksara'
                ]
            ],
            'NO_KONTRAK' => [
                'rules' => 'permit_empty|max_length[50]',
                'errors' => [
                    'max_length' => 'No kontrak tidak boleh melebihi 50 aksara'
                ]
            ],
            'ANGGARAN_KOS' => [
                'rules' => 'permit_empty|numeric',
                'errors' => [
                    'numeric' => 'Anggaran kos mestilah dalam bentuk nombor'
                ]
            ],
            'TAHUN' => [
                'rules' => 'permit_empty|numeric|exact_length[4]',
                'errors' => [
                    'numeric' => 'Tahun mestilah dalam bentuk nombor',
                    'exact_length' => 'Tahun mestilah 4 digit'
                ]
            ],
            'SUMBER_PERUNTUKAN' => [
                'rules' => 'permit_empty|in_list[D.E,Rezab,Mengurus,Lain-lain]',
                'errors' => [
                    'in_list' => 'Sila pilih sumber peruntukan yang sah'
                ]
            ],
            'JENIS_KONTRAK' => [
                'rules' => 'permit_empty|in_list[Perkhidmatan,Bekalan,Kerja]',
                'errors' => [
                    'in_list' => 'Sila pilih jenis kontrak yang sah'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'NAMA_PROJEK' => $this->request->getVar('NAMA_PROJEK'),
            'NAMA_PEMOHON' => $this->request->getVar('NAMA_PEMOHON'),
            'NO_KONTRAK' => $this->request->getVar('NO_KONTRAK'),
            'ANGGARAN_KOS' => $this->request->getVar('ANGGARAN_KOS'),
            'TAHUN' => $this->request->getVar('TAHUN'),
            'SUMBER_PERUNTUKAN' => $this->request->getVar('SUMBER_PERUNTUKAN'),
            'JENIS_KONTRAK' => $this->request->getVar('JENIS_KONTRAK'),
            'STATUS_PROJEK' => 'perancangan', // Default status
            'IS_ARCHIVED' => 0
        ];

        // Dapatkan ID seterusnya dari sequence Oracle
        // $query = $db->query("SELECT SPK_PROJEK_SEQ.NEXTVAL AS PROJEK_ID_SEQ FROM DUAL");
        // $row = $query->getRowArray();

        // if (!$row || !isset($row['PROJEK_ID_SEQ'])) {
        //     session()->setFlashdata('error', 'Gagal mendapatkan ID projek seterusnya.');
        //     return redirect()->back()->withInput();
        // }

        // $data['PROJEK_ID'] = $row['PROJEK_ID_SEQ'];

        // Insert into the database
        $model->insert($data);
        $errors = $model->errors();
        if (empty($errors)) {
            session()->setFlashdata('success', 'Projek berjaya dicipta.');
            return redirect()->to('/projek');
        } else {
            log_message('debug', 'Insert data: ' . json_encode($errors));
            session()->setFlashdata('error', 'Gagal membuat projek. Sila cuba lagi.');
            return redirect()->back()->withInput();
        }
    }

    public function show($PROJEK_ID){
        $model = new ProjekModel();
        $perolehanModel = new PerolehanModel();

        //Fetch the projek data by its ID
        $data['SPK_PROJEK'] = $model->getProjekById($PROJEK_ID);

        if (!$data['SPK_PROJEK']){
            // if no project is found, redirect or show an error
            return redirect()->to('/projek');
        }

        // Map values to more readable version
        $data['SPK_PROJEK']['JENIS_KONTRAK'] = $this->mapJenisK($data['SPK_PROJEK']['JENIS_KONTRAK']);
        $data['SPK_PROJEK']['sumber_peruntukan'] = $this->mapSumber($data['SPK_PROJEK']['SUMBER_PERUNTUKAN']);
        $data['SPK_PROJEK']['STATUS_PROJEK'] = $this->mapStatus($data['SPK_PROJEK']['STATUS_PROJEK']);

        // Fetch the related perolehan data as a single record
        $perolehan = $perolehanModel->where('PROJEK_ID', $data['SPK_PROJEK']['PROJEK_ID'])->first();

        return view('projek/show', [
        'SPK_PROJEK' => $data['SPK_PROJEK'],
        'SPK_PEROLEHAN' => $perolehan
        ]);
    }

    public function edit($PROJEK_ID) {
        $model = new ProjekModel();
        $data['PROJEK'] = $model->getProjekById($PROJEK_ID);

        if (!$data['PROJEK']) {
            return redirect()->to('/projek')->with('error', 'Projek tidak ditemukan.');
        }

        return view('projek/edit', $data);
    }

    public function update($PROJEK_ID) {
        $model = new ProjekModel();
        // Fetch the existing data to ensure it's not archived / exists
        $existingData = $model->getProjekById($PROJEK_ID);

        if (!$existingData) {
            return redirect()->to('/projek')->with('error', 'Projek tidak ditemukan atau telah diarchive.');
        }

        // Validation rules
        $rules = [
            'NAMA_PROJEK' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Nama projek diperlukan',
                    'min_length' => 'Nama projek mestilah sekurang-kurangnya 3 aksara',
                    'max_length' => 'Nama projek tidak boleh melebihi 255 aksara'
                ]
            ],
            'NAMA_PEMOHON' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Nama pemohon diperlukan',
                    'min_length' => 'Nama pemohon mestilah sekurang-kurangnya 3 aksara',
                    'max_length' => 'Nama pemohon tidak boleh melebihi 255 aksara'
                ]
            ],
            'NO_KONTRAK' => [
                'rules' => 'permit_empty|max_length[50]',
                'errors' => [
                    'max_length' => 'No kontrak tidak boleh melebihi 50 aksara'
                ]
            ],
            'ANGGARAN_KOS' => [
                'rules' => 'permit_empty|numeric',
                'errors' => [
                    'numeric' => 'Anggaran kos mestilah dalam bentuk nombor'
                ]
            ],
            'TAHUN' => [
                'rules' => 'permit_empty|numeric|exact_length[4]',
                'errors' => [
                    'numeric' => 'Tahun mestilah dalam bentuk nombor',
                    'exact_length' => 'Tahun mestilah 4 digit'
                ]
            ],
            'SUMBER_PERUNTUKAN' => [
                'rules' => 'permit_empty|in_list[D.E,Rezab,Mengurus,Lain-lain]',
                'errors' => [
                    'in_list' => 'Sila pilih sumber peruntukan yang sah'
                ]
            ],
            'JENIS_KONTRAK' => [
                'rules' => 'permit_empty|in_list[Perkhidmatan,Bekalan,Kerja]',
                'errors' => [
                    'in_list' => 'Sila pilih jenis kontrak yang sah'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'NAMA_PROJEK' => $this->request->getVar('NAMA_PROJEK'),
            'NAMA_PEMOHON' => $this->request->getVar('NAMA_PEMOHON'),
            'NO_KONTRAK' => $this->request->getVar('NO_KONTRAK'),
            'ANGGARAN_KOS' => $this->request->getVar('ANGGARAN_KOS'),
            'TAHUN' => $this->request->getVar('TAHUN'),
            'SUMBER_PERUNTUKAN' => $this->request->getVar('SUMBER_PERUNTUKAN'),
            'JENIS_KONTRAK' => $this->request->getVar('JENIS_KONTRAK'),
            'STATUS_PROJEK' => $existingData['STATUS_PROJEK'] // Preserve status
        ];

        // 🔍 Debugging: Check if data exists before updating
        if (empty($data)) {
            return redirect()->back()->with('error', 'No data received for update.');
        }
    
        // Log received data (Check in writable/logs/)
        log_message('debug', 'Update data: ' . json_encode($data));
    
        // Update project in database
        if ($model->update($PROJEK_ID, $data)) {
            return redirect()->to('/projek/show/' . $PROJEK_ID)->with('success', 'Projek berjaya dikemaskini.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengemaskini projek.');
        }
    }

    // public function delete($PROJEK_ID) {
    //     $model = new ProjekModel();
    //     $model->delete($PROJEK_ID);

    //     return redirect()->to('/projek')->with('status', 'Project deleted successfully');
    // }

    public function archive($PROJEK_ID) {
        $projekModel = new ProjekModel();
        $perolehanModel = new PerolehanModel();

        // Start a database transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Archive the project
            if (!$projekModel->archiveProjek($PROJEK_ID)) {
                throw new \Exception('Gagal mengarkibkan projek');
            }

            // Get associated perolehan
            $perolehan = $perolehanModel->where('PROJEK_ID', $PROJEK_ID)->first();
            if ($perolehan) {
                $perolehanData = [
                    'IS_ARCHIVED' => 1,
                    'ARCHIVED_AT' => date('Y-m-d H:i:s')
                ];

                // Archive associated perolehan
                if (!$perolehanModel->update($perolehan['PEROLEHAN_ID'], $perolehanData)) {
                    throw new \Exception('Gagal mengarkibkan perolehan');
                }
            }

            $db->transCommit();
            return redirect()->to('/projek')->with('success', 'Projek dan perolehan berkaitan telah diarchive.');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function unarchive($PROJEK_ID) {
        $projekModel = new ProjekModel();
        $perolehanModel = new PerolehanModel();

        // Start a database transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Unarchive the project
            if (!$projekModel->unarchiveProjek($PROJEK_ID)) {
                throw new \Exception('Failed to unarchive project');
            }

            // Get associated perolehan
            $perolehan = $perolehanModel->where('PROJEK_ID', $PROJEK_ID)->first();
            if ($perolehan) {

                $perolehanData = [
                    'IS_ARCHIVED' => 0,
                    'ARCHIVED_AT' => null
                ];
                // Unarchive associated perolehan
                if (!$perolehanModel->update($perolehan['PEROLEHAN_ID'], $perolehanData)) {
                    throw new \Exception('Gagal membuka perolehan yang berkaitan.');
                }
            }

            $db->transCommit();
            return redirect()->to('/projek')->with('success', 'Projek dan perolehan berkaitan telah diunarchive.');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal mengunarchive projek: ' . $e->getMessage());
        }
    }

    public function archivedList() {
        $model = new ProjekModel();
        $data['SPK_PROJEK'] = $model->getArchivedProjek(); // Make sure this method exists in your model
        
        // Map values to more readable version
        foreach ($data['SPK_PROJEK'] as $key => $projek) {
            $data['SPK_PROJEK'][$key]['JENIS_KONTRAK'] = $this->mapJenisK($projek['JENIS_KONTRAK']);
            $data['SPK_PROJEK'][$key]['SUMBER_PERUNTUKAN'] = $this->mapSumber($projek['SUMBER_PERUNTUKAN']);
            $data['SPK_PROJEK'][$key]['STATUS_PROJEK'] = $this->mapStatus($projek['STATUS_PROJEK']);
        }

        return view('projek/archived', $data);
    }

    private function mapJenisK($value) {
        $jenisKMap =[
            'perkhidmatan' => 'Perkhidmatan',
            'bekalan' => 'Bekalan',
            'kerja' => 'Kerja'
        ];

        return $jenisKMap[$value] ?? $value;
    }

    private function mapSumber($value) {
        $sumberMap = [
            'd.e' => 'D.E',
            'rezab' => 'Rezab',
            'mengurus' => 'Mengurus',
            'lain-lain' => 'Lain-lain'
        ];

        return $sumberMap[$value] ?? $value;
    }

    private function mapStatus($value) {
        $statusMap = [
            'perancangan' => 'Perancangan',
            'aktif' => 'Aktif',
            'kiv' => 'K.I.V'
        ];

        return $statusMap[$value] ?? $value;
    }
}