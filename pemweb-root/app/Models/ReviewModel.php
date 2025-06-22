<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'review'; // Nama tabel review
    protected $primaryKey = 'id_review';

    public function getProductReviews($id_produk)
    {
        return $this->where('id_produk', $id_produk)->findAll();
    }

    public function getRating($reviews)
    {
        $totalRating = 0;
        $count = count($reviews);
        foreach ($reviews as $review) {
            $totalRating += $review['rating'];
        }

        return ($count > 0) ? round($totalRating / $count, 1) : 0; // Menghitung rata-rata rating
    }
}
