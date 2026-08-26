<template>
    <div class="app-layout">
        <AppHeader :links />

        <main class="app-content">
            <div class="app-content__inner">
                <slot></slot> 
            </div>
        </main>

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



/* -------------------------------------------------------
 * Page
 * ----------------------------------------------------- */

.app-content {
    width: 100%;
}

.app-content__inner {
    width: 100%;
    max-width: 1200px;

    margin-inline: auto;

    /*
     * Extra space below prevents the mobile bottom navigation
     * from covering the page content.
     */
    padding:
        28px
        20px
        calc(104px + env(safe-area-inset-bottom));

    @media (min-width: 768px) {
        padding: 40px 32px 64px;
    }
}
</style>