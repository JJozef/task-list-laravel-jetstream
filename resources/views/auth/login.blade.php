<x-guest-layout>
    @section('title', 'Iniciar sesión')
    <x-authentication-card>
        <div class="box-form-login">
            <div class="text-box-login">
                <h1>Iniciar sesión</h1>
            </div>
            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                </div>
                <div class="block mt-3">
                    <label for="remember_me">
                        <x-checkbox id="remember_me" name="remember" class="cursor-pointer" />
                        <span
                            class="ml-2 text-sm color-1fx3 color-1fx3-h cursor-pointer select-none">{{ __('Recuerdame') }}</span>
                    </label>
                </div>
                <div class="flex items-center mt-4">
                    <x-button class="w-full text-center">
                        {{ __('Iniciar sesión') }}
                    </x-button>
                </div>
                <div class="flex flex-col mt-4">
                    {{-- @if (Route::has('password.request'))
                        <a class="underline text-sm color-1fx3 color-1fx3-h mb-3 max-md:text-center "
                            href="{{ route('password.request') }}">
                            {{ __('Olvidaste tu contraseña?') }}
                        </a>
                    @endif --}}
                    <span class="text-xs mb-3">Al continuar con Google o tu email, aceptas los
                        <a target="_blank" href=" {{ route('terms.show') }}"
                            class="underline text-sm color-1fx3 color-1fx3-h">{{ __('Términos de servicio') }}</a>
                        y la
                        <a target="_blank" href=" {{ route('policy.show') }}"
                            class="underline text-sm color-1fx3 color-1fx3-h">{{ __('Política de privacidad') }}</a>
                        de To-Do
                        Hero.</span>

                    <div class="text-sm text-center">
                        ¿No tienes cuenta?
                        <a href="{{ route('register') }}"
                            class="text-sm underline color-1fx3 color-1fx3-h">Regístrate</a>
                    </div>

                </div>
            </form>
        </div>
        <div class="form-image-animation">
            <img src="images/login-banner.gif" alt="">
        </div>
    </x-authentication-card>
</x-guest-layout>
