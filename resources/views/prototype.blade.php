<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Deliciousthings – Entdecke Kreationen</title>

    @vite(['resources/css/app.css'])

    <style>
        /*
        |--------------------------------------------------------------------------
        | Prototype-specific tokens
        |--------------------------------------------------------------------------
        | Die bestehenden Design-Tokens des Projekts werden bevorzugt.
        | Diese Fallbacks sorgen dafür, dass der Prototyp auch isoliert
        | dargestellt werden kann.
        */

        :root {
            --prototype-primary: var(--color-primary-600, #d93668);
            --prototype-primary-dark: var(--color-primary-700, #bd2856);

            --prototype-chocolate: var(--color-secondary-900, #3a211b);

            --prototype-neutral-50: var(--color-neutral-50, #fcfaf9);
            --prototype-neutral-100: var(--color-neutral-100, #f8f1ee);
            --prototype-neutral-200: var(--color-neutral-200, #eee4df);
            --prototype-neutral-500: var(--color-neutral-500, #84746e);
            --prototype-neutral-900: var(--color-neutral-900, #241a17);
        }

        .prototype-page {
            min-height: 100vh;
            background: var(--prototype-neutral-50);
            color: var(--prototype-neutral-900);
        }

        .prototype-container {
            width: min(1180px, calc(100% - 40px));
            margin-inline: auto;
        }

        /* Header */

        .prototype-header {
            height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .prototype-logo {
            color: var(--prototype-chocolate);
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            text-decoration: none;
        }

        .prototype-nav {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .prototype-nav a {
            color: var(--prototype-neutral-500);
            font-size: .9rem;
            font-weight: 500;
            text-decoration: none;
        }

        .prototype-nav a:hover {
            color: var(--prototype-neutral-900);
        }

        .prototype-nav-cta {
            padding: 10px 16px;
            border-radius: 999px;
            background: var(--prototype-primary);
            color: white !important;
        }

        /* Hero */

        .prototype-hero {
            display: grid;
            grid-template-columns: minmax(0, .9fr) minmax(0, 1.1fr);
            align-items: center;
            gap: 80px;
            min-height: 650px;
            padding: 70px 0 100px;
        }

        .prototype-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            color: var(--prototype-primary);
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .prototype-eyebrow::before {
            content: "";
            width: 24px;
            height: 1px;
            background: currentColor;
        }

        .prototype-hero h1 {
            max-width: 600px;
            margin: 0;
            color: var(--prototype-chocolate);
            font-size: clamp(3rem, 6vw, 5.4rem);
            font-weight: 700;
            line-height: .98;
            letter-spacing: -.055em;
        }

        .prototype-hero h1 span {
            color: var(--prototype-primary);
        }

        .prototype-hero-copy {
            max-width: 500px;
            margin: 28px 0 34px;
            color: var(--prototype-neutral-500);
            font-size: 1.08rem;
            line-height: 1.7;
        }

        .prototype-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .prototype-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 22px;
            border-radius: 999px;
            font-size: .9rem;
            font-weight: 650;
            text-decoration: none;
            transition: transform .2s ease, background .2s ease;
        }

        .prototype-button:hover {
            transform: translateY(-1px);
        }

        .prototype-button-primary {
            background: var(--prototype-primary);
            color: white;
        }

        .prototype-button-primary:hover {
            background: var(--prototype-primary-dark);
        }

        .prototype-button-secondary {
            color: var(--prototype-chocolate);
            background: transparent;
        }

        /* Inspiration visual */

        .prototype-showcase {
            position: relative;
        }

        .prototype-main-image {
            aspect-ratio: 4 / 4.5;
            overflow: hidden;
            border-radius: 28px;
            background: var(--prototype-neutral-100);
        }

        .prototype-main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .prototype-floating-card {
            position: absolute;
            right: -30px;
            bottom: 35px;
            width: 220px;
            padding: 18px;
            border: 1px solid rgba(36, 26, 23, .06);
            border-radius: 18px;
            background: rgba(255, 255, 255, .94);
            box-shadow: 0 18px 50px rgba(36, 26, 23, .12);
        }

        .prototype-floating-label {
            margin-bottom: 8px;
            color: var(--prototype-neutral-500);
            font-size: .72rem;
            font-weight: 600;
        }

        .prototype-floating-title {
            color: var(--prototype-chocolate);
            font-size: .95rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .prototype-floating-action {
            margin-top: 12px;
            color: var(--prototype-primary);
            font-size: .75rem;
            font-weight: 700;
        }

        /* Intro */

        .prototype-intro {
            padding: 110px 0;
            text-align: center;
        }

        .prototype-intro h2 {
            max-width: 720px;
            margin: 0 auto 20px;
            color: var(--prototype-chocolate);
            font-size: clamp(2rem, 4vw, 3.4rem);
            line-height: 1.08;
            letter-spacing: -.045em;
        }

        .prototype-intro p {
            max-width: 570px;
            margin: auto;
            color: var(--prototype-neutral-500);
            line-height: 1.7;
        }

        /* Steps */

        .prototype-steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            padding-bottom: 120px;
        }

        .prototype-step {
            min-height: 250px;
            padding: 30px;
            border-radius: 22px;
            background: var(--prototype-neutral-100);
        }

        .prototype-step-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            margin-bottom: 50px;
            border-radius: 50%;
            background: white;
            color: var(--prototype-primary);
            font-size: .8rem;
            font-weight: 750;
        }

        .prototype-step h3 {
            margin: 0 0 10px;
            color: var(--prototype-chocolate);
            font-size: 1.1rem;
        }

        .prototype-step p {
            margin: 0;
            color: var(--prototype-neutral-500);
            font-size: .9rem;
            line-height: 1.6;
        }

        /* CTA */

        .prototype-cta {
            margin-bottom: 40px;
            padding: 80px 40px;
            border-radius: 30px;
            background: var(--prototype-chocolate);
            text-align: center;
        }

        .prototype-cta h2 {
            max-width: 650px;
            margin: 0 auto 18px;
            color: white;
            font-size: clamp(2rem, 4vw, 3.2rem);
            line-height: 1.05;
            letter-spacing: -.04em;
        }

        .prototype-cta p {
            max-width: 500px;
            margin: 0 auto 30px;
            color: rgba(255,255,255,.65);
            line-height: 1.6;
        }

        /* Footer */

        .prototype-footer {
            display: flex;
            justify-content: space-between;
            padding: 30px 0;
            color: var(--prototype-neutral-500);
            font-size: .8rem;
        }

        /* Responsive */

        @media (max-width: 800px) {
            .prototype-container {
                width: min(100% - 28px, 600px);
            }

            .prototype-nav {
                display: none;
            }

            .prototype-hero {
                grid-template-columns: 1fr;
                gap: 50px;
                padding: 50px 0 80px;
            }

            .prototype-hero h1 {
                font-size: clamp(3rem, 14vw, 4.5rem);
            }

            .prototype-floating-card {
                right: 12px;
                bottom: 20px;
            }

            .prototype-intro {
                padding: 80px 0;
            }

            .prototype-steps {
                grid-template-columns: 1fr;
                padding-bottom: 80px;
            }

            .prototype-step {
                min-height: auto;
            }

            .prototype-step-number {
                margin-bottom: 35px;
            }

            .prototype-cta {
                padding: 60px 24px;
            }

            .prototype-footer {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>

<body>
<div class="prototype-page">

    <div class="prototype-container">

        {{-- Header --}}
        <header class="prototype-header">
            <a href="{{ url('/') }}" class="prototype-logo">
                deliciousthings
            </a>

            <nav class="prototype-nav">
                <a href="#entdecken">Entdecken</a>
                <a href="#wie-es-funktioniert">So funktioniert's</a>
                <a href="#start" class="prototype-nav-cta">
                    Loslegen
                </a>
            </nav>
        </header>

        {{-- Hero --}}
        <main>

            <section class="prototype-hero">

                <div>
                    <div class="prototype-eyebrow">
                        Inspiration für besondere Momente
                    </div>

                    <h1>
                        Entdecke etwas,
                        das du <span>haben möchtest.</span>
                    </h1>

                    <p class="prototype-hero-copy">
                        Entdecke besondere Torten, Kuchen und kreative
                        Backkreationen. Speichere deine Favoriten und
                        verwandle eine Inspiration in dein eigenes Projekt.
                    </p>

                    <div class="prototype-actions">
                        <a href="#entdecken"
                           class="prototype-button prototype-button-primary">
                            Kreationen entdecken
                        </a>

                        <a href="#wie-es-funktioniert"
                           class="prototype-button prototype-button-secondary">
                            Wie funktioniert's?
                        </a>
                    </div>
                </div>

                <div class="prototype-showcase">

                    <div class="prototype-main-image">
                        <img
                            src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=1000&q=85"
                            alt="Besondere Torte"
                        >
                    </div>

                    <div class="prototype-floating-card">
                        <div class="prototype-floating-label">
                            Deine Inspiration
                        </div>

                        <div class="prototype-floating-title">
                            „So etwas möchte ich für meinen Geburtstag.“
                        </div>

                        <div class="prototype-floating-action">
                            → Anfrage erstellen
                        </div>
                    </div>

                </div>

            </section>

            {{-- Intro --}}
            <section
                id="entdecken"
                class="prototype-intro"
            >
                <h2>
                    Nicht nur anschauen.
                    Etwas daraus machen.
                </h2>

                <p>
                    Manchmal sieht man eine Kreation und denkt:
                    Genau so etwas möchte ich auch.
                    Deliciousthings macht aus diesem Moment den ersten
                    Schritt zu deinem eigenen Projekt.
                </p>
            </section>

            {{-- Steps --}}
            <section
                id="wie-es-funktioniert"
                class="prototype-steps"
            >

                <article class="prototype-step">
                    <div class="prototype-step-number">01</div>

                    <h3>Entdecken</h3>

                    <p>
                        Lass dich von echten Kreationen inspirieren
                        und entdecke Ideen für Geburtstage, Hochzeiten
                        und andere besondere Momente.
                    </p>
                </article>

                <article class="prototype-step">
                    <div class="prototype-step-number">02</div>

                    <h3>Merken</h3>

                    <p>
                        Speichere Kreationen, die dir gefallen,
                        und sammle deine Inspirationen an einem Ort.
                    </p>
                </article>

                <article class="prototype-step">
                    <div class="prototype-step-number">03</div>

                    <h3>Eigenes Projekt starten</h3>

                    <p>
                        Gefällt dir eine Idee besonders?
                        Sag uns, was du daraus machen möchtest,
                        und erstelle deine Anfrage.
                    </p>
                </article>

            </section>

            {{-- CTA --}}
            <section
                id="start"
                class="prototype-cta"
            >
                <h2>
                    Deine nächste Kreation beginnt vielleicht hier.
                </h2>

                <p>
                    Entdecke Ideen, sammle Inspirationen und
                    mach daraus etwas Eigenes.
                </p>

                <a href="#entdecken"
                   class="prototype-button prototype-button-primary">
                    Jetzt entdecken
                </a>
            </section>

        </main>

        {{-- Footer --}}
        <footer class="prototype-footer">
            <span>© {{ date('Y') }} Deliciousthings</span>
            <span>Ideen, die Wirklichkeit werden.</span>
        </footer>

    </div>
</div>
</body>
</html>
