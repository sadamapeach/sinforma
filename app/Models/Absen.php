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
        'id',
        'id_mhs',
        'keterangan',
        'foto',
        'tanggal',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs');
    }

    public function getImageURL(){
        if($this->foto){
            return url("storage/" . $this->foto);
        }
        return "https://freesvg.org/img/abstract-user-flat-4.png";
    }
}
