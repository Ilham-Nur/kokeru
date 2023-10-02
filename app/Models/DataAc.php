<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAc extends Model
{
    use HasFactory;
    protected $table = 'data_ac';
    protected $guarded = ['id'];
    
    public function dataAcs(){
        return $this->hasMany(MaintananceAc::class, 'data_ac_id');
    }
}
