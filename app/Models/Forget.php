<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forget extends Model
{
    use HasFactory;
    protected $table = 'forgets';
    protected $fillable = [
        'user_id',
        'token',
        'tanggal'
    ];
    public $timestamps = false;
}
