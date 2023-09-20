<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $fillable = [
        'id_user',
        'id_ruang',
        'tanggal'
    ];

    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ruang(){
        return $this->belongsTo(Ruang::class, 'id_ruang');
    }
}
