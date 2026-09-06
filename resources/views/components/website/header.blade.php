<header class="website-header">
    <div class="website-container website-header__inner">

        <a
            href="{{ route('landing') }}"
            class="website-logo"
            aria-label="Deliciousthings"
        >
            <x-icons.logo class="website-logo__image" />
        </a>

        <nav
            class="website-nav"
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
            class="website-button website-button--small"
        >
            Follow the build
        </a>

    </div>
</header>