<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_master extends Model
{
    use HasFactory;
    protected $table = 'data_masters';
    protected $primaryKey = 'id';
    protected $fillable = [
        'total_order',
        'stok_awn',
        'stok_nambo',
        'stok',
    ];
}
