<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomorserial extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lstm(){

        return $this->hasOne(LSTM::class, 'nomorserial_id');

    }

    public function email(){

        return $this->hasOne(Email::class, 'nomorserial_id');

    }

    public function datalistrik(){

        return $this->hasOne(Datalistrik::class, 'nomorserial_id');

    }

    public function historytoken(){

        return $this->hasOne(Historytoken::class, 'nomorserial_id');

    }

    use HasFactory;
    protected $table = 'nomorserials';
    protected $primaryKey = 'nomorserial_id';
    protected $keyType = 'string';

    protected $fillable = [
        'nomorserial_id',
        'user_id',
    ];
    public $timestamps = false;
}
