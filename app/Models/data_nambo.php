<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_nambo extends Model
{
    use HasFactory;
    protected $table = 'data_nambos';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nama_stasiun',
        'orders',
        'stok_awal',
        'output',
        'input',
        'tanggal'
    ];
}
