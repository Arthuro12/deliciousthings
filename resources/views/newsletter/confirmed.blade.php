<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, viewport-fit=cover"
    >

    <title>
        Deliciousthings | You're in 
    </title>

    <meta
        name="description"
        content="Your Deliciousthings newsletter subscription is confirmed. Follow our products, experiments and progress as we build in public."
    >

    <link rel="icon" href="/favicon.png" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" size="180×180" href="/apple-touch-icon.png">

    @vite(['resources/css/pages/newsletter-confirmed.scss'])
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
                <a href="{{ route('landing') }}#products">
                    Products
                </a>

                <a href="{{ route('landing') }}#approach">
                    Approach
                </a>

                <a href="{{ route('landing') }}#build">
                    Build in public
                </a>
            </nav>

            <a
                href="{{ route('landing') }}#newsletter"
                class="button button--small"
            >
                Follow the build
            </a>

        </div>
    </header>


    <main>

        <section class="confirmation">

            <div class="container confirmation__inner">

                <div class="confirmation__content">

                    <span class="confirmation__icon" aria-hidden="true">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="m5 12 4 4L19 6" />
                        </svg>
                    </span>

                    <span class="eyebrow">
                        Deliciousthings
                    </span>

                    <h1>
                        You're in.
                    </h1>

                    <p class="confirmation__description">
                        Your subscription is confirmed.
                        We'll occasionally share what we're building,
                        the experiments we're running and what we're
                        learning along the way.
                    </p>

                    <div class="confirmation__action">
                        <a
                            href="{{ route('landing') }}"
                            class="button"
                        >
                            Back to Deliciousthings
                        </a>
                    </div>

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