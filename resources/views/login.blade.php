<x-layout.auth.app title="Anmelden">
    <x-slot:head>
        @vite(['resources/css/pages/login.scss'])
    </x-slot:head>
    <main class="login-page">
        <div>
            <h1>Bei Deliciousthings anmelden</h1>

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
</x-layout.auth.app>