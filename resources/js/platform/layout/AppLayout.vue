<template>
    <div class="app-layout">
        <AppHeader :links />
        <AppSidebar :links />
        <div class="app-main">
            <slot />
        </div>
        <AppBottomNavBar :links />
    </div>
</template>

<script setup lang="ts">
import AppHeader from './AppHeader.vue';
import AppSidebar from './AppSidebar.vue';
import AppBottomNavBar from './AppBottomNavBar.vue';

import type { AppLinks } from "@/types/ui";

const { links } = defineProps<{
    links: AppLinks;
}>();
</script>

<style>
.app-layout {
    min-height: 100dvh;
    background: var(--color-background-page);
    color: var(--color-text-primary);
}

.app-main {
    min-width: 0;
    min-height: 100dvh;
    padding-top: var(--app-header-height);
}

@media (min-width: 768px) {
    .app-main { margin-left: var(--app-sidebar-width); }
}
</style>
