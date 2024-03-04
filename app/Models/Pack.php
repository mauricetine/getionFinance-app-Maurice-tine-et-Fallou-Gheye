<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    protected $fillable = ['nom', 'age', 'plafond'];

    public function users()
    {
        return $this->hasMany(User::class, 'pack_id', 'id');
    }
    use HasFactory;
}
