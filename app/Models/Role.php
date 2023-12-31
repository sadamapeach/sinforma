<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Nama tabel dalam database

    protected $primaryKey = 'idrole'; // Nama primary key dalam tabel

    protected $fillable = ['nama']; // Kolom yang bisa diisi secara massal

    public $timestamps = false;
}
