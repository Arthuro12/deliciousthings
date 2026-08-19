<x-layout.auth.app title="Registrieren">
    <x-slot:head>
        @vite(['resources/css/pages/signup.scss'])
    </x-slot:head>
    
    <main class="signup-page page-content">
        <section class="signup-section">
            <div class="signup-form-wrapper">
                <header class="signup-form__header">
                    <h1 class="auth-form__headline">Dein Ort für Backprojekte</h1>
                    <span class="marketing-text">Keine Kreditkarte nötig. Dauert etwa 10 Sekunden.</span>
                </header>

                <form class="signup-form" method="POST" action="/signup">
                    @csrf

                    <div class="signup-form__group">
                        <div class="signup-form__textfield text-field">
                            <label class="text-field__label" for="first-name">Vorname (optional)</label>
                            <div class="input-wrapper">
                                <input 
                                    class="text-field__input" 
                                    id="first-name" 
                                    type="text" 
                                    name="first_name" 
                                    placeholder="Lucie"
                                />
                            </div>
                        </div>
                        <div class="signup-form__text-field text-field">
                            <label class="text-field__label" for="last-name">Nachname (optional)</label>
                            <div class="input-wrapper">
                                <input 
                                    class="text-field__input" 
                                    id="last-name" 
                                    type="text" 
                                    name="last_name" 
                                    placeholder="Müller"    
                                />
                            </div>
                        </div>
                        <div 
                            class="signup-form__text-field text-field"
                            x-data="{ invalid: @js($errors->has('email')) }"
                            :class="{ 'text-field--invalid': invalid }"
                        >
                            <label class="text-field__label" for="email">E-Mail-Adresse</label>
                            <div class="input-wrapper">
                                <input 
                                    class="text-field__input" 
                                    id="email" 
                                    required
                                    type="email" 
                                    name="email" 
                                    placeholder="lucie@beispiel.de" 
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
                        <div 
                            class="signup-form__text-field text-field"
                            x-data="{ invalid: @js($errors->has('password')) }"
                            :class="{ 'text-field--invalid': invalid }"
                        >
                            <label class="text-field__label" for="password">Passwort</label>
                            <div class="input-wrapper">
                                <input 
                                    class="text-field__input" 
                                    id="password" 
                                    required
                                    minlength="8"
                                    type="password" 
                                    name="password" 
                                    placeholder="••••••••"
                                    @input="invalid = false"
                                />
                                @error('password')
                                    <p 
                                        class="text-field__error"
                                        x-show="invalid"
                                    >
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <button class="signup-form__button" type="submit">Konto erstellen</button>
                    </div>

                    <div class="flex justify-center mt-8">
                        <p class="auth-switch">
                            Du hast bereits ein Konto?
                            <a
                                class="auth-switch__link"
                                href="{{ route('login') }}"
                            >
                                Anmelden
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </section>
    </main>
</x-layout.auth.app>