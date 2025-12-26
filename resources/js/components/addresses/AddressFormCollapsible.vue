<template>
    <div>
        <button 
            class="toggle-button" 
            type="button" @click="formIsVisible = !formIsVisible"
        >
            Standort (optional)
            <MinusIcon v-show="formIsVisible" />
            <PlusIcon v-show="!formIsVisible" />
        </button>
        <slot :show="formIsVisible"></slot>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import { PlusIcon, MinusIcon } from "lucide-vue-next";

const formIsVisible = ref(false);
</script>

<style scoped lang="scss">
.toggle-button {
    display: flex;
    justify-content: space-between;
    align-items: center;
    column-gap: 12px;
    color: var(--color-neutral-50);
    padding: 12px;
    width: 100%;

    &:hover {
        background-color: var(--color-primary-10);
        border-radius: 5px;
    }
}
</style>