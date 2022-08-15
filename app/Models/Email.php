<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $table = 'emails';
    protected $primaryKey = 'email_id';

    protected $fillable = [
        'nomorserial_id',
        'subject',
        'tanggal'
    ];
    public $timestamps = false;
}

