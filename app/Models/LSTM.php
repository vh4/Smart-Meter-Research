<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LSTM extends Model
{
    use HasFactory;
    protected $table = 'data_lstm';
    protected $primaryKey = 'lstm_id';

    protected $fillable = [
        'user_id',
        'pemakaian_listrik',
        'tanggal'
    ];
    public $timestamps = false;
}
