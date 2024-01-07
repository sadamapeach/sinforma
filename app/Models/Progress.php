<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nim',
        'nip_mentor',
        'nip_admin',
        'scan_file',
        'deskripsi',
        'tanggal'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'nip');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'nip');
    }
}
