<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualModel extends Model
{
    protected $table = 'penjual';
    protected $primaryKey = 'id_penjual';
    protected $allowedFields = ['user_id', 'nama_penjual'];

    /**
     * Mengambil data penjual beserta username dari tabel user.
     * @param int $id_penjual
     * @return array|null
     */
    public function getPenjualWithUser($id_penjual)
    {
        return $this->select('penjual.*, user.username')
                    ->join('user', 'user.id = penjual.user_id')
                    ->where('penjual.id_penjual', $id_penjual)
                    ->first();
    }
}
