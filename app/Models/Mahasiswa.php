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
        'univ',
        'alamat',
        'no_telepon',
        'iduser',
        'foto',
        'status',
        'username',
        'password',
        'nip'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'nip');
    }
}
