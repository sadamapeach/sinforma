<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiburNasional extends Model
{
    use HasFactory;

    protected $table = 'libur_nasional';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'tanggal_cuti',
    ];
}
