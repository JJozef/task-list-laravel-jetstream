<x-guest-layout>
    @section('title', 'Regístrate')
    <x-authentication-card>
        

        <div class="box-form-registro">
            <div class="text-box-registro">
                <h1>Regístrate</h1>
            </div>
            <x-validation-errors class="mb-4" />
            <form method="POST" action="{{ route('register') }}">
            @csrf

                <div>
                    <x-jet-label for="name" value="{{ __('Usuario') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirma Contraseña') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" class="cursor-pointer" required />

                                <div class="ml-2">
                                    {!! __('Acepto los :terms_of_service y :privacy_policy', [
                                        'terms_of_service' =>
                                            '<a target="_blank" href="' .
                                            route('terms.show') .
                                            '" class="underline text-sm color-1fx3 color-1fx3-h">' .
                                            __('Términos de servicio') .
                                            '</a>',
                                        'privacy_policy' =>
                                            '<a target="_blank" href="' .
                                            route('policy.show') .
                                            '" class="underline text-sm color-1fx3 color-1fx3-h">' .
                                            __('Política de privacidad') .
                                            '</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif
                <div class="flex items-center mt-4">
                    <x-button class="w-full">
                        {{ __('Registrarme con mi email') }}
                    </x-button>
                </div>
                <div class="flex items-center justify-center mt-4 text-sm color-1fx3">
                    ¿Ya tienes cuenta?
                    <a class="underline text-sm color-1fx3 color-1fx3-h ml-1" href="{{ route('login') }}">
                        {{ __('Inicia sesión') }}
                    </a>
                </div>
            </form>
        </div>
        <div class="form-image-animation">
            <img src="images/register-banner.gif" alt="">
        </div>
    </x-authentication-card>
</x-guest-layout>
