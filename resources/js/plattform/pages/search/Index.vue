<template>
    <AppLayout>
        <Head>
            <title>Konditoreien & Bäckereien: Handwerk entdecken</title>
            <meta name="description" content="Entdecken Sie Handwerker:innen mit echtem Talent. Senden Sie direkte Anfragen und lassen Sie Ihre Lieblingsgebäcke mit Leidenschaft zubereiten. Jetzt anfragen!" />
        </Head>

        <main class="wrapper">
            <div class="search">
                <ArtisansSearch class="artisans-search" />
            </div>
            <div class="search-results">
                <ArtisanResults v-if="artisans.length > 0" :artisans />
                <div class="search-results--empty" v-else>Es wurde leide keine passende Ergebnisse gefunden.</div>
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { onMounted, onUnmounted } from "vue";
import { Head } from "@inertiajs/vue3";

import AppLayout from "@/plattform/layout/AppLayout.vue";
import ArtisansSearch from "@/components/search/ArtisansSearch.vue";
import ArtisanResults from "@/components/search/ArtisanResults.vue";

import { usePageDbClick } from "@/composables/use-page-db-click";
import { useBodyAppearance } from "@/composables/use-body-appearance";
import type { ArtisanPublicProfile } from "@/types/users";

const { artisans } = defineProps<{
    artisans: ArtisanPublicProfile[];
}>();

const {
    setBodyBackgroundColor,
    removeBodyBackgroundColor,
} = useBodyAppearance("#fcf1f5");
usePageDbClick();

onMounted(() => {
    setBodyBackgroundColor();
});

onUnmounted(() => {
    removeBodyBackgroundColor();
});
</script>

<style scoped lang="scss">
.wrapper {
    .artisans-search {
        width: 100%;

        :deep(.search-button) {
            border: 1px solid var(--color-neutral-30);
            width: 150px;
            margin: auto;
        }
    }

    > .search {
        display: flex;
        justify-content: center;
        padding: 24px 0;
    }

    .search-results {
        width: 85%;
        margin: 28px auto;
        min-height: 500px;

        &--empty {
            text-align: center;
        }
    }
}
</style>