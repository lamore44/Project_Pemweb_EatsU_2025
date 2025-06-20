<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReviewModel;

class Review extends BaseController
{
    public function detail($id)
    {
        $reviewModel = new ReviewModel();
        $review = $reviewModel
            ->select('review.*, mahasiswa.user_id, produk.nama_produk')
            ->join('mahasiswa', 'mahasiswa.id_mhs = review.id_mhs')
            ->join('produk', 'produk.id_produk = review.id_produk')
            ->where('id_review', $id)
            ->first();

        if (!$review) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/review_detail', ['review' => $review]);
    }

}
