<template>
    <div class="app-layout">
        <AppHeader :links />

            <div class="app-content-wrapper">
                <slot></slot> 
            </div>
        <AppBottomNavBar :links />
    </div>

</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

import AppHeader from "./AppHeader.vue";
import AppBottomNavBar from "./AppBottomNavBar.vue";

import type { AppLinks } from "@/types/ui";

const { links } = defineProps<{
    links: AppLinks;
}>();

const websiteUrl = links.guest.find(link => link.title == "Website");
</script>

<style>
.app-layout {
    min-height: 100dvh;

    background: var(--color-neutral-50, #fdfbf9);
    color: var(--color-chocolate-900, #36241d);
}

.app-content-wrapper {
    width: 100%;
    max-width: 1200px;

    margin-inline: auto;

    /*
     * Extra space below prevents the mobile bottom navigation
     * from covering the page content.
     */
    padding:
        calc(28px + var(--app-header-height))
        20px
        calc(104px + env(safe-area-inset-bottom))
        20px;

    @media (min-width: 768px) {
        padding: calc(40px + var(--app-header-height)) 32px 64px 40px;
    }
}
</style>