<x-layout.auth title="Registrieren">
    <x-slot:login>
        @vite(['resources/css/pages/signup.scss']);
    </x-slot:login>
    <main class="signup-page">
        <header>
            <a
                aria-label="Deliciousthings Homeseite"
                href="{{ route('home') }}"
            ><x-icons.logo /></a>
        </header>

        <div>
            <h1>Konto erstellen</h1>

            <form method="POST" action="/signup">
                @csrf

                <div>
                    <div>
                        <label for="first-name">Vornane</label>
                        <input id="first-name" type="text" name="first_name" />
                    </div>
                    <div>
                        <label for="last-name">Nachname</label>
                        <input id="last-name" type="text" name="last_name" />
                    </div>
                    <div>
                        <label for="email">E-Mail-Adresse</label>
                        <input id="email" type="email" name="email" />
                    </div>
                    <div>
                        <label for="password">Passwort</label>
                        <input id="password" type="password" name="password" />
                    </div>
                    <button type="submit">Konto erstellen</button>
                </div>
            </form>
        </div>
    </main>
</x-layout.auth>