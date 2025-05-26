<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualModel extends Model
{
    protected $table = 'penjual';
    protected $primaryKey = 'id_penjual';
    protected $allowedFields = ['user_id'];
}
