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
        'alamat',
        'no_telepon',
        'id_user',
        'username',
        'nip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
