<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';
    protected $fillable = [
        'name',
        'asset_tag',
        'serial',
        'order_number',
        'purchase_cost',
        'notes',
        'created_at',
        'updated_at',
        'purchase_date',
        'expected_checkin',
        'next_audit_date',
        'last_audit_date',
        'status_terpakai'
    ];
}
