<?php

namespace App\Models;

use CodeIgniter\Model;

class InsuranModel extends Model {
    protected $table = 'spk_insurans';
    protected $primaryKey = 'insurans_id';

    protected $allowedFields = [
        'kontrak_id', 'jenis_insurans', 'nama_bank',
        'no_polisi', 'tempoh_dlp', 'jumlah_insurans',
        'tarikh_mula', 'tarikh_akhir', 'status',
        'tarikh_asal', 'tarikh_lanjutan', 'insurans_file'
    ];
}
