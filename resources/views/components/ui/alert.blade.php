@props([
    'variant' => 'success',
    'duration' => 5000,
])

@php
    $variants = [
        'success' => [
            'icon' => '✓',
            'label' => 'Success',
        ],
        'error' => [
            'icon' => '!',
            'label' => 'Error',
        ],
    ];

    $variant = array_key_exists($variant, $variants)
        ? $variant
        : 'success';

    $config = $variants[$variant];
@endphp

<div
    {{ $attributes->merge([
        'class' => "alert alert--{$variant}",
        'role' => 'alert',
        'data-alert' => '',
        'data-alert-duration' => $duration,
    ]) }}
>
    <div class="alert__icon" aria-hidden="true">
        {{ $config['icon'] }}
    </div>

    <div class="alert__content">
        {{ $slot }}
    </div>

    <button
        type="button"
        class="alert__close"
        data-alert-close
        aria-label="Close notification"
    >
        <span aria-hidden="true">×</span>
    </button>
</div>

@once
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-alert]').forEach((alert) => {
                const duration = Number(
                    alert.dataset.alertDuration || 5000
                );

                let closed = false;

                const closeAlert = () => {
                    if (closed) {
                        return;
                    }

                    closed = true;

                    alert.classList.add('alert--closing');

                    alert.addEventListener(
                        'animationend',
                        () => {
                            alert.remove();
                        },
                        { once: true }
                    );
                };

                const closeButton = alert.querySelector(
                    '[data-alert-close]'
                );

                closeButton?.addEventListener('click', closeAlert);

                setTimeout(closeAlert, duration);
            });
        });
    </script>
@endonce