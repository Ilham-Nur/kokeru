<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisKondisi extends Model
{
    use HasFactory;
    protected $table = 'inventaris_kondisis';
    protected $guarded = ['id'];

    public function inventarisSarana(){
        return $this->belongsTo(InventarisSarana::class);
    }
}
