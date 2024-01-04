<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $table = 'mentor';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'nim',
        'alamat',
        'no_telepon',
        'id_user',
        'username',
        'nip'
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
