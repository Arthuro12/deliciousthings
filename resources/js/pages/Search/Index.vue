<template>
    <AppLayout>
        <Head>
            <title>Konditor/-innen und Bäcker/-innen online finden</title>
        </Head>

        <main class="wrapper">
            <div class="search">
                <ArtisansSearch class="artisans-search" />
            </div>
            <div class="search-results">
                <ArtisanResults v-if="artisans.length > 0" :artisans />
                <div v-else>keine Suchergebnisse gefunden. Probieren Sie mit einer anderer Filtereinstellung.</div>
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { onMounted, onUnmounted } from "vue";
import { Head } from "@inertiajs/vue3";

import AppLayout from "@/layout/AppLayout.vue";
import ArtisansSearch from "@/components/search/ArtisansSearch.vue";
import ArtisanResults from "@/components/search/ArtisanResults.vue";

import { useBodyAppearance } from "@/composables/use-body-appearance";
import type { ArtisanPublicProfile } from "@/types/users";

 const { artisans } = defineProps<{
    artisans: ArtisanPublicProfile[];
 }>();

 const {
    setBodyBackgroundColor,
    removeBodyBackgroundColor,
} = useBodyAppearance("#fcf1f5");

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
        :deep(.search-button) {
            border: 1px solid var(--color-neutral-30);
        }
    }

    .search-results {
        width: 85%;
        margin: 28px auto;
        min-height: 500px;
    }
}
</style>