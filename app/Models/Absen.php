<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absen';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_absen',
        'id_mhs',
        'keterangan',
        'foto',
        'tanggal',
        'status',
    ];

    // Relasi dengan GenerateAbsen
    public function generateAbsen()
    {
        return $this->belongsTo(GeneratedAbsen::class, 'id_absen', 'id_absen');
    }

    // Relasi dengan Mahasiswa (jika diperlukan)
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs', 'id_mhs');
    }

    public function getImageURL(){
        if($this->foto){
            return url("storage/" . $this->foto);
        }
        return "https://freesvg.org/img/abstract-user-flat-4.png";
    }
}
