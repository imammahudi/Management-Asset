<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Proyek;

class detil_proyek extends Model
{
    protected $table = 'detil_proyek';
    protected $fillable = [
        'id_proyek',
        'id_asset'
    ];
}
