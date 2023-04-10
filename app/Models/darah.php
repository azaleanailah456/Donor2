<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class darah extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'umur',
        'bb',
        'no_telp',
        'pesan',
        'donor',
        'foto',
    ];

    public function response()
    {
        return $this->hasOne
        (Response::class);
    }
}
