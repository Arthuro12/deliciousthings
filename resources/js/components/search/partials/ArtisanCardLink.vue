<template>
    <a 
        class="artisan-card card" 
        :href="`/artisan/${artisan.name}`" 
        target="_blank"
    >
        <img class="artisan-image" :src="artisan.profile_photo?.url ?? chefHatFallback" />
        <div class="artisan-details">
            <div>
                <span class="artisan-card__title">{{ artisan.name }}</span><br />
                <span class="artisan-card__subtitle" v-if="artisan.company_name">{{ artisan.company_name }}</span>
            </div>
            <div class="artisan-detail">
                <span>{{ priceDetails }}</span>
            </div>
        </div>
    </a>
</template>

<script setup lang="ts">
import { computed } from "vue";

import chefHatFallback from "../../../../images/chef-hat-fallback.webp";

import { getPriceLevelSymbol, getPriceDisplay } from "@/utils/artisans";
import type { ArtisanPublicProfile } from "@/types/users";

const { artisan } = defineProps<{
    artisan: ArtisanPublicProfile;
}>();

const priceDetails = computed(() => {
    return `${getPriceDisplay(artisan.average_rate)}${artisan.price_level ? ` | ${getPriceLevelSymbol(artisan.price_level)}` : ''}`;
});
</script>

<style scoped lang="scss">
.artisan-card {
    display: flex;
    flex-direction: column;
    column-gap: 14px;
    height: 100%;

    &.card {
        padding: 0;
    }

    &:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px var(--color-primary-50);
    }

    > .artisan-image {
        width: 100%;
        height: 60%;
        aspect-ratio: 1 / 1; 
        object-fit: cover;     
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    &__title {
        font-weight: 700;
        color: var(--color-primary-50);
    }

    .artisan-details {
        display: flex;
        flex-direction: column;
        row-gap: 4px;
        padding: 22px;

        > .artisan-detail {
            display: flex;
            column-gap: 4px
        }
    }
}
</style>