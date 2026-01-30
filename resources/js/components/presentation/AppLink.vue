<template>
    <a
        :href="href"
        :target="target"
        class="link"
        :class="[variantClass, sizeClass]"
    >
        <slot name="leading"></slot>
        <slot name="text"></slot>
        <slot name="trailing"></slot>
    </a>
</template>

<script setup lang="ts">
import { LINK_CLASSES } from "@/constants";

import { ref } from "vue";

const { variant, size = "medium" } = defineProps<{
    href: string;
    target?: string;
    variant: "primary" | "secondary" | "tertiary";
    size?: "medium";
}>();

const variantClass = ref(LINK_CLASSES.VARIANTS[variant]);
const sizeClass = ref(LINK_CLASSES.SIZES[size]);
</script>

<style scoped>
.link:hover {
    text-decoration: none;
}
</style>