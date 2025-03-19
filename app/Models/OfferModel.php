<?php

namespace App\Models;
use CodeIgniter\Model;

class OfferModel extends Model {
    protected $table = 'offers';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_nasabah', 'periode_awal', 'periode_akhir', 'kendaraan',
        'harga_pertanggungan', 'jenis_pertanggungan', 'risiko_banjir',
        'risiko_gempa', 'total_premi'
    ];
}
