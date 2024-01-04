<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'nip',
        'nim',
        'alamat',
        'no_telepon',
        'id_user',
        'username',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }
}
