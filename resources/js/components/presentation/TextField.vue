<template>
    <div class="text-field__wrapper">
        <label v-if="label" :for="id">{{ label }}</label>
        <input 
            :id="id"
            :class="{
                'is-invalid': error
            }" 
            :type="type"
            :value="model"
            @input="onInput"
            @change="onChange"
        />
        <slot name="icon"></slot>
        <slot name="helper"></slot>
    </div>
</template>

<script setup lang="ts">
import type { VueClass } from "@/types/ui";

const { 
    id, 
    type, 
    lazy = true, 
    error, 
    label, 
} = defineProps<{
    id?: string;
    type: string;
    lazy?: boolean;
    error?: boolean;
    label?: string;
    inputClasses?: VueClass;
}>();

const model = defineModel<string | null | undefined>({ default: "", required: false });

function onChange(event: Event): void {
    if (lazy) {
        model.value = (event.target as HTMLInputElement).value.trim();
    }
}

function onInput(event: Event): void {
    if (!lazy) {
        model.value = (event.target as HTMLInputElement).value.trim();
    }
}
</script>

<style scoped lang="scss">
.text-field__wrapper {
    display: flex;
    flex-direction: column;
}
</style>