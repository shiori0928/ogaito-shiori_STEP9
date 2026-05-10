<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- ユーザー名 -->
        <div>
            <x-input-label for="username" :value="__('ユーザー名')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" required autofocus />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- 氏名(漢字) -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('氏名(漢字)')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- 氏名(カナ) -->
        <div class="mt-4">
            <x-input-label for="name_kana" :value="__('氏名(カナ)')" />
            <x-text-input id="name_kana" class="block mt-1 w-full" type="text" name="name_kana" required />
            <x-input-error :messages="$errors->get('name_kana')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full"
                    type="email"
                    name="email"
                    required autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

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
                            name="password_confirmation"
                            required autocomplete="new-password" />
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
