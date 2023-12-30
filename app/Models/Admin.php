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
        'alamat',
        'no_telepon',
        'iduser',
        'foto',
        'username',
        'password',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
