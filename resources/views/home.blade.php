<x-layout.app>
    <x-slot:head>
        @vite(['resources/css/pages/home.scss'])
    </x-slot:head>

    <main class="home-page">
        <div class="page-content">   
            <section class="hero-section"> 
                <div class="hero-inner">
                    <header class="hero-header">
                        <h1 class="hero-header__headline">Klare Anfragen.<span class="hero-gradient-text">Organisierte Tortenprojekte.</span></h1>
                        <p class="hero-header__description">Erhalten Sie klare Anfragen für individuelle Kreationen. Verwalten Sie Ihre Tortenprojekte und behalten Sie alle Schritte übersichtlich an einem zentralen Ort im Blick.</p>
                    </header>
                    <div class="cta-buttons">
                        <a class="button button--primary button--header-cta" href="{{ url('/register') }}">Kostenlos loslegen</a>
                        <!-- <Link class="button button--secondary button--header-cta" href="#">Demo-Profil asehen</Link> -->
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-layout.app>