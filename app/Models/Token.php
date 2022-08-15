<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $table = 'tokens';
    protected $primaryKey = 'token_id';

    protected $fillable = [
        'nomorserial_id',
        'token',
        'trigger'
    ];
    public $timestamps = false;
}
