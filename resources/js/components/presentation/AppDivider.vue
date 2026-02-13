<template>
    <div :class="dividerClass"></div>
</template>

<script setup lang="ts">
const { variant = "horizontal" } = defineProps<{
    variant: "horizontal" | "vertical";
}>();

const dividerClass = { 
    'divider--horizontal': variant == 'horizontal', 
    'divider--vertical': variant == 'vertical', 
}
</script>