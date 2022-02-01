<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ARIMA extends Model
{
    use HasFactory;
    protected $table = 'data_arima';
    protected $primaryKey = 'arima_id';

    protected $fillable = [
        'user_id',
        'pemakaian_listrik',
        'tanggal'
    ];
    public $timestamps = false;
}
