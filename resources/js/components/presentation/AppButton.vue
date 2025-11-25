<template>
    <button 
        class="button"
        :class="[actionClass, variantClass]" 
        :type="type"
    >
        <slot name="leading" />
        <slot name="text" />
        <slot name="trailing" />
    </button>
</template>

<script setup lang="ts">
import { ACTION_CLASSES, VARIANT_CLASSES } from '@/constants';

const { action, variant = "standard" } = defineProps<{
    type: "button" | "submit" | "reset";
    action: "primary" | "secondary" | "tertiary";
    variant?: "standard" | "icon";
}>();

const actionClass = ACTION_CLASSES.BUTTON[action];
const variantClass = VARIANT_CLASSES.BUTTON[variant];
</script>
