<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actual extends Model
{
    use HasFactory;
    protected $table = 'actuals';
    protected $primaryKey = 'actual_id';

    protected $fillable = [
        'nomorserial_id',
        'pemakaian_listrik',
        'tanggal'
    ];
    public $timestamps = false;
}
