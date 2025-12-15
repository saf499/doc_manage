<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class OracleTest extends Controller
{
    public function index()
    {
        $db = Database::connect();
        $query = $db->query('SELECT * FROM PROJEK');
        $result = $query->getResult();
        print_r($result);
    }
}
