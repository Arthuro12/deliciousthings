<template>
    <div>
        <label class="radius-filter__label">Umkreis</label>
        <div class="radius-filter__text">{{ `${radius} Km` }}</div>
        <RekaSlider 
            :min="0"
            :max="50"
            v-model:model-value="radius"
        />
    </div>
</template>

<script setup lang="ts">
import RekaSlider from "@/third-party/reka-ui/RekaSlider.vue";

const radius = defineModel<number[] | null>({ default: [0] });
</script>

<style scoped lang="scss">
.radius-filter {
    &__label {
        font-weight: 800;
        color: var(--color-neutral-30);
    }
}
</style>