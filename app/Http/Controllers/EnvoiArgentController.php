<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Model;

class EnvoiArgentController extends Controller
{
    public function envoyerArgent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'beneficiaire' => 'required|exists:users,id',
            'montant' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $beneficiaireId = $request->input('beneficiaire');
        $montant = $request->input('montant');
        $beneficiaire = User::find($beneficiaireId);

        $transaction = new Transaction();
        try {
            $transaction->effectuerTransaction($user, $beneficiaire, $montant);
            return redirect()->route('home')->with('success', 'L\'argent a été envoyé avec succès.');
        } catch (ValidationException $e) {
            return redirect()->route('home')->withErrors($e->errors())->withInput();
        }
    }
}