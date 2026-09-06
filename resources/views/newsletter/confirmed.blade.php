<x-website.layout
    title="You're in"
    description="Your Deliciousthings newsletter subscription is confirmed. Follow our products, experiments and progress as we build in public."
>
    <section class="website-confirmation">

        <div class="website-container website-confirmation__inner">

            <div class="website-confirmation__content">

                <span
                    class="website-confirmation__icon"
                    aria-hidden="true"
                >
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

                <span class="website-eyebrow">
                    Deliciousthings
                </span>

                <h1>
                    You're in.
                </h1>

                <p class="website-confirmation__description">
                    Your subscription is confirmed.
                    We'll occasionally share what we're building,
                    the experiments we're running and what we're
                    learning along the way.
                </p>

                <a
                    href="{{ route('landing') }}"
                    class="website-button website-confirmation__action"
                >
                    Back to Deliciousthings
                </a>

            </div>

        </div>

    </section>
</x-website.layout>