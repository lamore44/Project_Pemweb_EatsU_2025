<?php 
namespace App\Models;

use CodeIgniter\Model;

class MemesanModel extends Model
{
    protected $table = 'memesan';
    protected $primaryKey = 'id_pesan';
    protected $allowedFields = ['id_mhs', 'id_produk', 'waktu_pesan'];
}
