<template>
    <div>
        <div>
            <h4 class="option-header gallery-header">Galerie</h4>
            <div class="gallery__preview">
                <div class="gallery__row" v-for="r in totalRows" :key="r">
                    <div 
                        class="gallery__row__item" 
                        v-for="image in getGalleryRow((r - 1) * 3, r * 3)" 
                        :key="image.id"
                        :style="{
                            width: (deviceWidth / 3) - 6 + 'px',
                            height: (deviceWidth / 3) - 6 + 'px',
                        }"
                    >
                        <img    
                            class="gallery__image" 
                            :src="image.url" 
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useDeviceSize } from "@/composables/use-media-query";
import type { Image } from "@/types/users";

const { gallery, } = defineProps<{
    gallery: Image[];
}>();

const { deviceWidth } = useDeviceSize();

const totalRows = Math.ceil(gallery.length / 3);

/**
 * 
 * @param startAt 
 * @param endAt 
 */
function getGalleryRow(startAt: number, endAt: number): Image[] {
    return gallery.slice(startAt, endAt);
}
</script>

<style scoped lang="scss">
@use '../../../../css/abstracts/breakpoints' as breakpoints;

.gallery-header {
    margin-left: 8px;
}

.gallery {
    &__image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    &__row {
        display: flex;
        gap: 6px;
        margin-bottom: 8px;

        &__item {
            flex-wrap: wrap;
            position: relative;
            aspect-ratio: 1 / 1;
            overflow: hidden;
        }
    }
}
</style>