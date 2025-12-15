<?php

namespace App\Models;

use CodeIgniter\Model;

class BonModel extends Model {
    protected $table = 'spk_bon';
    protected $primaryKey = 'bon_id';

    protected $allowedFields = ['kontrak_id', 'jenis_bon', 'no_jaminan', 
    'no_pendaftaran_syarikat', 'jumlah', 'tarikh_mula', 'tarikh_akhir',
    'status', 'tarikh_asal', 'tarikh_lanjutan', 'bon_file'];
}
