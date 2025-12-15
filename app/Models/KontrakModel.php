<?php

namespace App\Models;
use CodeIgniter\Model;

class KontrakModel extends Model {
    protected $table = 'SPK_KONTRAK'; // Nama table database

    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'PROJEK_ID', 'KONTRAKTOR_ID', 'HARGA', 'BLR', 'LAD',
        'T_MULA', 'T_AKHIR'
    ];

    // Get all kontrak data with project and contractor details
    public function getKontrak($id = null) {
        $builder = $this->db->table('SPK_KONTRAK')
            ->select('SPK_KONTRAK.*, SPK_PROJEK.NAMA_PROJEK, SPK_KONTRAKTOR.NAMA_SYARIKAT')
            ->join('SPK_PROJEK', 'SPK_PROJEK.PROJEK_ID = SPK_KONTRAK.PROJEK_ID')
            ->join('SPK_KONTRAKTOR', 'SPK_KONTRAKTOR.KONTRAKTOR_ID = SPK_KONTRAK.KONTRAKTOR_ID');

        if ($id) {
            return $builder->getWhere(['SPK_KONTRAK.ID' => $id])->getRowArray();
        }

        return $builder->get()->getResultArray();
    }
}