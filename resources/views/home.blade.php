<x-layout.app title="Individuelle Backkreationen finden">
    <x-slot:head>
        @vite(['resources/css/pages/home.scss'])
    </x-slot:head>

    <main class="home-page page-content">
        <section
            class="home-hero"
            aria-labelledby="home-hero-title"
        >
            <div class="home-hero__inner">
                <p class="home-hero__eyebrow">
                    Für individuelle Backkreationen
                </p>

                <h1
                    id="home-hero-title"
                    class="home-hero__title"
                >
                    Deine Wunsch-Torte
                    <span>beginnt mit einer Idee.</span>
                </h1>

                <p class="home-hero__description">
                    Beschreibe deine Wunsch-Torte, deinen Kuchen oder deine
                    individuelle Backidee. Deliciousthings hilft dir,
                    passende Bäcker:innen, Konditor:innen und Cake Designer:innen
                    zu finden.
                </p>

                <div class="home-hero__request">
                    <form
                        class="request-intent-form"
                        method="GET"
                        action="{{ url('/app/requests/create') }}"
                    >
                        <label
                            class="request-intent-form__label"
                            for="request-intent"
                        >
                            Was möchtest du backen lassen?
                        </label>

                        <textarea
                            id="request-intent"
                            name="intent"
                            class="request-intent-form__textarea"
                            rows="5"
                            maxlength="2000"
                            placeholder="Zum Beispiel: Ich suche eine elegante Hochzeitstorte für 50 Personen im Oktober. Sie soll zweistöckig sein und zu unserem Farbkonzept passen."
                            required
                        ></textarea>

                        <div class="request-intent-form__footer">
                            <span class="request-intent-form__hint">
                                Du musst noch nicht alle Details kennen.
                            </span>

                            <button
                                class="button button--primary button--md request-intent-form__submit"
                                type="submit"
                            >
                                Anfrage starten
                            </button>
                        </div>
                    </form>
                </div>

                <p class="home-hero__note">
                    Kostenlos starten · Keine Verpflichtung
                </p>
            </div>
        </section>

        <section
            class="home-process"
            aria-labelledby="home-process-title"
        >
            <div class="home-section__inner">
                <header class="home-section__header">
                    <p class="home-section__eyebrow">
                        So einfach geht's
                    </p>

                    <h2 id="home-process-title">
                        Von der Idee zur passenden Backkreation.
                    </h2>
                </header>

                <ol class="home-process__steps">
                    <li class="home-process__step">
                        <span
                            class="home-process__number"
                            aria-hidden="true"
                        >
                            01
                        </span>

                        <div>
                            <h3>Idee beschreiben</h3>

                            <p>
                                Erzähle uns in deinen eigenen Worten,
                                welche Torte, welcher Kuchen oder welche
                                Backkreation dir vorschwebt.
                            </p>
                        </div>
                    </li>

                    <li class="home-process__step">
                        <span
                            class="home-process__number"
                            aria-hidden="true"
                        >
                            02
                        </span>

                        <div>
                            <h3>Anfrage bestätigen</h3>

                            <p>
                                Wir fassen deine Wünsche zusammen, damit
                                du prüfen kannst, ob alles richtig verstanden
                                wurde.
                            </p>
                        </div>
                    </li>

                    <li class="home-process__step">
                        <span
                            class="home-process__number"
                            aria-hidden="true"
                        >
                            03
                        </span>

                        <div>
                            <h3>Passende Angebote vergleichen</h3>

                            <p>
                                Mehrere passende Bäcker:innen und
                                Konditor:innen können auf deine Anfrage
                                reagieren.
                            </p>
                        </div>
                    </li>
                </ol>
            </div>
        </section>

        <section
            class="home-artisan"
            aria-labelledby="home-artisan-title"
        >
            <div class="home-artisan__inner">
                <div class="home-artisan__content">
                    <p class="home-section__eyebrow">
                        Für Hobby-Bäcker:innen & Profis
                    </p>

                    <h2 id="home-artisan-title">
                        Erhalte mehr Anfragen, die zu dir passen.
                    </h2>

                    <p>
                        Zeige deine Backkreationen, beschreibe, was du
                        anbietest, und entscheide selbst, welche Anfragen
                        zu dir und deinen Möglichkeiten passen.
                    </p>
                </div>

                <a
                    class="button button--secondary button--radius-full"
                    href="{{ url('/signup') }}"
                >
                    Als Bäcker:in starten
                </a>
            </div>
        </section>
    </main>
</x-layout.app>
