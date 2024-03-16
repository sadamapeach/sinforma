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
        'bidang',
        'alamat',
        'no_telepon',
        'email',
        'id_user',
        'username',
        'nip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'nip_mentor', 'nip');
    }
    
    public function generatedProgress()
    {
        return $this->hasMany(GeneratedProgress::class, 'nip_mentor', 'nip');
    }

    public function getImageURL(){
        if($this->foto){
            return url("storage/" . $this->foto);
        }
        return "https://freesvg.org/img/abstract-user-flat-4.png";
    }
}
