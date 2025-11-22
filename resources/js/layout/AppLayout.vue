<template>
    <header class="app-header">
        <a class="logo" href="/"><AppLogo class="logo" /></a>
        <AppNavbar />
    </header>

    <slot></slot>

    <AppFooter />
</template>

<script setup lang="ts">
import AppLogo from "@/components/icons/AppLogo.vue";
import AppNavbar from "@/components/presentation/AppNavbar.vue";
import AppFooter from "@/components/presentation/AppFooter.vue";
</script>
