<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Codura — Verstehe deinen KI-generierten Code</title>

    <meta
        name="description"
        content="Codura hilft Entwickler:innen, KI-generierten Code zu verstehen, zu prüfen und bewusst zu übernehmen."
    >

    @vite(['resources/sass/app.scss'])

    <style>
        .codura-landing {
            --codura-bg: var(--color-neutral-100);
            --codura-surface: #ffffff;
            --codura-text: #241b19;
            --codura-muted: #766c68;
            --codura-border: rgba(36, 27, 25, 0.10);
            --codura-primary: #d94f8a;
            --codura-primary-dark: #b83c72;
            --codura-code: #191617;

            background: var(--codura-bg);
            color: var(--codura-text);
            font-family: Inter, sans-serif;
        }

        .codura-landing .container {
            width: min(100% - 32px, 1180px);
            margin-inline: auto;
        }

        /* ----------------------------------
        Header
        ---------------------------------- */

        .landing-header {
            padding: 18px 0;
        }

        .landing-header__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: inherit;
            text-decoration: none;
            font-weight: 700;
            letter-spacing: -0.04em;
        }

        .brand__mark {
            display: grid;
            width: 30px;
            height: 30px;
            place-items: center;
            border-radius: 9px;
            background: var(--codura-text);
            color: white;
            font-size: 14px;
        }

        .brand__name {
            font-size: 20px;
        }


        /* ----------------------------------
        Buttons
        ---------------------------------- */

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 48px;
            padding: 0 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            border: 0;
            cursor: pointer;
            transition:
                transform .2s ease,
                background .2s ease;
        }

        .button:hover {
            transform: translateY(-1px);
        }

        .button--small {
            min-height: 40px;
            padding-inline: 15px;
        }

        .button--primary {
            background: var(--codura-primary);
            color: white;
        }

        .button--primary:hover {
            background: var(--codura-primary-dark);
        }

        .button--outline {
            border: 1px solid var(--codura-border);
            color: var(--codura-text);
            background: transparent;
        }

        .button--ghost {
            color: var(--codura-text);
        }


        /* ----------------------------------
        Hero
        ---------------------------------- */

        .hero {
            padding: 72px 0 80px;
        }

        .hero__content {
            max-width: 760px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            color: var(--codura-primary-dark);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .10em;
            text-transform: uppercase;
        }

        .eyebrow__dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--codura-primary);
        }

        .hero h1 {
            margin: 0;
            font-size: clamp(48px, 12vw, 92px);
            line-height: .95;
            letter-spacing: -.065em;
        }

        .hero h1 span {
            display: block;
            color: var(--codura-muted);
        }

        .hero__lead {
            max-width: 620px;
            margin: 28px 0 0;
            color: var(--codura-muted);
            font-size: 18px;
            line-height: 1.6;
        }

        .hero__actions {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
            margin-top: 32px;
        }


        /* ----------------------------------
        Code visual
        ---------------------------------- */

        .hero-code {
            position: relative;
            margin-top: 56px;
            overflow: hidden;
            border-radius: 18px;
            background: var(--codura-code);
            box-shadow: 0 30px 80px rgba(0, 0, 0, .15);
        }

        .hero-code__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            color: rgba(255,255,255,.55);
            font-size: 11px;
        }

        .window-controls {
            display: flex;
            gap: 5px;
        }

        .window-controls span {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: rgba(255,255,255,.25);
        }

        .hero-code__status {
            color: #e5a8c5;
        }

        .hero-code__body {
            padding: 22px 16px 110px;
            overflow-x: auto;
            font-family: "SFMono-Regular", Consolas, monospace;
            font-size: 12px;
            line-height: 2;
            color: rgba(255,255,255,.75);
        }

        .code-line {
            display: flex;
            min-width: 480px;
        }

        .line-number {
            width: 32px;
            color: rgba(255,255,255,.20);
            user-select: none;
        }

        .code-line--highlight {
            margin-inline: -16px;
            padding-inline: 16px;
            background: rgba(217, 79, 138, .12);
        }

        .code-keyword {
            color: #e5a8c5;
        }

        .code-string {
            color: #d6c48c;
        }

        .understanding-card {
            position: absolute;
            right: 16px;
            bottom: 16px;
            left: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 12px;
            background: rgba(40, 35, 35, .92);
            backdrop-filter: blur(12px);
            color: white;
        }

        .understanding-card__icon {
            display: grid;
            flex: 0 0 auto;
            width: 30px;
            height: 30px;
            place-items: center;
            border-radius: 8px;
            background: var(--codura-primary);
            font-weight: 700;
        }

        .understanding-card strong {
            display: block;
            font-size: 12px;
        }

        .understanding-card p {
            margin: 3px 0 0;
            color: rgba(255,255,255,.50);
            font-size: 10px;
        }

        .understanding-card__button {
            display: none;
        }


        /* ----------------------------------
        Sections
        ---------------------------------- */

        .problem,
        .solution,
        .audience {
            padding: 88px 0;
        }

        .section-intro {
            max-width: 700px;
        }

        .section-intro--center {
            margin-inline: auto;
            text-align: center;
        }

        .section-intro h2 {
            margin: 0;
            font-size: clamp(36px, 8vw, 64px);
            line-height: 1;
            letter-spacing: -.055em;
        }

        .section-intro p {
            margin-top: 22px;
            color: var(--codura-muted);
            font-size: 17px;
            line-height: 1.65;
        }


        /* ----------------------------------
        Problem cards
        ---------------------------------- */

        .problem-grid {
            display: grid;
            gap: 12px;
            margin-top: 48px;
        }

        .problem-card {
            padding: 24px;
            border: 1px solid var(--codura-border);
            border-radius: 16px;
            background: var(--codura-surface);
        }

        .problem-card__number {
            color: var(--codura-primary);
            font-size: 12px;
            font-weight: 700;
        }

        .problem-card h3 {
            margin: 38px 0 10px;
            font-size: 20px;
            letter-spacing: -.025em;
        }

        .problem-card p {
            margin: 0;
            color: var(--codura-muted);
            line-height: 1.6;
        }


        /* ----------------------------------
        Steps
        ---------------------------------- */

        .steps {
            max-width: 820px;
            margin: 60px auto 0;
        }

        .step {
            display: grid;
            grid-template-columns: 48px 1fr;
            gap: 20px;
            padding: 28px 0;
            border-top: 1px solid var(--codura-border);
        }

        .step__number {
            font-size: 12px;
            font-weight: 700;
            color: var(--codura-primary);
        }

        .step__label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
            color: var(--codura-muted);
        }

        .step h3 {
            margin: 8px 0;
            font-size: 23px;
            letter-spacing: -.03em;
        }

        .step p {
            margin: 0;
            color: var(--codura-muted);
            line-height: 1.6;
        }


        /* ----------------------------------
        Positioning
        ---------------------------------- */

        .positioning {
            padding: 32px 0 88px;
        }

        .positioning-card {
            display: grid;
            gap: 48px;
            padding: 32px 24px;
            border-radius: 20px;
            background: var(--codura-text);
            color: white;
        }

        .positioning-card .eyebrow {
            color: #e5a8c5;
        }

        .positioning-card h2 {
            margin: 0;
            font-size: clamp(36px, 8vw, 60px);
            line-height: 1;
            letter-spacing: -.055em;
        }

        .positioning-card p {
            color: rgba(255,255,255,.62);
            line-height: 1.65;
        }

        .positioning-card strong {
            color: white;
        }

        .positioning-quote {
            padding-top: 20px;
        }

        .positioning-quote > span {
            display: block;
            font-size: 48px;
            line-height: .5;
            color: #e5a8c5;
        }

        .positioning-quote p {
            margin: 20px 0 0;
            color: white;
            font-size: 22px;
            line-height: 1.35;
            letter-spacing: -.03em;
        }


        /* ----------------------------------
        Audience
        ---------------------------------- */

        .audience-grid {
            display: grid;
            gap: 1px;
            margin-top: 48px;
            border-top: 1px solid var(--codura-border);
        }

        .audience-item {
            display: grid;
            grid-template-columns: 24px 1fr;
            gap: 12px;
            padding: 24px 0;
            border-bottom: 1px solid var(--codura-border);
        }

        .audience-item > span {
            color: var(--codura-primary);
        }

        .audience-item strong {
            font-size: 16px;
        }

        .audience-item p {
            margin: 7px 0 0;
            color: var(--codura-muted);
            font-size: 14px;
            line-height: 1.55;
        }


        /* ----------------------------------
        CTA
        ---------------------------------- */

        .cta {
            padding: 20px 0 88px;
        }

        .cta__inner {
            padding: 48px 24px;
            border-radius: 20px;
            background: #f2e6e1;
            text-align: center;
        }

        .cta h2 {
            margin: 0 auto;
            max-width: 650px;
            font-size: clamp(40px, 9vw, 72px);
            line-height: .98;
            letter-spacing: -.06em;
        }

        .cta p {
            max-width: 540px;
            margin: 22px auto;
            color: var(--codura-muted);
            line-height: 1.6;
        }

        .waitlist-form {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-width: 500px;
            margin: 30px auto 12px;
        }

        .waitlist-form input {
            min-height: 50px;
            padding: 0 16px;
            border: 1px solid var(--codura-border);
            border-radius: 12px;
            background: white;
            font: inherit;
        }

        .cta small {
            color: var(--codura-muted);
            font-size: 11px;
        }


        /* ----------------------------------
        Footer
        ---------------------------------- */

        .landing-footer {
            padding: 24px 0 40px;
            color: var(--codura-muted);
            font-size: 11px;
        }

        .landing-footer__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand--footer {
            color: var(--codura-text);
        }

        .brand--footer .brand__mark {
            width: 24px;
            height: 24px;
            border-radius: 7px;
            font-size: 11px;
        }


        /* ----------------------------------
        Desktop
        ---------------------------------- */

        @media (min-width: 768px) {

            .codura-landing .container {
                width: min(100% - 64px, 1180px);
            }

            .hero {
                padding: 120px 0 120px;
            }

            .hero__actions {
                flex-direction: row;
                align-items: center;
            }

            .hero-code {
                margin-top: 90px;
            }

            .understanding-card__button {
                display: block;
                margin-left: auto;
                padding: 7px 11px;
                border: 0;
                border-radius: 7px;
                background: var(--codura-primary);
                color: white;
                font-size: 10px;
                font-weight: 700;
            }

            .problem-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .problem-card {
                min-height: 260px;
            }

            .positioning-card {
                grid-template-columns: 1fr 1fr;
                align-items: center;
                padding: 72px;
            }

            .waitlist-form {
                flex-direction: row;
            }

            .waitlist-form input {
                flex: 1;
            }
        }
    </style>
