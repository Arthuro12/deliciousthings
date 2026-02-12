<template>
    <div>
        <RekaDialog title="Suche">
            <template #trigger>
                <button
                    class="search-button button button--with-icon button--medium"
                    type="button" 
                    variant="primary" 
                    layout="with-icon"
                    size="large"
                >
                    Suchen
                    <SlidersHorizontalIcon />
                </button>
            </template>
            <div></div>
        </RekaDialog>
    </div>
</template>

<script setup lang="ts">
import {  SlidersHorizontalIcon } from "lucide-vue-next";

import RekaDialog from "@/third-party/reka-ui/RekaDialog.vue";
</script> 

<style scoped lang="scss">
.search-button {
    background-color: var(--color-neutral-0);
    color: var(--color-primary-50);
    border-radius: 24px;
}
</style>