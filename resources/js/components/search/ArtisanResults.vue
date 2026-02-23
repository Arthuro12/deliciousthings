<template>
    <ul class="artisan-results">
        <li 
            class="artisan-item"
            v-for="artisan in artisans" 
            :key="artisan.id"
        >
            <ArtisanCard :artisan />
        </li>
    </ul>
</template>

<script setup lang="ts">
import ArtisanCard from "./partials/ArtisanCardLink.vue";

import type { ArtisanPublicProfile } from "@/types/users";

const { artisans } = defineProps<{
    artisans: ArtisanPublicProfile[];
}>();
</script>

<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.artisan-results {
    display: grid;
    grid-template-columns: repeat(1, minmax(0, 1fr));
    list-style-type: none;
    column-gap: 14px;
    row-gap: 20px;

    .artisan-item {
        height: 350px;
    }

    @include breakpoints.respond-to('medium') {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    @include breakpoints.respond-to('large') {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
}
</style>