</head>

<body class="codura-landing">

<header class="landing-header">
    <div class="container landing-header__inner">

        <a href="/" class="brand" aria-label="Codura">
            <span class="brand__mark">C</span>
            <span class="brand__name">codura</span>
        </a>

        <a href="#waitlist" class="button button--small button--outline">
            Zugang erhalten
        </a>

    </div>
</header>


<main>

    {{-- HERO --}}
    <section class="hero">
        <div class="container">

            <div class="hero__content">

                <div class="eyebrow">
                    <span class="eyebrow__dot"></span>
                    AI-assisted development
                </div>

                <h1>
                    Nutze KI.
                    <span>Verstehe deinen Code.</span>
                </h1>

                <p class="hero__lead">
                    KI kann heute große Teile einer Anwendung schreiben.
                    Codura hilft dir dabei, zu verstehen, was dabei entsteht –
                    bevor du es zu deinem Code machst.
                </p>

                <div class="hero__actions">
                    <a href="#waitlist" class="button button--primary">
                        Codura ausprobieren
                        <span>→</span>
                    </a>

                    <a href="#how-it-works" class="button button--ghost">
                        So funktioniert es
                    </a>
                </div>

            </div>


            {{-- CODE VISUAL --}}
            <div class="hero-code">

                <div class="hero-code__header">
                    <div class="window-controls">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <span class="hero-code__filename">
                        UserService.php
                    </span>

                    <span class="hero-code__status">
                        KI-generiert
                    </span>
                </div>

                <div class="hero-code__body">

                    <div class="code-line">
                        <span class="line-number">01</span>
                        <span>
                            <span class="code-keyword">public function</span>
                            createUser(...)
                        </span>
                    </div>

                    <div class="code-line">
                        <span class="line-number">02</span>
                        <span>
                            {
                        </span>
                    </div>

                    <div class="code-line code-line--highlight">
                        <span class="line-number">03</span>
                        <span>
                            $user = User::create($data);
                        </span>
                    </div>

                    <div class="code-line">
                        <span class="line-number">04</span>
                        <span>
                            event(<span class="code-string">'UserCreated'</span>);
                        </span>
                    </div>

                    <div class="code-line">
                        <span class="line-number">05</span>
                        <span>
                            <span class="code-keyword">return</span> $user;
                        </span>
                    </div>

                    <div class="code-line">
                        <span class="line-number">06</span>
                        <span>
                            }
                        </span>
                    </div>

                </div>

                <div class="understanding-card">

                    <div class="understanding-card__icon">
                        ?
                    </div>

                    <div>
                        <strong>
                            Verstehst du diese Änderung?
                        </strong>

                        <p>
                            Codura erklärt die Auswirkungen,
                            Abhängigkeiten und Annahmen.
                        </p>
                    </div>

                    <button class="understanding-card__button">
                        Prüfen
                    </button>

                </div>

            </div>

        </div>
    </section>


    {{-- PROBLEM --}}
    <section class="problem">
        <div class="container">

            <div class="section-intro">

                <div class="eyebrow">
                    Das neue Problem
                </div>

                <h2>
                    Mehr Code bedeutet nicht
                    automatisch mehr Verständnis.
                </h2>

                <p>
                    KI macht Softwareentwicklung schneller.
                    Aber Geschwindigkeit kann eine neue Lücke schaffen:
                    zwischen dem Code, den wir produzieren, und dem Code,
                    den wir tatsächlich verstehen.
                </p>

            </div>


            <div class="problem-grid">

                <article class="problem-card">

                    <span class="problem-card__number">01</span>

                    <h3>
                        Code entsteht schneller
                    </h3>

                    <p>
                        LLMs und Coding Agents können in Sekunden
                        große Mengen funktionierenden Codes erzeugen.
                    </p>

                </article>


                <article class="problem-card">

                    <span class="problem-card__number">02</span>

                    <h3>
                        Verständnis wird knapp
                    </h3>

                    <p>
                        Je mehr Code delegiert wird, desto schwieriger
                        wird es, jede Entscheidung nachvollziehen zu können.
                    </p>

                </article>


                <article class="problem-card">

                    <span class="problem-card__number">03</span>

                    <h3>
                        Verantwortung bleibt beim Menschen
                    </h3>

                    <p>
                        Wenn etwas schiefgeht, kann die Verantwortung
                        nicht an das Modell weitergegeben werden.
                    </p>

                </article>

            </div>

        </div>
    </section>


    {{-- SOLUTION --}}
    <section class="solution" id="how-it-works">

        <div class="container">

            <div class="section-intro section-intro--center">

                <div class="eyebrow">
                    Die Codura-Methode
                </div>

                <h2>
                    Die KI schreibt.
                    <span>Du entscheidest.</span>
                </h2>

                <p>
                    Codura setzt eine menschliche Verständnis- und
                    Entscheidungsschicht zwischen KI-generierten Code
                    und dein Projekt.
                </p>

            </div>


            <div class="steps">

                <article class="step">

                    <div class="step__number">
                        01
                    </div>

                    <div class="step__content">

                        <span class="step__label">
                            ÄNDERN
                        </span>

                        <h3>
                            Lass KI den Code schreiben.
                        </h3>

                        <p>
                            Nutze deinen bevorzugten LLM oder Coding Agent.
                            Codura schreibt deinen Code nicht für dich.
                        </p>

                    </div>

                </article>


                <article class="step">

                    <div class="step__number">
                        02
                    </div>

                    <div class="step__content">

                        <span class="step__label">
                            VERSTEHEN
                        </span>

                        <h3>
                            Verstehe, was sich verändert hat.
                        </h3>

                        <p>
                            Codura strukturiert Änderungen und erklärt
                            deren Zweck, Auswirkungen und relevante
                            Abhängigkeiten.
                        </p>

                    </div>

                </article>


                <article class="step">

                    <div class="step__number">
                        03
                    </div>

                    <div class="step__content">

                        <span class="step__label">
                            BESTÄTIGEN
                        </span>

                        <h3>
                            Übernimm die Verantwortung bewusst.
                        </h3>

                        <p>
                            Bestätige, dass du die Änderung verstanden hast
                            und sie in dein Projekt übernehmen möchtest.
                        </p>

                    </div>

                </article>

            </div>

        </div>

    </section>


    {{-- POSITIONING --}}
    <section class="positioning">

        <div class="container">

            <div class="positioning-card">

                <div class="positioning-card__content">

                    <div class="eyebrow">
                        Nicht gegen KI
                    </div>

                    <h2>
                        Codura will KI nicht ersetzen.
                    </h2>

                    <p>
                        Und Codura will auch nicht verhindern,
                        dass KI deinen Code schreibt.
                    </p>

                    <p>
                        Die Idee ist einfacher:
                        <strong>
                            KI soll deine Produktivität erhöhen,
                            ohne deine technische Kompetenz zu ersetzen.
                        </strong>
                    </p>

                </div>


                <div class="positioning-quote">

                    <span>„</span>

                    <p>
                        Ich muss nicht jede Zeile selbst schreiben.
                        Aber ich muss verstehen können,
                        was ich in Produktion bringe.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- AUDIENCE --}}
    <section class="audience">

        <div class="container">

            <div class="section-intro">

                <div class="eyebrow">
                    Für Entwickler:innen
                </div>

                <h2>
                    Für Menschen,
                    die schneller bauen wollen –
                    ohne die Kontrolle abzugeben.
                </h2>

            </div>


            <div class="audience-grid">

                <div class="audience-item">
                    <span>→</span>
                    <div>
                        <strong>AI-assisted Developers</strong>
                        <p>
                            Du nutzt LLMs täglich und möchtest
                            trotzdem jeden wichtigen Teil deines Systems verstehen.
                        </p>
                    </div>
                </div>


                <div class="audience-item">
                    <span>→</span>
                    <div>
                        <strong>Teams</strong>
                        <p>
                            Ihr wollt KI produktiv einsetzen,
                            ohne eure Code-Review- und Qualitätsstandards aufzugeben.
                        </p>
                    </div>
                </div>


                <div class="audience-item">
                    <span>→</span>
                    <div>
                        <strong>Solo Builder</strong>
                        <p>
                            Du baust mit KI, möchtest aber nicht irgendwann
                            vor einem System stehen, das du selbst nicht mehr verstehst.
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </section>


    {{-- WAITLIST --}}
    <section class="cta" id="waitlist">

        <div class="container">

            <div class="cta__inner">

                <div class="eyebrow">
                    Early Access
                </div>

                <h2>
                    Baue mit KI.
                    Bleib verantwortlich.
                </h2>

                <p>
                    Codura befindet sich in einer frühen Entwicklungsphase.
                    Trag dich ein und begleite den Aufbau der ersten Version.
                </p>

                <form class="waitlist-form">

                    <input
                        type="email"
                        name="email"
                        placeholder="deine@email.de"
                        autocomplete="email"
                        required
                    >

                    <button
                        type="submit"
                        class="button button--primary"
                    >
                        Zugang anfragen
                        <span>→</span>
                    </button>

                </form>

                <small>
                    Kein Spam. Nur Informationen zur Entwicklung von Codura.
                </small>

            </div>

        </div>

    </section>

</main>


<footer class="landing-footer">

    <div class="container landing-footer__inner">

        <span class="brand brand--footer">
            <span class="brand__mark">C</span>
            <span class="brand__name">codura</span>
        </span>

        <span>
            AI-assisted. Human accountable.
        </span>

    </div>

</footer>

</body>
</html>