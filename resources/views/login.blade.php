<x-layout.auth title="Anmelden">
    <x-slot:login>
        @vite(['resources/css/pages/login.scss']);
    </x-slot:login>
    <main class="login-page">
        <header>
            <a
                aria-label="Deliciousthings Homeseite"
                href="{{ route('home') }}"
            ><x-icons.logo /></a>
        </header>

        <div>
            <h1>Anmelden</h1>

            <form method="POST" action="/login">
                @csrf

                <div>
                    <div>
                        <label for="email">E-Mail-Adresse</label>
                        <input id="email" type="email" name="email" />
                    </div>
                    <div>
                        <label for="password">Passwort</label>
                        <input id="password" type="password" name="password" />
                    </div>
                    <button type="submit">Anmelden</button>
                </div>
            </form>
        </div>
    </main>
</x-layout.auth>