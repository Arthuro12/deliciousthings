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
                            <h1 class="hero-header__headline">Klare Anfragen.<span class="hero-gradient-text">Organisierte Tortenprojekte.</span></h1>
                            <p class="hero-header__description">Erhalten Sie klare Anfragen für individuelle Kreationen. Verwalten Sie Ihre Tortenprojekte und behalten Sie alle Schritte übersichtlich an einem zentralen Ort im Blick.</p>
                        </header>
                        <div class="cta-buttons">
                            <Link class="button button--primary button--header-cta" href="/register">Kostenlos loslegen</Link>
                            <!-- <Link class="button button--secondary button--header-cta" href="#">Demo-Profil asehen</Link> -->
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
}

.hero-section {
    background-color: var(--color-brand-primary-50);
    padding: var(--space-12) var(--space-5);
    width: 100%;
    height: 100%;

    .hero-header {
        &__headline,
        .hero-gradient-text {
            font-size: 1.5rem;
        }

        .hero-gradient-text {
            font-weight: 700;
            line-height: 1.2;
        }

        &__headline {
            display: flex;
            flex-direction: column;
            margin-bottom: var(--space-5);
        }

        @include breakpoints.respond-to('medium') {
            &__headline,
            .hero-gradient-text {
                font-size: 3rem;
            }
        }
    }

    .cta-buttons {
        margin-top: var(--space-5);
        // display: flex;
        // justify-content: center;
        // flex-wrap: wrap;
        // gap: var(--space-3);
    }

    @include breakpoints.respond-to('medium') {
        .hero-inner {
            max-width: 52rem;

            .hero-header__description {
                max-width: 40rem;
            }
        }
    }
}
</style>