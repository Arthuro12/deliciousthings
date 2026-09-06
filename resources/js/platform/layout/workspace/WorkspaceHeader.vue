<template>
    <header class="workspace-header">
        <div class="workspace-header__inner">
            <Link 
                class="workspace-header__back-link" 
                :href="backLinkHref"
                aria-label="Zurück zu den Projekten"
            >
                <MoveLeft :size="20" :stroke-width="2" color="#4b362f" />
            </Link>
        </div>
    </header>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

import { MoveLeft } from "@lucide/vue";

defineProps<{
    /**
     * URL for navigating back to a specific destination.
     */
    backLinkHref?: string;
}>();
</script>

<style scoped>
.workspace-header {
    height: var(--app-header-height);
    background: var(--color-neutral-50, #fdfbf9);   
    position: fixed;   
    top: 0; 
    left: 0; 
    z-index: 3; 
    width: 100%; 
    display: flex; 
    align-items: center; 
    padding: 0 24px; 
    width: 100%;
    margin: 0 auto;
}

.workspace-header__inner {
    max-width: 90rem;
    width: 100%;
    margin: 0 auto;
}

.workspace-header__back-link { 
    display: inline-flex; 
    align-items: center; 
    justify-content: center; 
    color: var(--color-neutral-700); 
    text-decoration: none; 
    width: calc(0.25rem * 9);
    height: calc(0.25rem * 9);
    border-radius: 0.5rem;

    &:hover {
        background-color: var(--color-neutral-100);
    }
}
</style>