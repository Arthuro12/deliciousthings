<template>
    <div class="wrapper">
        <div class="logo-wrapper">
            <a class="logo" href="/">DELICIOUSthings</a>
        </div>
        <slot></slot>
    </div>
</template>

<script setup lang="ts">
import { Link, } from "@inertiajs/vue3";
</script>

<style scoped>
.wrapper {
    padding: 0 16px 16px;

    .logo-wrapper {
        margin-bottom: 24px;
    }

    .logo-wrapper > a {
        display: block;
        width: fit-content;
        padding: 12px 0;
    }
}
</style>