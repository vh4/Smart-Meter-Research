<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'engineer_id');
    }

    protected $table = 'alats';
    protected $primaryKey = 'alat_id';

    protected $fillable = [
        'engineer_id',
        'nomorserial'
    ];
    public $timestamps = false;
}
