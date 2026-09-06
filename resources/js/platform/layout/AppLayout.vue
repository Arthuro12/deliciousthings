<template>
    <div class="app-layout">
        <AppHeader :links />

        <slot></slot> 
            
        <AppBottomNavBar :links />
    </div>
</template>

<script setup lang="ts">
import AppHeader from "./AppHeader.vue";
import AppBottomNavBar from "./AppBottomNavBar.vue";

import type { AppLinks } from "@/types/ui";

const { links } = defineProps<{
    links: AppLinks;
}>();
</script>

<style>
.app-layout {
    min-height: 100dvh;

    background: var(--color-neutral-50, #fdfbf9);
    color: var(--color-chocolate-900, #36241d);
}
</style>