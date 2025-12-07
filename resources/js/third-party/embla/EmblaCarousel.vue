<template>
    <div class="embla-carousel__root">
        <AppButton type="button" variant="tertiary" layout="icon">
            <template #leading>
                <ChevronLeftIcon @click="scrollPrev" />
            </template>
        </AppButton>
        <div class="embla-carousel__container" ref="emblaCarousel">
            <div class="embla-carousel__content">
                <div class="embla-carousel__slide" v-for="(slide, idx) in slides" :key="idx">
                    <slot :slide="slide"></slot>
                </div>
            </div>
        </div>
        <AppButton type="button" variant="tertiary" layout="icon">
            <template #leading>
                <ChevronRightIcon @click="scrollNext" />
            </template>
        </AppButton>
    </div>
</template>

<script setup lang="ts" generic="T">
import { ChevronLeftIcon, ChevronRightIcon } from "lucide-vue-next";
import emblaCarouselVue from "embla-carousel-vue";

import AppButton from "@/components/presentation/AppButton.vue";

type CarouselProps<T> = {
    slides: T[];
    active: boolean;
    align: string
};

const { slides, active } = defineProps<CarouselProps<T>>();

const [ emblaCarousel, emblaApi ] = emblaCarouselVue({ loop: true, active, align: "start" });

/**
 * Scrolls to next slide.
 */
function scrollNext(): void {
    emblaApi.value?.scrollNext();
}

/**
 * Scrolls to previous slide.
 */
function scrollPrev(): void {
    emblaApi.value?.scrollPrev();
}
</script>

<style scoped lang="scss">
.embla-carousel {
    &__container {
        overflow: hidden;
    }

    &__container > .embla-carousel__content {
        display: flex;

        .embla-carousel__slide {
            flex: 0 0 100%;
            min-width: 0;
        }
    }
}
</style>