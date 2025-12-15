<?php

namespace App\Models;

use CodeIgniter\Model;

class PerolehanModel extends Model{
    protected $table = 'SPK_PEROLEHAN';
    protected $primaryKey = 'PEROLEHAN_ID';
    protected $useTimestamps = false;
    // protected $createdField = 'created_at';
    // // protected $deleltedField = 'deleted_at';
    // protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'PROJEK_ID', 'KEPUTUSAN', 'JENIS_PEROLEHAN',
        'JENIS_PROJEK', 'LUKISAN_TENDER',
        'LUKISAN_TENDER_FILE', 'DOKUMEN_MEJA_TENDER',
        'RO_PINDAAN', 'KERTAS_KERJA',
        'BORANG_47A_47B', 'TAPAK',
        'PELAN_PROJEK', 'KUANTITI'
    ];

    // Relationship to Projek (optional, but good practice)
    public function projek()
    {
        return $this->belongsTo(ProjekModel::class, 'PROJEK_ID', 'PROJEK_ID');
    }

    public function getPerolehanByProjekId($PROJEK_ID)
    {
        return $this->where('PROJEK_ID', $PROJEK_ID)
                    ->first(); // Assuming one perolehan per projek based on current flow
    }

    // Archive methods commented out - these fields don't exist in the database
    /*
    public function archivePerolehanByProjekId($PROJEK_ID)
    {
        $data = [
            'IS_ARCHIVED' => 1,
            'ARCHIVED_AT' => date('Y-m-d H:i:s'),
            'STATUS_PEROLEHAN' => 'Diarkibkan'
        ];
        // Update all perolehan records associated with the projek_id
        return $this->where('PROJEK_ID', $PROJEK_ID)->set($data)->update();
    }

    public function unarchivePerolehanByProjekId($PROJEK_ID, $previousStatus = 'Menunggu Pengesahan')
    {
        $data = [
            'IS_ARCHIVED' => 0,
            'ARCHIVED_AT' => null,
            'STATUS_PEROLEHAN' => $previousStatus
        ];
        return $this->where('PROJEK_ID', $PROJEK_ID)
                    ->where('IS_ARCHIVED', 1) // Only unarchive if currently archived
                    ->set($data)->update();
    }
    */
}