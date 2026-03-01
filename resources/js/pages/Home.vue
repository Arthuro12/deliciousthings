<template>
    <AppLayout>
        <Head>
            <title>Konditor/-innen und Bäcker/-innen online finden</title>
        </Head>

        <main class="home-page">
            <div>   
                <section class="hero-section"> 
                    <h1 class="page-title">Finden Sie passende<br />Konditor/-innen und Bäcker/-innen</h1>
                    <ArtisansSearch />
                </section>
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";

import AppLayout from "@/layout/AppLayout.vue";
import ArtisansSearch from "@/components/search/ArtisansSearch.vue";
</script>

<style scoped>
.home-page {
    --title-font-weight: 400;
    --title-font-size: 2rem;

    .page-title {
        font-weight: var(--title-font-weight);
        font-size: var(--title-font-size);
        color: var(--color-neutral-50);
        text-align: center;
        width: 100%;
    }

    .hero-section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        row-gap: 24px;
        background-image: url("../../images/butter-cream.webp");
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        padding: 18px;
        min-height: 75vh;
    }
}
</style>