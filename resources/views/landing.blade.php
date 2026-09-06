<x-website.layout
    title="Exploring problems, building useful things"
    description="Deliciousthings is an independent product lab exploring real problems and building useful digital products with real people."
>

    {{-- Hero --}}
    <section class="website-hero">

        <div class="website-container">

            <div class="website-hero__content">

                <span class="website-eyebrow">
                    Deliciousthings
                </span>

                <h1>
                    We explore problems
                    <span>and build useful things.</span>
                </h1>

                <p class="website-hero__description">
                    Deliciousthings is an independent product lab.
                    We explore real problems, prototype ideas and
                    build digital products together with the people
                    who use them.
                </p>

                <div class="website-hero__actions">

                    <a
                        href="#products"
                        class="website-button"
                    >
                        Discover what we're building
                    </a>

                    <a
                        href="#approach"
                        class="website-text-link"
                    >
                        Our approach
                        <span aria-hidden="true">→</span>
                    </a>

                </div>

            </div>

            <div class="website-hero__note">

                <span class="website-hero__note-dot"></span>

                <span>
                    Currently building our first product in public.
                </span>

            </div>

        </div>

    </section>


    {{-- First product --}}
    <section
        id="products"
        class="website-product-section"
    >

        <div class="website-container">

            <div class="website-product-intro">

                <div>

                    <span class="website-eyebrow">
                        First product
                    </span>

                    <h2>
                        Meet VoirBB.
                    </h2>

                </div>

                <div class="website-product-intro__description">

                    <p class="website-product-label">
                        A Deliciousthings product
                    </p>

                    <p>
                        A place to discover creations, explore ideas
                        and find inspiration for something you want
                        to create yourself.
                    </p>

                </div>

            </div>


            <div class="website-product-card">

                <div class="website-product-card__content">

                    <span class="website-product-card__badge">
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
                        class="website-button website-button--light"
                    >
                        Follow VoirBB
                    </a>

                </div>


                <div class="website-product-card__visual">

                    <div class="website-product-window">

                        <div class="website-product-window__header">

                            <div class="website-product-window__brand">
                                VoirBB
                            </div>

                            <div class="website-product-window__dots">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>

                        </div>


                        <div class="website-product-window__body">

                            <div class="website-product-window__headline">
                                Find something
                                worth creating.
                            </div>

                            <div class="website-product-grid">

                                <div class="website-creation website-creation--large">
                                    <span>Creation</span>
                                </div>

                                <div class="website-creation">
                                    <span>Idea</span>
                                </div>

                                <div class="website-creation">
                                    <span>Style</span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="website-product-footer">

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
    <section class="website-section website-section--soft">

        <div class="website-container">

            <div class="website-problem-grid">

                <div>
                    <span class="website-eyebrow">
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
    <section class="website-section">

        <div class="website-container">

            <div class="website-section-heading">

                <span class="website-eyebrow">
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


            <div class="website-experience">

                @foreach ([
                    [
                        'number' => '01',
                        'title' => 'Discover',
                        'description' => 'Explore real creations from different people, styles and contexts.',
                    ],
                    [
                        'number' => '02',
                        'title' => 'Explore',
                        'description' => 'Go beyond a single image and understand what makes a creation interesting to you.',
                    ],
                    [
                        'number' => '03',
                        'title' => 'Get inspired',
                        'description' => 'Collect ideas and identify the elements you would like to bring into your own project.',
                    ],
                    [
                        'number' => '04',
                        'title' => 'Create',
                        'description' => 'Turn inspiration into a starting point for something personal.',
                    ],
                ] as $item)

                    <article class="website-experience-card">

                        <span class="website-experience-card__number">
                            {{ $item['number'] }}
                        </span>

                        <h3>
                            {{ $item['title'] }}
                        </h3>

                        <p>
                            {{ $item['description'] }}
                        </p>

                    </article>

                @endforeach

            </div>

        </div>

    </section>


    {{-- Approach --}}
    <section
        id="approach"
        class="website-section website-section--soft"
    >

        <div class="website-container">

            <div class="website-section-heading">

                <span class="website-eyebrow">
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


            <div class="website-process">

                @foreach ([
                    [
                        'number' => '01',
                        'title' => 'Explore',
                        'description' => 'Understand the problem before deciding what the solution should look like.',
                    ],
                    [
                        'number' => '02',
                        'title' => 'Prototype',
                        'description' => 'Turn ideas into tangible interfaces, workflows and small products.',
                    ],
                    [
                        'number' => '03',
                        'title' => 'Test',
                        'description' => 'Put ideas in front of real people and observe what actually happens.',
                    ],
                    [
                        'number' => '04',
                        'title' => 'Learn',
                        'description' => "Keep what works, rethink what doesn't and decide what deserves to be built next.",
                    ],
                ] as $item)

                    <article class="website-process-card">

                        <span class="website-process-card__number">
                            {{ $item['number'] }}
                        </span>

                        <h3>
                            {{ $item['title'] }}
                        </h3>

                        <p>
                            {{ $item['description'] }}
                        </p>

                    </article>

                @endforeach

            </div>

        </div>

    </section>


    {{-- Build in public --}}
    <section
        id="build"
        class="website-build-section"
    >

        <div class="website-container">

            <div class="website-build-card">

                <div class="website-build-card__content">

                    <span class="website-eyebrow">
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
                        class="website-button website-button--light"
                    >
                        Follow the journey
                    </a>

                </div>


                <div class="website-build-card__visual">

                    <div class="website-visual-window">

                        <div class="website-visual-window__header">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                        <div class="website-visual-window__content">

                            <div class="website-visual-label">
                                VoirBB / Prototype
                            </div>

                            <div class="website-visual-line website-visual-line--large"></div>
                            <div class="website-visual-line"></div>
                            <div class="website-visual-line website-visual-line--short"></div>

                            <div class="website-visual-block"></div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- Newsletter --}}
    <section
        id="newsletter"
        class="website-newsletter"
    >

        <div class="website-container">

            <div class="website-newsletter__content">

                <span class="website-eyebrow">
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
                    class="website-newsletter-form"
                >
                    @csrf

                    <div class="website-newsletter-form__field">

                        <label
                            for="email"
                            class="website-sr-only"
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
                            class="website-button"
                        >
                            Subscribe
                        </button>

                    </div>

                    <span class="website-newsletter-form__hint">
                        No spam. Just product experiments and progress.
                    </span>

                    @error('email')
                        <x-ui.alert variant="error">
                            {{ $message }}
                        </x-ui.alert>
                    @enderror

                    @if (session('newsletter_success'))
                        <x-ui.alert variant="success">
                            {{ session('newsletter_success') }}
                        </x-ui.alert>
                    @endif

                </form>

            </div>

        </div>

    </section>

</x-website.layout>