<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lstm extends Model
{
    use HasFactory;
    protected $table = 'lstms';
    protected $primaryKey = 'lstm_id';

    protected $fillable = [
        'nomorserial_id',
        'pemakaian_listrik',
        'tanggal'
    ];
    public $timestamps = false;

}
