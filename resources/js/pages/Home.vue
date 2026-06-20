<template>
    <AppLayout>
        <Head>
            <title>Backprojekte für Geburtstag, Hochzeit und besondere Anlässe planen</title>
            <meta name="description" content="" />
        </Head>

        <main class="home-page">
            <div class="page-content">   
                <section class="hero-section"> 
                    <div class="hero-inner">
                        <header class="hero-header">
                            <h1 class="hero-header__headline">Plane deine persönliche <span class="hero-gradient-text">Backkreation.</span></h1>
                            <p>Klare Ideen, strukturierte Projekte — für entspannte Tortenplanungen.</p>
                        </header>
                        <div class="cta-buttons">
                            <Link class="button button--primary button--header-cta" href="/projects/create">Backprojekt planen</Link>
                            <Link class="button button--secondary button--header-cta" href="/for-artisans">Als Anbieter:in starten</Link>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head, Link, } from "@inertiajs/vue3";

import AppLayout from "@/layout/AppLayout.vue";

import { usePageDbClick, } from "@/composables/use-page-db-click";

usePageDbClick();

</script>

<style scoped lang="scss">
@use '../../css/abstracts/breakpoints' as breakpoints; 
@use '../../css/components/buttons' as buttons;

.page-content {
    width: 100%;

    .hero-gradient-text {
        font-size: 1.75rem;
        font-weight: 700;
        line-height: 1.2;
        background: linear-gradient(
            100deg,
            var(--color-brand-primary-800) 0%,
            var(--color-brand-primary-600) 35%,
            var(--color-brand-primary-400) 68%,
        );
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    @include breakpoints.respond-to('medium') {
        font-size: 2rem;;
    }
}

.hero-section {
    background-color: var(--color-brand-primary-50);
    padding: var(--space-12) var(--space-4);
    width: 100%;
    height: 100%;

    .hero-inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: var(--space-5);
    }

    .hero-header {
        text-align: center;

        &__headline {
            margin-bottom: var(--space-5);
        }
    }

    .cta-buttons {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: var(--space-3);
    }
}
</style>