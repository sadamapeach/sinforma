<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nilai1',
        'nilai2',
        'nilai3',
        'nilai4',
        'nilai_avg',
        'id_mhs',
        'nip_mentor'
    ];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'nip_mentor');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs', 'id_mhs');
    }
}
