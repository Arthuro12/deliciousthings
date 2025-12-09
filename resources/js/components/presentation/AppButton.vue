<template>
    <button 
        class="button"
        :class="[variantClass, layoutClass]" 
        :type="type"
    >
        <slot name="leading"></slot>
        <slot name="text"></slot>
        <slot name="trailing"></slot>
    </button>
</template>

<script setup lang="ts">
import { BUTTON_CLASSES } from '@/constants';

const { variant, layout = "text" } = defineProps<{
    type: "button" | "submit" | "reset";
    layout: "text" | "icon" | "with-icon";
    variant: "primary" | "secondary" | "tertiary";
}>();

const layoutClass = BUTTON_CLASSES.LAYOUTS[layout];
const variantClass = BUTTON_CLASSES.VARIANTS[variant];
</script>
