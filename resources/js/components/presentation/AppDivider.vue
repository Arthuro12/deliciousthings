<template>
    <div :class="{ 'horizontal': variant == 'horizontal', 'vertical': variant == 'vertical' }"></div>
</template>

<script setup lang="ts">
const { variant = "horizontal" } = defineProps<{
    variant: "horizontal" | "vertical";
}>();
</script>

<style scoped>
.horizontal {
    border-bottom: 0.5px solid grey;
}

.vertical {
    border-left: 0.5px solid grey;
}
</style>