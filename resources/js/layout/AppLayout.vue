<template>
    <div>
        <AppHeader />

        <slot></slot>

        <AppFooter />
    </div>
</template>

<script setup lang="ts">
import AppHeader from "./app/AppHeader.vue";
import AppFooter from "@/components/presentation/AppFooter.vue";
</script>
