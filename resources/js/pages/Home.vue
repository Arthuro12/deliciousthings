<template>
    <AppLayout>
        <Head>
            <title>Lokale Patisserie und kreative Torten</title>
            <meta name="description" content="" />
        </Head>

        <main class="home-page">
            <div>   
                <section class="hero-section"> 
                    <header class="hero-header">
                        <h2 class="title">Entdecken Sie <span>einzigartige</span> handwerkliche Kreationen und Konditor:innen</h2> 
                        <h3 class="subtitle">Reservieren Sie verfügbare Kreationen oder finden Sie passende Konditor:innen für Ihre persönlichen Wünsche.</h3> 
                    </header>
                    <div class="hero-overlay"></div>
                    <img class="hero-image" :src="heroImage" />
                </section>
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";

import AppLayout from "@/layout/AppLayout.vue";

import heroImage from "../../images/hero-image.webp";

import { useAuth } from "@/composables/use-auth";
import { usePageDbClick } from "@/composables/use-page-db-click";

const { isAuthenticated } = useAuth();
usePageDbClick();
</script>

<style scoped lang="scss">
@use '../../css/abstracts/breakpoints' as breakpoints; 
@use '../../css/components/buttons' as buttons;

ul li {
    list-style: none;
}

.home-page {
    --title-font-size-3xl: 1.875rem;
    --title-font-size-4xl: 2.25rem;
    --title-font-weight: 600;
    --subtitle-font-size-xl: 1.25rem;
    --subtitle-font-size-2xl: 1.5rem;
    --subtitle-font-weight: 500;
    --cta-background-color-secondary: #fff3;

    .title {
        font-size: var(--title-font-size-3xl);
        font-weight: var(--title-font-weight);
        color: var(--color-neutral-0);

        @include breakpoints.respond-to('medium') {
            font-size: var(--title-font-size-4xl);
        }
    }

    .subtitle {
        font-size: var(--subtitle-font-size-xl);
        font-weight: var(--subtitle-font-weight);
        color: var(--color-neutral-0);

        @include breakpoints.respond-to('medium') {
            font-size: var(--subtitle-font-size-2xl);
        }
    }

    .hero-section {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        row-gap: 24px;
        padding: 18px;
        min-height: 90vh;

        .hero-header {
            position: absolute;
            display: flex;
            flex-direction: column;
            row-gap: 16px;
            padding: 0 24px;
            top: 5%;
            z-index: 2;  

            > .title > span {
                font-size: var(--title-font-size-3xl);
                font-weight: var(--title-font-weight);
                color: var(--color-secondary-50);
        
                @include breakpoints.respond-to('medium') {
                    font-size: var(--title-font-size-4xl);
                }
            }

            > .subtitle {
                width: 85%;
            }
        }

        .hero-image {
            position: absolute;
            height: 100%;
            width: 100%;
            inset: 0;
            object-fit: cover;
            object-fit: 50% 50%;
        }

        .hero-overlay {
            position: absolute;
            height: 100%;
            width: 100%;
            background: linear-gradient(77deg, rgba(0,0,0,.6), transparent 85%);
            z-index: 1;
        }
    }
}
</style>