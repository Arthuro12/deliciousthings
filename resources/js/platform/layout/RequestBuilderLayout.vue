<template>
    <div class="request-builder-layout">
        <header class="request-builder-header">
            <div class="request-builder-header__inner">
                <button
                    type="button"
                    class="request-builder-header__back"
                    aria-label="Zurück"
                    @click="onBack?.()"
                >
                    <ArrowLeft
                        :size="20"
                        :stroke-width="1.8"
                    />
                </button>

                <Link
                    href="/app"
                    class="request-builder-header__logo"
                    aria-label="Deliciousthings"
                >
                    <DeliciousthingsLogo class="logo__image" />
                </Link>

                <span class="request-builder-header__spacer" />
            </div>
        </header>

        <main class="request-builder-layout__main">
            <slot />
        </main>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { ArrowLeft } from "@lucide/vue";

import DeliciousthingsLogo from "../components/icons/DeliciousthingsLogo.vue";

defineProps<{
    onBack?: () => void;
}>();
</script>

<style scoped lang="scss">
.request-builder-layout {
    min-height: 100dvh;

    background: var(
        --color-neutral-50,
        #fdfbf9
    );

    color: var(
        --color-chocolate-900,
        #36241d
    );
}

.request-builder-header {
    position: fixed;
    z-index: 10;
    top: 0;
    right: 0;
    left: 0;

    height: var(
        --request-builder-header-height,
        64px
    );

    background: rgb(253 251 249 / 94%);

    border-bottom: 1px solid
        var(--color-chocolate-100);

    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
}

.request-builder-header__inner {
    display: grid;
    grid-template-columns: 1fr auto 1fr;

    align-items: center;

    width: min(
        calc(100% - 32px),
        1200px
    );

    height: 100%;

    margin-inline: auto;
}

.request-builder-header__back {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    width: 40px;
    height: 40px;

    padding: 0;

    color: var(--color-chocolate-700);

    background: transparent;

    border: 0;

    cursor: pointer;

    border-radius: 0.5rem;

    &:hover {
        background-color: var(--color-neutral-100);
    }
}

.request-builder-header__logo {
    color: var(--color-brand-primary-500);

    font-size: 18px;
    font-weight: 700;

    text-decoration: none;
}

.request-builder-header__spacer {
    width: 40px;
}

.request-builder-layout__main {
    min-height: 100dvh;

    padding-top: calc(
        var(--request-builder-header-height, 64px) +
        24px
    );
}
</style>