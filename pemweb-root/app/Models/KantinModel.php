<?php 

namespace App\Models;

use CodeIgniter\Model;

class KantinModel extends Model
{
    protected $table = 'kantin';
    protected $primaryKey = 'id_kantin';
    protected $allowedFields = ['nama_kantin', 'id_penjual'];
}
