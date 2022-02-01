<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $table = 'data_token';
    protected $primaryKey = 'token_id';

    protected $fillable = [
        'user_id',
        'token',
    ];
    public $timestamps = false;
}
