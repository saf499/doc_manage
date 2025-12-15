<?php

namespace App\Controllers;

use App\Models\KontrakModel;
use App\Models\ProjekModel;
use App\Models\KontraktorModel;
use CodeIgniter\Controller;

class KontrakController extends Controller
{
    protected $kontrakModel, $projekModel, $kontraktorModel;

    public function __construct()
    {
        $this->kontrakModel = new KontrakModel();
        $this->projekModel = new ProjekModel();
        $this->kontraktorModel = new KontraktorModel();
    }

    // Display all kontrak
    public function index()
    {
        $data['kontrak'] = $this->kontrakModel->getKontrak();
        return view('kontrak/index', $data);
    }

    // Assign contractor to a project (Show form)
    public function create()
    {
        // Get all non-archived projects
        $data['projek'] = $this->projekModel->getAllNonArchivedProjek();
        
        // Get all contractors
        $data['kontraktor'] = $this->kontraktorModel->findAll();
        
        return view('kontrak/create', $data);
    }

    // Process contractor assignment
    public function store()
    {
        // Validation rules
        $rules = [
            'projek_id' => 'required|numeric',
            'kontraktor_ids' => 'required',
            'harga' => 'permit_empty|numeric',
            'blr' => 'permit_empty|numeric',
            'lad' => 'permit_empty|numeric',
            't_mula' => 'permit_empty|valid_date',
            't_akhir' => 'permit_empty|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get the selected contractors
        $kontraktorIds = $this->request->getPost('kontraktor_ids');
        
        // Ensure kontraktor_ids is an array
        if (!is_array($kontraktorIds)) {
            $kontraktorIds = [$kontraktorIds];
        }

        // Create kontrak records for each contractor with budget information
        $projekId = $this->request->getPost('projek_id');
        
        // Format dates for Oracle
        $tMula = $this->request->getPost('t_mula');
        $tAkhir = $this->request->getPost('t_akhir');
        
        // Convert dates to Oracle format if they're not empty
        if ($tMula) {
            $tMula = date('Y-m-d', strtotime($tMula));
        }
        if ($tAkhir) {
            $tAkhir = date('Y-m-d', strtotime($tAkhir));
        }
        
        try {
            $db = \Config\Database::connect();

            foreach ($kontraktorIds as $kontraktorId) {
                $sql = "INSERT INTO SPK_KONTRAK 
                    (PROJEK_ID, KONTRAKTOR_ID, HARGA, BLR, LAD, T_MULA, T_AKHIR)
                    VALUES (:projek_id:, :kontraktor_id:, :harga:, :blr:, :lad:, TO_DATE(:t_mula:, 'YYYY-MM-DD'), TO_DATE(:t_akhir:, 'YYYY-MM-DD'))";

                $db->query($sql, [
                    'projek_id' => $projekId,
                    'kontraktor_id' => $kontraktorId,
                    'harga' => $this->request->getPost('harga'),
                    'blr' => $this->request->getPost('blr') ?: null,
                    'lad' => $this->request->getPost('lad') ?: null,
                    't_mula' => $tMula ?: null,
                    't_akhir' => $tAkhir ?: null,
                ]);
            }
            
            return redirect()->to('/kontrak')->with('success', 'Kontraktor berjaya ditugaskan ke projek');
            
        } catch (\Exception $e) {
            log_message('error', 'Error inserting kontrak: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan kontrak: ' . $e->getMessage());
        }
    }

    // Delete kontrak
    public function delete($id)
    {
        $this->kontrakModel->delete($id);
        return redirect()->to('/kontrak')->with('success', 'Kontrak berjaya dipadam');
    }

    public function edit($id){
        $kontrak = $this->kontrakModel->find($id);

        if (!$kontrak) {
            return redirect()->to('/kontrak')->with('error', 'Kontrak tidak dapat dijumpai.');
        }

        // Get all non-archived projects
        $data['projek'] = $this->projekModel->getAllNonArchivedProjek();
        
        // Get all contractors
        $data['kontraktor'] = $this->kontraktorModel->findAll();
        
        // Get the kontrak data
        $data['SPK_KONTRAK'] = $kontrak;

        return view('kontrak/edit', $data);
    }

    public function update($id) {
        $kontrak = $this->kontrakModel->find($id);
        if (!$kontrak) {
            return redirect()->to('/kontrak')->with('error', 'Kontrak tidak dapat dijumpai');
        }

        // Validation rules
        $rules = [
            'projek_id' => 'required|numeric',
            'kontraktor_ids' => 'required',
            'harga' => 'permit_empty|numeric',
            'blr' => 'permit_empty|numeric',
            'lad' => 'permit_empty|numeric',
            't_mula' => 'permit_empty|valid_date',
            't_akhir' => 'permit_empty|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get the selected contractors
        $kontraktorIds = $this->request->getPost('kontraktor_ids');
        
        // Ensure kontraktor_ids is an array
        if (!is_array($kontraktorIds)) {
            $kontraktorIds = [$kontraktorIds];
        }

        // Format dates for Oracle
        $tMula = $this->request->getPost('t_mula');
        $tAkhir = $this->request->getPost('t_akhir');
        
        // Convert dates to Oracle format if they're not empty
        if ($tMula) {
            $tMula = date('Y-m-d', strtotime($tMula));
        }
        if ($tAkhir) {
            $tAkhir = date('Y-m-d', strtotime($tAkhir));
        }
        
        try {
            $db = \Config\Database::connect();

            // Update the existing kontrak record
            $projekId = $this->request->getPost('projek_id');
            $kontraktorId = $kontraktorIds[0]; // For now, just update with the first contractor
            
            $sql = "UPDATE SPK_KONTRAK SET 
                PROJEK_ID = :projek_id:,
                KONTRAKTOR_ID = :kontraktor_id:,
                HARGA = :harga:,
                BLR = :blr:,
                LAD = :lad:,
                T_MULA = TO_DATE(:t_mula:, 'YYYY-MM-DD'),
                T_AKHIR = TO_DATE(:t_akhir:, 'YYYY-MM-DD')
                WHERE ID = :id:";

            $db->query($sql, [
                'id' => $id,
                'projek_id' => $projekId,
                'kontraktor_id' => $kontraktorId,
                'harga' => $this->request->getPost('harga'),
                'blr' => $this->request->getPost('blr') ?: null,
                'lad' => $this->request->getPost('lad') ?: null,
                't_mula' => $tMula ?: null,
                't_akhir' => $tAkhir ?: null,
            ]);
            
            return redirect()->to('/kontrak')->with('success', 'Kontrak berjaya dikemaskini.');
            
        } catch (\Exception $e) {
            log_message('error', 'Error updating kontrak: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengemaskini kontrak: ' . $e->getMessage());
        }
    }

}
