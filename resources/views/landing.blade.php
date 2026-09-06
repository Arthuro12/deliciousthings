<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, viewport-fit=cover"
    >

    <title>
        Deliciousthings | Exploring problems, building useful things
    </title>

    <meta
        name="description"
        content="Deliciousthings is an independent product lab exploring real problems and building useful digital products with real people."
    >

    <link rel="icon" href="/favicon.png" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" size="180×180" href="/apple-touch-icon.png">

    @vite(['resources/css/pages/landing.scss'])
</head>

<body>

    <header class="site-header">
        <div class="container site-header__inner">

            <a
                href="{{ route('landing') }}"
                class="logo"
                aria-label="Deliciousthings"
            >
                <x-icons.logo class="logo__image" />
            </a>

            <nav
                class="site-nav"
                aria-label="Main navigation"
            >
                <a href="#products">
                    Products
                </a>

                <a href="#approach">
                    Approach
                </a>

                <a href="#build">
                    Build in public
                </a>
            </nav>

            <a
                href="#newsletter"
                class="button button--small"
            >
                Follow the build
            </a>

        </div>
    </header>


    <main>

        {{-- Hero --}}
        <section class="hero">
            <div class="container">

                <div class="hero__content">

                    <span class="eyebrow">
                        Deliciousthings
                    </span>

                    <h1>
                        We explore problems
                        <span>and build useful things.</span>
                    </h1>

                    <p class="hero__description">
                        Deliciousthings is an independent product lab.
                        We explore real problems, prototype ideas and
                        build digital products together with the people
                        who use them.
                    </p>

                    <div class="hero__actions">

                        <a
                            href="#products"
                            class="button"
                        >
                            Discover what we're building
                        </a>

                        <a
                            href="#approach"
                            class="text-link"
                        >
                            Our approach
                            <span aria-hidden="true">→</span>
                        </a>

                    </div>

                </div>

                <div class="hero__note">

                    <span class="hero__note-dot"></span>

                    <span>
                        Currently building our first product in public.
                    </span>

                </div>

            </div>
        </section>


        {{-- First product --}}
        <section
            id="products"
            class="product-section"
        >
            <div class="container">

                <div class="product-intro">

                    <div>

                        <span class="eyebrow">
                            First product
                        </span>

                        <h2>
                            Meet VoirBB.
                        </h2>

                    </div>

                    <div class="product-intro__description">

                        <p class="product-label">
                            A Deliciousthings product
                        </p>

                        <p>
                            A place to discover creations, explore ideas
                            and find inspiration for something you want
                            to create yourself.
                        </p>

                    </div>

                </div>


                <div class="product-card">

                    <div class="product-card__content">

                        <span class="product-card__badge">
                            Currently exploring
                        </span>

                        <h3>
                            Inspiration for
                            what you want to create.
                        </h3>

                        <p>
                            VoirBB explores a simple question:
                            what if discovering other people's creations
                            could help you figure out what you want
                            to create yourself?
                        </p>

                        <p>
                            Browse creations, discover styles,
                            collect ideas and use them as a starting
                            point for your own project.
                        </p>

                        <a
                            href="#newsletter"
                            class="button button--light"
                        >
                            Follow VoirBB
                        </a>

                    </div>


                    <div class="product-card__visual">

                        <div class="product-window">

                            <div class="product-window__header">

                                <div class="product-window__brand">
                                    VoirBB
                                </div>

                                <div class="product-window__dots">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>

                            </div>


                            <div class="product-window__body">

                                <div class="product-window__headline">
                                    Find something
                                    worth creating.
                                </div>

                                <div class="product-grid">

                                    <div class="creation creation--large">
                                        <span>Creation</span>
                                    </div>

                                    <div class="creation">
                                        <span>Idea</span>
                                    </div>

                                    <div class="creation">
                                        <span>Style</span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="product-footer">

                    <span>
                        Built by Deliciousthings
                    </span>

                    <span>
                        Exploring discovery, inspiration and creation
                    </span>

                </div>

            </div>
        </section>


        {{-- Problem --}}
        <section class="section section--soft">

            <div class="container">

                <div class="problem-grid">

                    <div>

                        <span class="eyebrow">
                            The problem
                        </span>

                    </div>

                    <div>

                        <h2>
                            Inspiration is everywhere.
                            Finding the right inspiration isn't.
                        </h2>

                        <p>
                            We already have countless platforms where
                            people share beautiful things.
                        </p>

                        <p>
                            But discovering something you like is only
                            the beginning. The harder part is turning
                            that inspiration into an idea that actually
                            fits what you want to create.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        {{-- Product experience --}}
        <section class="section">

            <div class="container">

                <div class="section-heading">

                    <span class="eyebrow">
                        The idea behind VoirBB
                    </span>

                    <h2>
                        From “I like this”
                        to “I want to create this.”
                    </h2>

                    <p>
                        VoirBB is exploring a more intentional way
                        to discover and use inspiration.
                    </p>

                </div>


                <div class="experience">

                    <article class="experience-card">

                        <span class="experience-card__number">
                            01
                        </span>

                        <h3>
                            Discover
                        </h3>

                        <p>
                            Explore real creations from different
                            people, styles and contexts.
                        </p>

                    </article>


                    <article class="experience-card">

                        <span class="experience-card__number">
                            02
                        </span>

                        <h3>
                            Explore
                        </h3>

                        <p>
                            Go beyond a single image and understand
                            what makes a creation interesting to you.
                        </p>

                    </article>


                    <article class="experience-card">

                        <span class="experience-card__number">
                            03
                        </span>

                        <h3>
                            Get inspired
                        </h3>

                        <p>
                            Collect ideas and identify the elements
                            you would like to bring into your own project.
                        </p>

                    </article>


                    <article class="experience-card">

                        <span class="experience-card__number">
                            04
                        </span>

                        <h3>
                            Create
                        </h3>

                        <p>
                            Turn inspiration into a starting point
                            for something personal.
                        </p>

                    </article>

                </div>

            </div>

        </section>


        {{-- Approach --}}
        <section
            id="approach"
            class="section section--soft"
        >

            <div class="container">

                <div class="section-heading">

                    <span class="eyebrow">
                        How we build
                    </span>

                    <h2>
                        Start with the problem.
                        Build with people.
                    </h2>

                    <p>
                        We don't assume that the first idea is the right one.
                        We use prototypes, conversations and real usage
                        to find out what is actually useful.
                    </p>

                </div>


                <div class="process">

                    <article class="process-card">

                        <span class="process-card__number">
                            01
                        </span>

                        <h3>
                            Explore
                        </h3>

                        <p>
                            Understand the problem before deciding
                            what the solution should look like.
                        </p>

                    </article>


                    <article class="process-card">

                        <span class="process-card__number">
                            02
                        </span>

                        <h3>
                            Prototype
                        </h3>

                        <p>
                            Turn ideas into tangible interfaces,
                            workflows and small products.
                        </p>

                    </article>


                    <article class="process-card">

                        <span class="process-card__number">
                            03
                        </span>

                        <h3>
                            Test
                        </h3>

                        <p>
                            Put ideas in front of real people
                            and observe what actually happens.
                        </p>

                    </article>


                    <article class="process-card">

                        <span class="process-card__number">
                            04
                        </span>

                        <h3>
                            Learn
                        </h3>

                        <p>
                            Keep what works, rethink what doesn't
                            and decide what deserves to be built next.
                        </p>

                    </article>

                </div>

            </div>

        </section>


        {{-- Build in public --}}
        <section
            id="build"
            class="build-section"
        >

            <div class="container">

                <div class="build-card">

                    <div class="build-card__content">

                        <span class="eyebrow">
                            Build in public
                        </span>

                        <h2>
                            See how VoirBB
                            comes to life.
                        </h2>

                        <p>
                            Prototypes, experiments, decisions,
                            feedback and lessons learned.
                            We share the process as we build.
                        </p>

                        <a
                            href="#newsletter"
                            class="button button--light"
                        >
                            Follow the journey
                        </a>

                    </div>


                    <div class="build-card__visual">

                        <div class="visual-window">

                            <div class="visual-window__header">

                                <span></span>
                                <span></span>
                                <span></span>

                            </div>

                            <div class="visual-window__content">

                                <div class="visual-label">
                                    VoirBB / Prototype
                                </div>

                                <div class="visual-line visual-line--large"></div>
                                <div class="visual-line"></div>
                                <div class="visual-line visual-line--short"></div>

                                <div class="visual-block"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- Newsletter CTA --}}
        <section
            id="newsletter"
            class="newsletter"
        >

            <div class="container">

                <div class="newsletter__content">

                    <span class="eyebrow">
                        Follow the build
                    </span>

                    <h2>
                        See what we build next.
                    </h2>

                    <p>
                        Get occasional updates about VoirBB,
                        new experiments and what we're learning
                        along the way.
                    </p>


                    <form
                        action="{{ route('newsletter.subscribe') }}"
                        method="POST"
                        class="newsletter-form"
                    >
                        @csrf

                        <div class="newsletter-form__field">

                            <label
                                for="email"
                                class="sr-only"
                            >
                                Email address
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                placeholder="Your email address"
                                autocomplete="email"
                                required
                                value="{{ old('email') }}"
                            >

                            <button
                                type="submit"
                                class="button"
                            >
                                Subscribe
                            </button>

                        </div>

                        <span class="newsletter-form__hint">
                            No spam. Just product experiments and progress.
                        </span>

                        @error('email')
                            {{-- <p class="newsletter-form__error">
                                {{ $message }}
                            </p> --}}
                            <x-ui.alert variant="error">
                                {{ $message }}
                            </x-ui.alert>
                        @enderror

                        @if (session('newsletter_success'))
                            {{-- <p class="newsletter-form__success">
                                {{ session('newsletter_success') }}
                            </p> --}}
                            <x-ui.alert variant="success">
                                {{ session('newsletter_success') }}
                            </x-ui.alert>
                        @endif

                    </form>

                </div>

            </div>

        </section>

    </main>


    <footer class="site-footer">

        <div class="container site-footer__inner">

            <div class="site-footer__brand">

                <div class="footer-logo">
                    <x-icons.logo class="footer-logo__image" />
                </div>

            </div>


            <div class="site-footer__meta">

                <span>
                    Building useful things.
                </span>

                <span>
                    © {{ date('Y') }} Deliciousthings
                </span>

            </div>

        </div>

    </footer>

</body>
</html>
