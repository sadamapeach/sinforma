<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skl extends Model
{
    use HasFactory;

    protected $table = 'skl';
    protected $primaryKey = 'id_skl';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_skl',
        'file_skl',
        'nim',
        'nip_admin'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'nip');
    }
}
