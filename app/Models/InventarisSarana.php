<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisSarana extends Model
{
    use HasFactory;
    protected $table = 'inventaris_saranas';
    protected $guarded = ['id'];
    protected $with = ['inventarisKondisi'];

    public function inventarisKondisi(){
        return $this->hasOne(InventarisKondisi::class, 'inventaris_sarana_id');
    }
    public function inventarisKondisis(){
        return $this->hasMany(InventarisKondisi::class, 'inventaris_sarana_id');
    }
}
