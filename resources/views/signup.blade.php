@use('App\Support\ValidationPatterns', 'Patterns')

<x-layout.auth.app title="Registrieren">
    <main class="auth-page signup-page page-content">
        <section class="auth-form__section">
            <div class="auth-form-wrapper">
                <header class="auth-form__header">
                    <h1 class="auth-form__headline">Dein Ort für Backprojekte</h1>
                    <span class="marketing-text">Keine Kreditkarte nötig. Dauert etwa 10 Sekunden.</span>
                </header>

                <form class="auth-form" method="POST" action="/signup">
                    @csrf

                    <div class="auth-form__group">
                        <div class="text-field">
                            <label class="text-field__label" for="first-name">Vorname (optional)</label>
                            <div class="input-wrapper">
                                <input 
                                    class="text-field__input" 
                                    id="first-name" 
                                    type="text" 
                                    name="first_name" 
                                    placeholder="Lucie"
                                    value="{{ old('first_name') }}"
                                />
                            </div>
                        </div>
                        <div class="text-field">
                            <label class="text-field__label" for="last-name">Nachname (optional)</label>
                            <div class="input-wrapper">
                                <input 
                                    class="text-field__input" 
                                    id="last-name" 
                                    type="text" 
                                    name="last_name" 
                                    placeholder="Müller"   
                                    value="{{ old('last_name') }}" 
                                />
                            </div>
                        </div>
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
                        <button class="auth-form__button" type="submit">Konto erstellen</button>
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