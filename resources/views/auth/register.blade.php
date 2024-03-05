<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
         
        <div>
            <x-input-label for="cni" :value="__('cni')" />
            <x-text-input id="cni" class="block mt-1 w-full" type="text" name="cni" :value="old('cni')" required autofocus autocomplete="cni" />
            <x-input-error :messages="$errors->get('cni')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="telephone" :value="__('telephone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required autofocus autocomplete="telephone" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="type_compte" :value="__('type_compte')" />
            <select id="type_compte" class="block mt-1 w-full"  name="type_compte" :value="old('type_compte')" required autofocus autocomplete="type_compte" >
            <option value="courant">courant</option>
            <option value="epargne">epargne</option>
            </select>
            <x-input-error :messages="$errors->get('type_compte')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="pack" :value="__('pack')" />
            <select id="pack" class="block mt-1 w-full"  name="pack" :value="old('pack')" required autofocus autocomplete="pack" >
                <option value="standard">Pack Standard</option>
                <option value="premium">Pack Premium</option>
                <option value="gold">Pack Gold</option>
            </select>
            <x-input-error :messages="$errors->get('pack')" class="mt-2" />
        </div>


                <!-- <div>
                    <label for="cin" class="block font-medium text-sm text-gray-700">CIN</label>
                    <input id="cin" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" name="cin" required>
                </div>

                <div>
                    <label for="telephone" class="block font-medium text-sm text-gray-700">Téléphone</label>
                    <input id="telephone" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" name="telephone" required>
                </div>

                <div>
                    <label for="type_compte" class="block font-medium text-sm text-gray-700">Choisir le type de compte</label>
                    <select id="type_compte" name="type_compte" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                        <option value="standard">courant</option>
                        <option value="premium">epargne</option>
                        
                    </select>
                </div>

                <div>
                    <label for="pack" class="block font-medium text-sm text-gray-700">Choisir le pack</label>
                    <select id="pack" name="pack" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                        <option value="standard">Pack Standard</option>
                        <option value="premium">Pack Premium</option>
                        <option value="gold">Pack Gold</option>
                    </select>
                </div> -->
                
                <!-- Fin des nouveaux champs -->

                <!-- Reste du formulaire inchangé -->
                <!-- ... -->

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
