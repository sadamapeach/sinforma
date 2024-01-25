<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedAbsen extends Model
{
    use HasFactory;

    protected $table = 'generate_absen';
    protected $primaryKey = 'id_absen';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'judul',
        'deskripsi',
        'sesi',
        'mulai_absen',
        'selesai_absen',
    ];

    public function absen()
    {
        return $this->hasMany(Absen::class, 'id_absen', 'id_absen');
    }

    public function hasFilledByMahasiswa($mahasiswaId)
    {
        return $this->absen->where('id_mhs', $mahasiswaId)->isNotEmpty();
    }
}
