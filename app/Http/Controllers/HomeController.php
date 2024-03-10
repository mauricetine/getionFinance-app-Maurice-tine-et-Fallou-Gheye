<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class HomeController extends Controller
{
    public function index(){
        if(Auth::id())
        {
            $usertype=Auth()->user()->usertype;

            if ($usertype=='user') {
                $user = Auth::user(); // Récupère l'utilisateur connecté
                $carte = $user->carte; // Récupère la carte bancaire associée au compte
                return view('dashboard', compact('user', 'carte'));
            }elseif($usertype=='admin'){
               return view('admin.adminhome'); 
            
            }elseif($usertype=='guichet'){
               return view('guichet.guichethome'); 
            }
            else
            {
                return redirect()->back();
            }
            

        }
        
    }

    public function post()
    {
        return view( "post");
    }
    public function guichetpage()
    {
        return view( "guichet/guichetpage");
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
    public function envoyerArgent(Request $request)
    {
        $user = Auth::user(); // Récupère l'utilisateur connecté

        // Vérifie si l'utilisateur a un compte courant
        if ($user->type_compte === 'courant') {
            $beneficiaireId = $request->input('beneficiaire');
            $montant = $request->input('montant');
            $beneficiaire = User::find($beneficiaireId);

            // Vérifie si le montant à envoyer est inférieur ou égal au plafond du pack du bénéficiaire
            if ($beneficiaire->pack === 'standard' && $montant > 1000000) {
                return redirect()->route('envoyer_argent')->with('error', 'Le bénéficiaire ne peut pas recevoir plus de 1.000.000.');
            } elseif ($beneficiaire->pack === 'premium' && $montant > 5000000) {
                return redirect()->route('envoyer_argent')->with('error', 'Le bénéficiaire ne peut pas recevoir plus de 5.000.000.');
            } elseif ($beneficiaire->pack === 'gold' && $montant > 10000000) {
                return redirect()->route('envoyer_argent')->with('error', 'Le bénéficiaire ne peut pas recevoir plus de 10.000.000.');
            }

            // Vérifie si le solde de l'utilisateur est suffisant pour effectuer l'envoi
            if ($user->solde >= $montant) {
                // Effectue l'envoi d'argent
                // ...

                // Redirige l'utilisateur vers la page de profil avec un message de succès
                return redirect()->route('home')->with('success', 'L\'argent a été envoyé avec succès.');
            } else {
                // Redirige l'utilisateur vers la page de home avec un message d'erreur
                return redirect()->route('home')->with('error', 'Solde insuffisant pour effectuer l\'envoi d\'argent.');
            }
        } else {
            // Redirige l'utilisateur vers la page de home avec un message d'erreur
            return redirect()->route('home')->with('error', 'Vous devez avoir un compte courant pour effectuer cette opération.');
        }
    }
    public function showTransactions()
    {
        $user = Auth::user(); // Récupère l'utilisateur connecté

        return view('transactions', compact('user'));
    }
}
