<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedProgress extends Model
{
    use HasFactory;

    protected $table = 'generate_progress';
    protected $primaryKey = 'id_progress';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nip_mentor',
        'judul',
        'deskripsi',
        'mulai_submit',
        'selesai_submit',
        'created_at',
        'updated_at',
    ];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'nip_mentor');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'id_progress', 'id_progress');
    }

    public function hasFilledByMahasiswa($mahasiswaId)
    {
        return $this->progress->where('id_mhs', $mahasiswaId)->isNotEmpty();
    }
}
