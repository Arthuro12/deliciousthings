<template>
    <div :class="dividerClass"></div>
</template>

<script setup lang="ts">
const { variant = "horizontal" } = defineProps<{
    variant: "horizontal" | "vertical";
}>();

const dividerClass = { 
    'horizontal': variant == 'horizontal', 
    'vertical': variant == 'vertical' 
}
</script>

<style scoped>
.horizontal {
    border-bottom: 0.5px solid grey;
}

.vertical {
    border-left: 0.5px solid grey;
}
</style>