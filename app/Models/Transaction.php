<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['emetteur_id', 'beneficiaire_id', 'notification', 'montant'];

    public function emetteur()
    {
        return $this->belongsTo(User::class, 'emetteur_id', 'id');
    }

    public function beneficiaire()
    {
        return $this->belongsTo(User::class, 'beneficiaire_id', 'id');
    }
    use HasFactory;
}
