<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class PerolehanModel extends Model{
    protected $table = 'perolehan';
    protected $primaryKey = 'perolehan_id';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    // protected $createdField = 'created_at';
    // protected $deleltedField = 'deleted_at';
    // protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'projek_id', 'keputusan', 'jenis_perolehan',
        'jenis_projek', 'lukisan_tender',
        'lukisan_tender_file', 'dokumen_meja_tender',
        'ro_pindaan', 'kertas_kerja',
        'borang_47a_47b', 'tapak',
        'pelan_projek', 'kuantiti'
    ];

    public function getProjek(): mixed {
        return $this->belongsTo('App\Models\ProjekModel', 'projek_id', 'projek_id');
    }
}