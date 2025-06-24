<?php 
namespace App\Models;

use CodeIgniter\Model;

class MemesanModel extends Model
{
    protected $table = 'memesan';
    protected $primaryKey = 'id_pesan';
    protected $allowedFields = ['id_mhs', 'id_produk', 'jumlah', 'waktu_pesan'];

    public function getPesananMahasiswa($mahasiswa_id)
    {
        return $this->select('memesan.id_pesan, produk.nama_produk, memesan.waktu_pesan, pembayaran.status')
                    ->join('produk', 'produk.id_produk = memesan.id_produk')
                    ->join('pembayaran', 'pembayaran.id_pesan = memesan.id_pesan')
                    ->where('memesan.id_mhs', $mahasiswa_id)
                    ->findAll();
    }
}
