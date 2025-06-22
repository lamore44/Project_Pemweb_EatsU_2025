<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualModel extends Model
{
    protected $table = 'penjual';
    protected $primaryKey = 'id_penjual';
    protected $allowedFields = ['user_id', 'nama_penjual']; // Tambahkan kalau mau bisa update nama



    public function getKantinData($penjual_id)
    {
        return $this->where('id_penjual', $penjual_id)->first(); // Mengambil data kantin berdasarkan penjual
    }
}
