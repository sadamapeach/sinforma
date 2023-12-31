<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absen';
    protected $primaryKey = 'id_absen';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_absen',
        'nim',
        'nama_mhs',
        'foto',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }
}
