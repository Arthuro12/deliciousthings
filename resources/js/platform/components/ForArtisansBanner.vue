<template>
    <div 
        class="for-artisans-banner"
        v-show="isOpen"
    >
        <div class="for-artisan-banner__wrapper">
            <header class="for-artisan-banner__header">
                <p class="for-artisan-banner__eyebrow">Für Backprofis & Hobby-Bäcker:innen</p>
                <button 
                    class="for-artisan-banner__close"
                    type="button" 
                    @click="isOpen = false"
                >
                    <X :size="20" />
                </button>
            </header>

            <div class="for-artisan-banner__content">
                <p class="for-artisan-banner__description">Bist du Konditor:in, Cake Designer:in oder Hobby-Bäcker:in? Zeig deine Kreationen und werde von neuen Kund:innen entdeckt.</p>
                <Link 
                    class="for-artisan-banner__link"
                    href="/app/artisan/create"
                >Profil erstellen</Link>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

import { X } from "@lucide/vue";

const { defaultOpen = false } = defineProps<{
    defaultOpen?: boolean;
}>();

const isOpen = ref(defaultOpen ?? false);
</script>

<style scoped>
.for-artisan-banner {
    width: 100%;
    padding: 1rem;
}

.for-artisan-banner__wrapper {
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    width: 100%;
    padding: 1.25rem;
    border: 1px solid var(--color-neutral-200);
    border-radius: 1rem;
    background-color: var(--color-neutral-100);
}

.for-artisan-banner__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.for-artisan-banner__eyebrow {
    margin: 0;
    color: var(--color-brand-primary-600);
    font-size: var(--font-size-md-sm);
    font-weight: 600;
    line-height: 1.25rem;
} 

.for-artisan-banner__close {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 auto;
    width: 2rem;
    height: 2rem;
    margin: -0.25rem -0.25rem 0 0;
    padding: 0;
    border: 0;
    border-radius: 9999px;
    background: transparent;
    color: var(--color-neutral-500);
    cursor: pointer;
    transition:
        background-color 150ms ease,
        color 150ms ease;
}

.for-artisan-banner__close:hover {
    background-color: var(--color-neutral-200);
    color: var(--color-neutral-800);
}

.for-artisan-banner__close:focus-visible {
    outline: 2px solid var(--color-brand-primary-500);
    outline-offset: 2px;
}

.for-artisan-banner__close :deep(svg) {
    width: 1rem;
    height: 1rem;
}

.for-artisan-banner__content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
}

.for-artisan-banner__description {
    max-width: 42rem;
    margin: 0;
    color: var(--color-neutral-700);
    font-size: 0.9375rem;
    line-height: 1.5rem;
}

.for-artisan-banner__link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 2.5rem;
    padding: 0.625rem 1rem;
    border-radius: 0.625rem;
    background-color: var(--color-brand-primary-500);
    color: white;
    font-size: 0.875rem;
    font-weight: 600;
    line-height: 1.25rem;
    text-decoration: none;
    transition:
        background-color 150ms ease,
        transform 150ms ease;
}

.for-artisan-banner__link:hover {
    background-color: var(--color-brand-primary-600);
}

.for-artisan-banner__link:active {
    transform: translateY(1px);
}

.for-artisan-banner__link:focus-visible {
    outline: 2px solid var(--color-brand-primary-500);
    outline-offset: 2px;
}

@media (min-width: 640px) {
    .for-artisan-banner {
        padding: 1.5rem;
    }

    .for-artisan-banner__wrapper {
        padding: 1.5rem;
    }
}
</style>