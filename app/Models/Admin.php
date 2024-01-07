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
        'id_user',
        'username',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
