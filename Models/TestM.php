<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class TestM extends Model{
    protected $table = 'test';
    protected $primaryKey = 'test_id';
    protected $useAutoIncrement = true;
    // protected $useTimestamps = true;
    // protected $createdField = 'created_at';
    // protected $deleltedField = 'deleted_at';
    // protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'test_tajuk', 'test_comment', 'test_int',
        'test_option', 'tahun'
    ];

}