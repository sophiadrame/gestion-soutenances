<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <div style="position:relative;">
                <input id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    style="border:1px solid #d1d5db; padding:8px 12px; width:100%; border-radius:6px; font-size:14px;">
                <button type="button" onclick="togglePass('password', 'eye1')"
                    style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer;">
                    <span id="eye1" style="font-size:20px;">👁️</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmer mot de passe -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <div style="position:relative;">
                <input id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    style="border:1px solid #d1d5db; padding:8px 12px; width:100%; border-radius:6px; font-size:14px;">
                <button type="button" onclick="togglePass('password_confirmation', 'eye2')"
                    style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer;">
                    <span id="eye2" style="font-size:20px;">👁️</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Déjà inscrit ?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __("S'inscrire") }}
            </x-primary-button>
        </div>

        <script>
        function togglePass(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.textContent = '🙈';
            } else {
                field.type = 'password';
                icon.textContent = '👁️';
            }
        }
        </script>

    </form>
</x-guest-layout>