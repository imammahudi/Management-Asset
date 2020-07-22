<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table = 'proyek';
    protected $fillable = ['nama_proyek', 'nama_dept', 'nama_pic', 'nama_teknisi', 'status', 'nominal', 'catatan', 'tanggal_mulai', 'tanggal_selesai'];
}
