<template>
    <div class="workspace-layout app-layout">
        <AppHeader :links="links" />
        <AppSidebar :links="links" />
        <div class="app-main">
        <WorkspaceHeader :back-link-href="backLinkHref ?? '/app/projects'" />
            <slot />
        </div>
        <AppBottomNavBar :links="links" />
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import type { AppPageProps } from '@/types';
import AppHeader from './AppHeader.vue';
import AppSidebar from './AppSidebar.vue';
import AppBottomNavBar from './AppBottomNavBar.vue';
import WorkspaceHeader from "./workspace/WorkspaceHeader.vue";

const page = usePage();
const links = computed(() => (page.props as AppPageProps).links);

defineProps<{
    /**
     * URL for navigating back to a specific destination.
     */
    backLinkHref?: string;
}>();
</script>

<style scoped>
.workspace-layout {
    min-height: 100dvb;
}
</style>
