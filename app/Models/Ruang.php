<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;
    protected $table = 'ruang';
    protected $fillable = ['id', 'nama_ruang', 'pj_ruang'];

    public function jadwal(){
        return $this->belongsTo(Jadwal::class);
    }
}
