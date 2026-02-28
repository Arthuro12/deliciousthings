<template>
    <SliderRoot
        class="slider"
        :min
        :max
        v-model="modelValue"
    >
        <SliderTrack class="slider__track">
            <SliderRange class="slider__range" />
        </SliderTrack>
        <SliderThumb class="slider__thumb" />
    </SliderRoot>
</template>

<script setup lang="ts">
import { 
    SliderRoot, 
    SliderTrack, 
    SliderRange,
    SliderThumb, 
} from "reka-ui";

export type SliderProps = {
    min: number;
    max: number;
};

defineProps<SliderProps>();

const modelValue = defineModel<number[] | null>({ required: false, });
</script>

<style scoped lang="scss">
.slider {
  --slider-height: 6px;
  --slider-thumb-size: 18px;
}

.slider {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    height: 36px;
    touch-action: none;
    user-select: none;
    cursor: grab;

    &__track {
        position: relative;
        flex-grow: 1;
        height: var(--slider-height);
        background-color: var(--color-neutral-10);
        border-radius: 9999px;
        overflow: hidden;
    }

    &__range {
        position: absolute;
        height: 100%;
        background-color: var(--color-primary-50);
        border-radius: inherit;
        transition: background-color 0.2s ease;
    }

    &__thumb {
        display: block;
        width: var(--slider-thumb-size);
        height: var(--slider-thumb-size);
        background-color: var(--color-neutral-0);
        border: 2px solid var(--color-primary-50);
        border-radius: 50%;
        box-shadow: 0 4px 10px var(--color-neutral-10);
        transition:
            transform 0.15s ease,
            box-shadow 0.2s ease,
            background-color 0.2s ease;
        cursor: grab;

        &:hover {
            transform: scale(1.05);
        }

        &:active {
            cursor: grabbing;
            transform: scale(1.1);
            box-shadow: 0 6px 14px var(--color-neutral-10);
        }

        &:focus-visible {
            outline: none;
            box-shadow:
                0 0 0 4px var(--color-neutral-10),
                0 4px 10px var(--color-neutral-10)
        }
    }
}
</style>