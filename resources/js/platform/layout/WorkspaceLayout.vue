<template>
    <div class="workspace-layout">
        <WorkspaceHeader :back-link-href />

        <slot></slot>
    </div>
</template>

<script setup lang="ts">
import WorkspaceHeader from "./workspace/WorkspaceHeader.vue";

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
