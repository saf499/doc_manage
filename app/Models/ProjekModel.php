<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class ProjekModel extends Model{
    protected $table = 'SPK_PROJEK';
    protected $primaryKey = 'PROJEK_ID';
    // protected $useAutoIncrement = true;
    protected $useTimestamps = false;
    // protected $createdField = 'REG_DATE'; // Use reg_date instead of created_at
    // protected $deletedField = 'deleted_at';
    // protected $updatedField = null; // No updated_at field

    protected $allowedFields = [
        'NAMA_PROJEK', 'NAMA_PEMOHON', 'NO_KONTRAK',
        'JENIS_KONTRAK', 'ANGGARAN_KOS', 'TAHUN',
        'SUMBER_PERUNTUKAN', 'STATUS_PROJEK',
        'IS_ARCHIVED', 'ARCHIVED_AT' // Needed for achieve/unarchieve methods 
        // REG_DATE n UPDATE_AT are handled by Oracle
    ];

    /**
     * HANYA mengarkibkan rekod projek ini.
     * Controller akan uruskan logik untuk perolehan.
     */

     public function getAllNonArchivedProjek(){
        return $this->where('IS_ARCHIVED', 0)->findAll();
     }
    public function archiveProjek($PROJEK_ID)
    {
        $data = [
            'IS_ARCHIVED' => 1,
            'ARCHIVED_AT' => date('Y-m-d H:i:s'),
        ];
        return $this->update($PROJEK_ID, $data);
    }

    /**
     * HANYA menyaharkibkan rekod projek ini.
     */
    public function unarchiveProjek($PROJEK_ID)
    {
        $data = [
            'IS_ARCHIVED' => 0,
            'ARCHIVED_AT' => null,
        ];
        return $this->update($PROJEK_ID, $data);
    }

    public function getProjekById($PROJEK_ID)
    {
        return $this->where('PROJEK_ID', $PROJEK_ID)
                    ->where('IS_ARCHIVED', 0)
                    ->first();
    }

    public function getArchivedProjek()
    {
        return $this->where('IS_ARCHIVED', 1)->findAll();
    }
    
    // ... fungsi-fungsi lain ...

}