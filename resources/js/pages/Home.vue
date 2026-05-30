<template>
    <AppLayout>
        <Head>
            <title>Lokale Patisserie und kreative Torten</title>
            <meta name="description" content="" />
            <link 
                rel="preload" 
                as="image" 
                href="/hero-image-1919.webp" 
                imagesrcset="
                    /hero-image-768.webp 768w,
                    /hero-image-1280.webp 1280w,
                    /hero-image-1919.webp 1919w          
                "
            />
        </Head>

        <main class="home-page">
            <div>   
                <section class="hero-section"> 
                    <div class="hero-content">
                        <header class="hero-header">
                            <h1 class="title hero-title">Entdecken Sie geschmackvolle Kreationen und Konditor:innen</h1> 
                            <p class="subtitle hero-description">Reservieren Sie verfügbare Kreationen oder finden Sie passende Konditor:innen für Ihre persönlichen Wünsche.</p> 
                        </header>

                        <QuickSearch />
                    </div>
                    <div class="hero-overlay"></div>
                    <img 
                        class="hero-image" 
                        alt="elegante und geschmackvolle Torte"
                        src="/hero-image-1919.webp" 
                        srcset="
                            /hero-image-768.webp 768w,
                            /hero-image-1280.webp 1280w,
                            /hero-image-1919.webp 1919w          
                        "
                        fetchpriority="high"
                        loading="eager"
                    />
                </section>
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head, } from "@inertiajs/vue3";

import AppLayout from "@/layout/AppLayout.vue";
import QuickSearch from "@/components/search/quick-search/QuickSearch.vue";

import { usePageDbClick, } from "@/composables/use-page-db-click";

usePageDbClick();

</script>

<style scoped lang="scss">
@use '../../css/abstracts/breakpoints' as breakpoints; 
@use '../../css/components/buttons' as buttons;

.home-page {
    --title-font-size-3xl: 1.875rem;
    --title-font-size-4xl: 2.25rem;
    --title-font-weight: 600;
    --subtitle-font-size-xl: 1.25rem;
    --subtitle-font-size-2xl: 1.5rem;
    --subtitle-font-weight: 500;

    --cta-background-color-secondary: #fff3;

    --left-gradient: linear-gradient(80deg, rgba(0, 0, 0, .14), transparent 41%);
    --bottom-gradient: linear-gradient(0deg, rgba(0, 0, 0, .45) 0%, rgba(0, 0, 0, .36) 5%, rgba(0, 0, 0, .27) 9%, rgba(0, 0, 0, .18) 16%, rgba(0, 0, 0, .09) 22%, rgba(0, 0, 0, .02) 29%, transparent 36%);
    --radial-gradient: radial-gradient(circle 100vmax at 66.7% 0%, transparent 0%, rgba(0, 0, 0, .04) 19%, rgba(0, 0, 0, .15) 36%, rgba(0, 0, 0, .3) 51%, rgba(0, 0, 0, .33) 53%, rgba(0, 0, 0, .49) 65%, rgba(0, 0, 0, .67) 77%, rgba(0, 0, 0, .85) 89%, #000 100%);
}

ul li {
    list-style: none;
}

.home-page {
    .title,
    .subtitle {
        color: var(--color-neutral-0);
    }

    .hero-section {
        background-color: var(--color-neutral-50);
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 18px;
        min-height: 90vh;

        .hero-content {
            transition: opacity 2s ease, transform 1.2s ease;
            position: absolute;
            display: flex;
            flex-direction: column;
            row-gap: 24px;
            padding: 0 18px;
            inset-block-end: 30px;
            z-index: 2;  
        }

        .hero-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            row-gap: 20px;

            > .hero-title,
            > .hero-description {
                text-align: center;
            }

            > .subtitle {
                // width: 85%;
            }
        }

        .hero-image {
            position: absolute;
            height: 100%;
            width: 100%;
            inset: 0;
            object-fit: cover;
            object-position: right center;
        }

        .hero-overlay {
            position: absolute;
            height: 100%;
            width: 100%;
            background-image: var(--left-gradient), var(--bottom-gradient), var(--radial-gradient);
            z-index: 1;
        }
    }
}
</style>