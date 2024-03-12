<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Envoyer de l'argent</h3>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('envoyer_argent') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="beneficiaire">Choisir le bénéficiaire :</label>
                            <select name="beneficiaire" id="beneficiaire" class="form-control">
                                @foreach ($users as $user)
                                @if ($user->usertype === 'user')
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="montant">Montant :</label>
                            <input type="number" name="montant" id="montant" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>

        </div>
        
</x-app-layout>