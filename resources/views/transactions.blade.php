<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Historique des transactions :</h3>
                    <!-- <ul>
                        @foreach ($user->emetteurTransactions as $transaction)
                        <li>{{ $transaction->montant }} - {{ $transaction->type }}</li>
                        @endforeach
                    </ul> -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Emetteur</th>
                                <th>Bénéficiaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->emetteurTransactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->montant }}</td>
                                <td>{{ $transaction->emetteur->name }}</td>
                                <td>{{ $transaction->beneficiaire->name }}</td>
                            </tr>
                            @endforeach
                            @foreach($user->beneficiaireTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->montant }}</td>
                                    <td>{{ $transaction->emetteur->name }}</td>
                                    <td>{{ $transaction->beneficiaire->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
       
    </div>
</x-app-layout>