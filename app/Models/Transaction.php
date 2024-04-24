<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

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
    public function getPlafond($pack)
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
    public function effectuerTransaction(User $emetteur, User $beneficiaire, $montant)
{
    switch ($beneficiaire->pack) {
        case 'standard':
            $plafond = 1000000; // 1 000 000
            break;
        case 'premium':
            $plafond = 5000000; // 5 000 000
            break;
        case 'gold':
            $plafond = 10000000; // 10 000 000
            break;
        default:
            $plafond = 0;
    }
    
    if ($montant > $plafond) {
        throw ValidationException::withMessages(['montant' => 'Dépassement du plafond pour effectuer la transaction.']);
    }

    if ($emetteur->solde < $montant) {
        throw ValidationException::withMessages(['montant' => 'Solde insuffisant pour effectuer la transaction.']);
    }

    $emetteur->solde -= $montant;
    $beneficiaire->solde += $montant;

    $emetteur->save();
    $beneficiaire->save();

    $this->emetteur_id = $emetteur->id;
    $this->beneficiaire_id = $beneficiaire->id;
    $this->montant = $montant;
    $this->notification = "transaction effectuer";
    $this->save();

    return true;
}
public function depot(User $guichet, User $beneficiaire, $montant)
{
    switch ($beneficiaire->pack) {
        case 'standard':
            $plafond = 1000000; // 1 000 000
            break;
        case 'premium':
            $plafond = 5000000; // 5 000 000
            break;
        case 'gold':
            $plafond = 10000000; // 10 000 000
            break;
        default:
            $plafond = 0;
    }
    
    if ($montant > $plafond) {
        throw ValidationException::withMessages(['montant' => 'Dépassement du plafond pour effectuer la transaction.']);
    }

    

   
    $beneficiaire->solde += $montant;

    
    $beneficiaire->save();
    $guichet->save();

    $this->emetteur_id = $guichet->id;
    $this->beneficiaire_id = $beneficiaire->id;
    $this->montant = $montant;
    $this->notification = "transaction effectuer";
    $this->save();

    return true;
}
    
    use HasFactory;
}
