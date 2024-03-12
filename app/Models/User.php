<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
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
        'rib',
        'name',
        'email',
        'cni',
        'telephone',
        'type_compte',
        'solde',
        'pack',
        'password',
        'numero_carte',
        'date_expiration',
        'cvv',

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
    public function envoyerArgent(User $beneficiaire, $montant)
    {
        // Vérifiez si le solde de l'utilisateur est suffisant pour effectuer l'envoi
        if ($this->solde >= $montant) {
            $this->solde -= $montant;
            $this->save();

            $beneficiaire->solde += $montant;
            $beneficiaire->save();

            // Créez une nouvelle transaction
            $transaction = new Transaction();
            $transaction->emetteur_id = $this->id;
            $transaction->beneficiaire_id = $beneficiaire->id;
            $transaction->montant = $montant;
            $transaction->save();

            return $transaction;
        } else {
            return null; // Le solde est insuffisant pour effectuer l'envoi
        }
    }
    public function envoyeArgent(User $beneficiaire, $montant)
    {
        $plafond = $this->getPlafond($this->pack);

        if ($montant > $plafond) {
            return false;
        }

        if ($this->solde >= $montant) {
            $this->solde -= $montant;
            $beneficiaire->solde += $montant;

            $this->save();
            $beneficiaire->save();

            $transaction = new Transaction();
            $transaction->emetteur_id = $this->id;
            $transaction->beneficiaire_id = $beneficiaire->id;
            $transaction->montant = $montant;
            $transaction->save();

            return true;
        }

        return false;
    }

    private function getPlafond($pack)
    {
        switch ($pack) {
            case 'standard':
                return 1000000; // 1 000 000
            case 'premium':
                return 5000000; // 5 000 000
            case 'gold':
                return 10000000; // 10 000 000
            default:
                return 0;
        }
    }

    public function carte()
    {
        return $this->hasMany(Carte::class, 'user_id', 'id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function generateRandomCardNumber(): string
    {
        $blocks = [];
        for ($i = 0; $i < 4; $i++) {
            $block = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $blocks[] = $block;
        }
        return implode(' ', $blocks);
    }

    public function generateRandomCardDate(): string
    {
        $month = str_pad(mt_rand(1, 12), 2, '0', STR_PAD_LEFT);
        $year = str_pad(mt_rand(22, 27), 2, '0', STR_PAD_LEFT);
        return $month . '/' . $year;
    }

    public function generateRandomCardExpiration(): string
    {
        $month = str_pad(mt_rand(1, 12), 2, '0', STR_PAD_LEFT);
        $year = str_pad(mt_rand(30, 35), 2, '0', STR_PAD_LEFT);
        return $month . '/' . $year;
    }

    public function generateRandomCVV(): string
    {
        return str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
    }

    public function generateRib()
    {
        $banque = '12345';
        $guichet = '67890';
        $compte = mt_rand(1000000000, 9999999999);
        $cleRib = mt_rand(1, 99);

        $rib = "BANQUE: {$banque}; GUICHET: {$guichet}; COMPTE: {$compte}; CLÉ RIB: {$cleRib}";

        // Génération aléatoire du numéro de carte
        $numeroCarte = $this->generateRandomCardNumber();

        // Génération aléatoire de la date d'expiration
        $dateExpiration = $this->generateRandomCardExpiration();

        // Génération aléatoire du CVV
        $cvv = $this->generateRandomCVV();

        $this->rib = $rib;
        $this->numero_carte = $numeroCarte;
        $this->date_expiration = $dateExpiration;
        $this->cvv = $cvv;
        $this->save();
    }
    use HasFactory;
}
