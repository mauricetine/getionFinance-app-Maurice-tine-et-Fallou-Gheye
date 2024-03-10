<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rib' , 
        'name',
        'email',
        'cni',
        'telephone',
        'type_compte',
        'solde',
        'pack',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }

    public function emetteurTransactions()
    {
        return $this->hasMany(Transaction::class, 'emetteur_id', 'id');
    }

    public function beneficiaireTransactions()
    {
        return $this->hasMany(Transaction::class, 'beneficiaire_id', 'id');
    }

    public function cartes()
    {
        return $this->hasMany(Carte::class, 'user_id', 'id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function generateRib()
    {
        $banque = '12345';
        $guichet = '67890';
        $compte = mt_rand(1000000000, 9999999999);
        $cleRib = mt_rand(01,99);

        $rib ="BANQUE : {$banque}; GUICHET : {$guichet}; COMPTE : {$compte} ;CLÉ RIB : {$cleRib}";

        $this->rib = $rib;
        $this->save();
    }
}
