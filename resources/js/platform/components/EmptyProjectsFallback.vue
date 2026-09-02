<template>
    <section
        class="empty-projects-state"
        aria-labelledby="empty-projects-title"
    >
        <div
            class="empty-projects-state__icon-wrapper"
            aria-hidden="true"
        >
            <FolderPlus
                :size="36"
                :stroke-width="1.6"
            />
        </div>

        <div class="empty-projects-state__content">
            <h2
                id="empty-projects-title"
                class="empty-projects-state__title"
            >
                Du hast noch keine Projekte
            </h2>

            <p class="empty-projects-state__description">
                Erstelle dein erstes Backprojekt, um Ideen,
                Anforderungen und wichtige Informationen an einem Ort
                zu organisieren.
            </p>
        </div>

        <Link
            href="/app/projects/create"
            class="empty-projects-state__button"
        >
            <Plus
                :size="18"
                :stroke-width="2"
                color="#fff"
                aria-hidden="true"
            />

            <span>Projekt erstellen</span>
        </Link>
    </section>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

import { FolderPlus, Plus } from "@lucide/vue";
</script>

<style scoped>
.empty-projects-state {
    display: flex;
    width: 100%;
    max-width: 32rem;
    min-height: 24rem;
    margin-inline: auto;
    padding: 3rem 1.5rem;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.empty-projects-state__icon-wrapper {
    display: inline-flex;
    width: 4.5rem;
    height: 4.5rem;
    margin-bottom: 1.5rem;
    align-items: center;
    justify-content: center;
    color: var(--color-brand-primary-500);
    background-color: var(--color-brand-primary-50);
    border-radius: 1.25rem;
}

.empty-projects-state__content {
    max-width: 28rem;
}

.empty-projects-state__title {
    margin: 0;
    font-size: var(--font-size-heading-sm, 1.25rem);
    font-weight: 600;
    line-height: 1.3;
}

.empty-projects-state__description {
    margin: 0.75rem 0 0;
    color: var(--color-neutral-500);
    font-size: var(--font-size-body-sm, 0.9375rem);
    line-height: 1.6;
}

.empty-projects-state__button {
    display: inline-flex;
    min-height: 2.75rem;
    margin-top: 2.5rem;
    padding: 0.6875rem 1.125rem;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    color: var(--color-neutral-0, #fff);
    background-color: var(--color-brand-primary-500);
    border: 1px solid var(--color-brand-primary-500);
    border-radius: var(--border-radius-md, 0.625rem);
    font: inherit;
    font-size: var(--font-size-body-sm, 0.9375rem);
    font-weight: 600;
    line-height: 1.25;
    cursor: pointer;
    transition:
        color 150ms ease,
        background-color 150ms ease,
        border-color 150ms ease,
        transform 100ms ease;
    -webkit-tap-highlight-color: transparent;
}

.empty-projects-state__button:hover {
    background-color: var(--color-brand-primary-600);
    border-color: var(--color-brand-primary-600);
}

.empty-projects-state__button:focus-visible {
    outline: 3px solid var(--color-brand-primary-100);
    outline-offset: 3px;
}

.empty-projects-state__button:active {
    background-color: var(--color-brand-primary-700);
    border-color: var(--color-brand-primary-700);
    transform: translateY(1px);
}

@media (min-width: 48rem) {
    .empty-projects-state {
        min-height: 30rem;
        padding: 4rem 2rem;
    }
}
</style>