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

                        <div
                            class="text-field"
                            x-data="{ 
                                showPassword: false,
                                invalid: @js($errors->has('password')),
                            }"
                            :class="{ 'text-field--invalid': invalid }"
                        >
                            <label class="text-field__label" for="password">Passwort</label>

                            <div class="input-wrapper">
                                <div
                                    class="password-input"
                                    :class="{ 'password-input--invalid': invalid }"
                                >
                                    <input 
                                        class="text-field__input" 
                                        id="password" 
                                        minlength="8"
                                        :type="showPassword ? 'text' : 'password'" 
                                        name="password" 
                                        required
                                        placeholder="••••••••"
                                        @input="invalid = false"
                                    />
                                    
                                    <button 
                                        type="button"
                                        @click="showPassword = !showPassword"
                                    >
                                        <svg 
                                            x-cloak
                                            x-show="showPassword"
                                            xmlns="http://www.w3.org/2000/svg" 
                                            fill="none" 
                                            viewBox="0 0 24 24" 
                                            stroke-width="1.5" 
                                            stroke="currentColor" 
                                            width="24"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                        <svg 
                                            x-show="!showPassword"
                                            xmlns="http://www.w3.org/2000/svg" 
                                            fill="none" 
                                            viewBox="0 0 24 24" 
                                            stroke-width="1.5" 
                                            stroke="currentColor" 
                                            width="24"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>
                                    </button>
                                </div>


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