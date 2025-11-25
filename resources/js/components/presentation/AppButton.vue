<template>
    <button 
        class="button"
        :class="[variantClass, layoutClass]" 
        :type="type"
    >
        <slot name="leading" />
        <slot name="text" />
        <slot name="trailing" />
    </button>
</template>

<script setup lang="ts">
import { BUTTON_CLASSES } from '@/constants';

const { variant, layout = "text" } = defineProps<{
    type: "button" | "submit" | "reset";
    variant: "primary" | "secondary" | "tertiary";
    layout: "text" | "icon" | "with-icon";
}>();

const layoutClass = BUTTON_CLASSES.LAYOUTS[layout];
const variantClass = BUTTON_CLASSES.VARIANTS[variant];
</script>
