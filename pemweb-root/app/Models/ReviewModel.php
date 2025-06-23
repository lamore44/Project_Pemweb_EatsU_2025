<?php

namespace App\Models;
use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'id_review';
    protected $allowedFields = ['id_mhs', 'id_produk', 'rating'];

    public function getProductReviews($id_produk)
    {
        return $this->where('id_produk', $id_produk)->findAll();
    }

    public function getRating($reviews)
    {
        if (empty($reviews)) return null;

        $total = 0;
        foreach ($reviews as $r) {
            $total += $r['rating'];
        }

        return round($total / count($reviews), 1);
    }
}
