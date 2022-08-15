<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datalistrik extends Model
{
    use HasFactory;

    protected $table = 'datalistriks';
    protected $primaryKey = 'listrik_id';

    protected $fillable = [
        'nomorserial_id',
        'sisa_pulsa',
    ];

    public $timestamps = false;

}
