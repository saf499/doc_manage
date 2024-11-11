<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class ProjekModel extends Model{
    protected $table = 'projek';
    protected $primaryKey = 'projek_id';
    protected $useAutoIncrement = true;
    // protected $useTimestamps = true;
    // protected $createdField = 'created_at';
    // protected $deleltedField = 'deleted_at';
    // protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'nama_projek', 'nama_pemohon', 
        'no_kontrak', 'jenis_kontrak', 'anggaran_kos', 'tahun', 
        'sumber_peruntukan', 'status_projek'
    ];

    public function getProjekById($projek_id){
        
        // Use the projek_id to find the specific record
        return $this->where('projek_id', $projek_id)->first();
    }

    
    public function getPerolehan() {
        return $this->hasOne('App\Models\PerolehanModel', 'projek_id', 'projek_id');
    }
}