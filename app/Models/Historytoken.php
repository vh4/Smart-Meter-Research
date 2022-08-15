<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historytoken extends Model
{
    use HasFactory;
    protected $table = 'historytokens';
    protected $primaryKey = 'historytoken_id';

    protected $fillable = [
        'nomorserial_id',
        'token',
        'status',
        'tanggal'
    ];
    public $timestamps = false;

}
