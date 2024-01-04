<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'nim',
        'jurusan',
        'instansi',
        'alamat',
        'no_telepon',
        'email',
        'id_user',
        'foto',
        'status',
        'check_profil'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
