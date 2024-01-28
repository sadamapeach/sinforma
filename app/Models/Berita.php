<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'id_berita',
        'nama',
        'gambar',
        'nip_admin',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'nip_admin');
    }
}
