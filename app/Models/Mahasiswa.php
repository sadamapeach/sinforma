<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mhs';
    public $incrementing = false;

    protected $fillable = [
        'nama',
        'id_mhs',
        'jurusan',
        'instansi',
        'alamat',
        'no_telepon',
        'email',
        'id_user',
        'nip_admin',
        'nip_mentor',
        'foto',
        'status',
        'check_profil',
        'mulai_magang',
        'selesai_magang',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'nip_admin');
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'nip_mentor');
    }

    public function skl()
    {
        return $this->hasOne(Skl::class, 'id_mhs');
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class, 'id_mhs');
    }
}
