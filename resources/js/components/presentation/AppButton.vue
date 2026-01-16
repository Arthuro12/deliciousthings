<template>
    <button 
        class="button"
        :class="[
            variantClass, 
            layoutClass,
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

const { variant, layout = "text", disabled = false } = defineProps<{
    type: "button" | "submit" | "reset";
    layout: "text" | "icon" | "with-icon";
    variant?: "primary" | "secondary" | "tertiary";
    disabled?: boolean; 
}>();

const layoutClass = ref(BUTTON_CLASSES.LAYOUTS[layout]);
const variantClass = ref(variant ? BUTTON_CLASSES.VARIANTS[variant] : "");
</script>
