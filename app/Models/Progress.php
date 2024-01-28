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
        'id_mhs',
        'id_progress',
        'tanggal',
        'status',
        'scan_file',
        'deskripsi',
    ];

    public function generateProgress()
    {
        return $this->belongsTo(GeneratedProgress::class, 'id_progress', 'id_progress');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs');
    }

    // public function mentor()
    // {
    //     return $this->belongsTo(Mentor::class, 'nip_mentor');
    // }

    // public function admin()
    // {
    //     return $this->belongsTo(Admin::class, 'nip_admin');
    // }
}
