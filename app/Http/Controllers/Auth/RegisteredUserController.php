<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Carte;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use App\Notifications\WelcomeNotification;
use App\Mail\NewAccountMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cni' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'type_compte' => ['required', 'string', 'max:255'],
            'pack' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cni' => $request->cni,
            'telephone' => $request->telephone,
            'type_compte' => $request->type_compte,
            'pack' => $request->pack,

        ]);
        // Envoyer la notification de bienvenue
        //$user->notify(new WelcomeNotification());
        //Mail::to($user->email)->send(new NewAccountMail($user));
        function generateRandomCardNumber(): string
        {
            $blocks = [];
            for ($i = 0; $i < 4; $i++) {
                $block = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
                $blocks[] = $block;
            }
            return implode(' ', $blocks);
        }
        
        function generateRandomCardDate(): string
        {
            $month = str_pad(mt_rand(1, 12), 2, '0', STR_PAD_LEFT);
            $year = str_pad(mt_rand(22, 27), 2, '0', STR_PAD_LEFT);
            return $month . '/' . $year;
        }
        
        function generateRandomCardExpiration(): string
        {
            $month = str_pad(mt_rand(1, 12), 2, '0', STR_PAD_LEFT);
            $year = str_pad(mt_rand(30, 35), 2, '0', STR_PAD_LEFT);
            return $month . '/' . $year;
        }
        
        function generateRandomCVV(): string
        {
            return str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
        }

        event(new Registered($user));
        // Génération des informations de carte aléatoires
        $cardNumber = generateRandomCardNumber();
        $Datecard = generateRandomCardDate();
        $expirationDate = generateRandomCardExpiration();
        $cvv = generateRandomCVV();

        // Création de la carte et liaison avec l'utilisateur
        $card = Carte::create([
            'user_id' => $user->id,
            'numero_carte' => $cardNumber,
            'date_carte' => $Datecard,
            'date_expiration' => $expirationDate,
            'cvv' => $cvv,
            // autres champs de la carte
        ]);

        // Liaison de la carte à l'utilisateur
        $user->carte()->save($card);
        $user->generateRib();

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    
}
