<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasUuids;

    public    $incrementing = false;
    protected $keyType = 'string';
    protected $table = "perfis";
    protected $guarded = [];

    public function users() {
        return $this->hasMany(User::class);
    }
}
