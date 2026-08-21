@use('App\Support\ValidationPatterns', 'Patterns')

<x-layout.auth.app title="Registrieren">
    <main class="auth-page login-page page-content">
        <section class="login-form__section">
            <div class="login-form-wrapper">
                <header class="auth-form__header">
                    <h1 class="auth-form__headline">Bei Deliciousthings anmelden</h1>
                </header>

                <form class="auth-form" method="POST" action="/login">
                    @csrf

                    @error('message', 'login')
                        <div class="auth-form__error-box">{{ $message }}</div>
                    @enderror

                    <div class="auth-form__group">
                        <div 
                            class="text-field"
                            x-data="{ invalid: @js($errors->has('email')) }"
                            :class="{ 'text-field--invalid': invalid }"
                        >
                            <label class="text-field__label" for="email">E-Mail-Adresse</label>
                            <div class="input-wrapper">
                                <input 
                                    class="text-field__input" 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    required
                                    placeholder="lucie@beispiel.de" 
                                    pattern="{{ Patterns::EMAIL }}"
                                    value="{{ old('email') }}"
                                    @input="invalid = false"   
                                />
                                @error('email')
                                    <p 
                                        class="text-field__error"
                                        x-show="invalid"
                                    >
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>


                        <x-ui.password id="password" placeholder="••••••••" />

                        <button class="auth-form__button" type="submit">Anmelden</button>
                    </div>

                    <div class="flex justify-center mt-8">
                        <p class="auth-switch">
                            Du hast noch kein Konto?
                            <a
                                class="auth-switch__link"
                                href="{{ route('signup') }}"
                            >
                                Konto erstellen
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </section>
    </main>
</x-layout.auth.app>