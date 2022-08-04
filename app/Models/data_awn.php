<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_awn extends Model
{
    use HasFactory;
    protected $table = 'data_awns';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nama_stasiun',
        'stok_awal',
        'output',
        'input',
        'tanggal'
    ];
}
