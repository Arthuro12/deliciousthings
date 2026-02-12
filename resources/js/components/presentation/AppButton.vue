<template>
    <button 
        class="button"
        :class="[
            variantClass, 
            layoutClass,
            sizeClass,
            `${disabled ? 'button--disabled' : ''}`
        ]" 
        :type="type"
        :disabled="disabled"
    >
        <slot name="leading"></slot>
        <slot name="text"></slot>
        <slot name="trailing"></slot>
    </button>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { BUTTON_CLASSES } from "@/constants";

const { layout, variant, size, disabled = false } = defineProps<{
    type: "button" | "submit" | "reset";
    layout?: "icon" | "with-icon";
    variant?: "primary" | "secondary" | "tertiary";
    size?: "small" | "medium" | "large";
    disabled?: boolean; 
}>();

const layoutClass = ref(layout ? BUTTON_CLASSES.LAYOUTS[layout] : "");
const variantClass = ref(variant ? BUTTON_CLASSES.VARIANTS[variant] : "");
const sizeClass = ref(size ? BUTTON_CLASSES.SIZES[size] : "");
</script>
