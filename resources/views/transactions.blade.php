<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <h3>Historique des transactions :</h3>
        <ul>
        @foreach ($user->emetteurTransactions as $transaction)
            <li>{{ $transaction->montant }} - {{ $transaction->type }}</li>
        @endforeach
        </ul>
                </div>
            </div>
            
        </div>
        <a href="{{ route('home') }}" class="btn btn-primary">Retour</a>
    </div>
</x-app-layout>
