<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_nilai',
        'nilai',
        'nim',
        'nip_mentor'
    ];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'nip');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }
}
