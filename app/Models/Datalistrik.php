<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datalistrik extends Model
{
    use HasFactory;
    protected $table = 'data_listrik';
    protected $primaryKey = 'listrik_id';

    protected $fillable = [
        'user_id',
        'sisa_pulsa',
        'pemakaian_hari_ini',
        'prediksi_pulsa_habis',
        'prediksi_pemakaian_satuhari_kedepan',
        'prediksi_pemakaian_satuminggu_kedepan'
    ];
}
