<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk'; // Nama tabel produk
    protected $primaryKey = 'id_produk';
    
    protected $allowedFields = ['nama_produk', 'harga', 'id_kantin', 'jumlah_produk', 'kategori'];

    public function getProdukByKantin($id_kantin)
    {
        return $this->where('id_kantin', $id_kantin)->findAll(); // Mengambil semua produk berdasarkan kantin
    }
}
