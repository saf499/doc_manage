<?php

namespace App\Controllers;

use App\Models\ProjekModel;
use App\Models\PerolehanModel;
use CodeIgniter\Controller;

class ProjekController extends Controller{
    public function index(){
        $model = new ProjekModel();
        $data['projek'] = $model->findAll();

        if (empty($data['projek'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No projects found');
        }

        return view('projek/index', $data);
    }

    public function create(){
        return view('projek/create');
    }

    public function store(){

        $model = new ProjekModel();
        $data = $this->request->getPost();

        // Check if any required fields are null or not
        // if (empty($data['no_kontrak']) || empty($data['anggaran_kos']) || empty($data['tahun']) || empty($data['sumber_peruntukan'])) {
        //     // Mark as draft if any required field is empty
        //     $data['status'] = 'draft';
        // } else {
        //     // Mark as completed if all fields are filled
        //     $data['status'] = 'completed';
        // }

        $status = 'completed';

        foreach($data as $key => $value) {
            if (empty($value)) {
                $status = 'draft';
                break;
            }
        }

        $data['status'] = $status;
            
        // Save the project and get the inserted projek ID
        $model->save($data);
        $projek_id = $model->getInsertID();

        // Redirect to the Perolehan Form, passing the projek_id
        return redirect()->to('/perolehan/create?projek_id=' . $projek_id)->with('success', 'Project saved as draft.');
    
    }

    public function show($projek_id){
        $model = new ProjekModel();
        $perolehanModel = new PerolehanModel();

        //Fetch the projek data by its ID
        $data['projek'] = $model->getProjekById($projek_id);

        if (!$data['projek']){
            // if no project is found, redirect or show an error
            return redirect()->to('/projek');
        }

        // Map values to more readable version
        $data['projek']['jenis_kontrak'] = $this->mapJenisK($data['projek']['jenis_kontrak']);
        $data['projek']['sumber_peruntukan'] = $this->mapSumber($data['projek']['sumber_peruntukan']);
        $data['projek']['status_projek'] = $this->mapStatus($data['projek']['status_projek']);

        // Fetch the related perolehan data as a single record
        $perolehan = $perolehanModel->where('projek_id', $data['projek']['projek_id'])->first();

        return view('projek/show', [
        'projek' => $data['projek'],
        'perolehan' => $perolehan
        ]);
    }

    public function edit($projek_id) {
        $model = new ProjekModel();
        $data['projek'] = $model->find($projek_id);

        return view('projek/edit', $data);
    }

    public function update($projek_id) {
        $model = new ProjekModel();

        $data = [
            'nama_projek'   => $this->request->getPost('nama_projek'),
            'nama_pemohon'  => $this->request->getPost('nama_pemohon'),
            'no_kontrak'    => $this->request->getPost('no_kontrak'),
            'jenis_kontrak' => $this->request->getPost('jenis_kontrak'),
            'anggaran_kos'  => $this->request->getPost('anggaran_kos'),
            'tahun'         => $this->request->getPost('tahun'),
            'sumber_peruntukan' => $this->request->getPost('sumber_peruntukan'),
            'status_projek'     => $this->request->getPost('status_projek')
        ];

        // // Check if the project is "completed" or remains a "draft"
        // if (!empty($data['nama_projek']) && !empty($data['nama_pemohon']) && !empty($data['no_kontrak']) && !empty($data['anggaran_kos']) && !empty($data['tahun'])) {
        //     $data['status'] = 'completed'; // All field are filled, mark as completed
        // } else {
        //     $data['status'] = 'draft'; // Some fields are missing, save as draft
        // }

        // Set the status field in data
        $status = 'completed';

        // Check if any field is empty
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $status = 'draft'; // if any field is empty, mark it as draft
                break;
            }
        }

        // Set the status field in data
        $data['status'] = $status;

        $model->update($projek_id, $data);

        return redirect()->to('/projek')->with('success', 'Project updated successfully');
    }

    public function delete($projek_id) {
        $model = new ProjekModel();
        $model->delete($projek_id);

        return redirect()->to('/projek')->with('status', 'Project deleted successfully');
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
            'KIV' => 'K.I.V'
        ];

        return $statusMap[$value] ?? $value;
    }
}
