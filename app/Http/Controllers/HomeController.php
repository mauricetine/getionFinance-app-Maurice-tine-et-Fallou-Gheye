<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Carte;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                $user = Auth::user(); // Récupère l'utilisateur connecté
                //$carte=Auth()->user()->carte;
                $carte = $user->carte; // Récupère la carte bancaire associée au compte
                       
                return view('dashboard', compact('user', 'carte'));
            } elseif ($usertype == 'admin') {
                return view('admin.adminhome');
            } elseif ($usertype == 'guichet') {
                return view('guichet.guichethome');
            } else {
                return redirect()->back();
            }
        }
    }

    public function post()
    {
        $users = User::all();
        return view('post', compact('users'));
    }
    public function guichetpage()
    {
        return view("guichet/guichetpage");
    }
    // public function profil()
    // {
    //     $user = Auth::user(); // Récupère l'utilisateur connecté
    //     $carte = $user->carte; // Récupère la carte bancaire associée au compte

    //     return view( 'dashboard' , compact('user', 'carte'));
    // }
    public function showEnvoyerArgentForm()
    {
        $users = User::all(); // Récupère tous les utilisateurs

        return view('envoyer-argent', compact('users'));
    }
    
    // public function envoyerArgent(Request $request)
    // {
    //     $user = Auth::user();
    //     $beneficiaireId = $request->input('beneficiaire');
    //     $montant = $request->input('montant');
    //     $beneficiaire = User::find($beneficiaireId);

    //     if ($user->envoyerArgent($beneficiaire, $montant)) {
    //         return redirect()->route('home')->with('success', 'L\'argent a été envoyé avec succès.');
    //     } else {
    //         return redirect()->route('home')->with('error', 'Solde insuffisant pour effectuer l\'envoi d\'argent.');
    //     }
    // }
    public function showTransactions()
    {
        $user = Auth::user(); // Récupère l'utilisateur connecté

        return view('transactions', compact('user'));
    }
    public function bloquer(User $user)
    {
        $user->etat = 0;
        $user->save();

        return redirect()->back()->with('success', 'Le compte utilisateur a été bloqué avec succès.');
    }

    public function debloquer(User $user)
    {
        $user->etat = 1;
        $user->save();

        return redirect()->back()->with('success', 'Le compte utilisateur a été débloqué avec succès.');
    }
}
