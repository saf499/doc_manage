<?php

namespace App\Models;
use CodeIgniter\Model;

class KontraktorModel extends Model {
    protected $table = 'SPK_KONTRAKTOR'; // Nama table database

    protected $primaryKey = 'KONTRAKTOR_ID';

    protected $allowedFields = [
        'NAMA_SYARIKAT', 'ALAMAT', 'NO_PHONE',
        'NO_SYARIKAT', 'NO_FAX', 'JENIS_KONTRAKTOR',
        'SPC', 'SST'
    ];
}
