<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <h3>Informations du compte :</h3>
                <p>RIB : {{ $user->rib }}</p>
                <p>Nom : {{ $user->name }}</p>
                <p>CIN : {{ $user->cni }}</p>
                <p>Téléphone : {{ $user->telephone }}</p>
                <p>Email : {{ $user->email }}</p>
                <p>Type de compte : {{ $user->type_compte }}</p>
                <p>Solde : {{ $user->solde }}</p>
                </div>
            </div>
            <div class="card mt-4">
            <div class="card-body">
                <h3>Carte bancaire :</h3>
                <div class="card-design">
                    <!-- Ajoutez ici le code HTML et CSS pour le design de la carte bancaire -->
                </div>
            </div>
        </div>

        <div class="mt-4">
        @if ($user->type_compte === 'courant')
            <a href="{{ route('envoyer_argent') }}" class="btn btn-primary">Envoyer de l'argent</a>
        @endif
        @if ($user->emetteurTransactions->isNotEmpty() || $user->beneficiaireTransactions->isNotEmpty())
            <a href="{{ route('transactions') }}" class="btn btn-primary">Voir mes transactions</a>
        @endif
            
        </div>
        </div>
        
    </div>
</x-app-layout>
