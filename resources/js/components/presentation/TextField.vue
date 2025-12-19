<template>
    <div class="text-field__wrapper">
        <label v-if="label" :for="id">{{ label }}</label>
        <slot name="leadingIcon"></slot>
        <input 
            :id="id"
            :class="{
                'is-invalid': error
            }" 
            :type="type"
            v-model.trim="model"
        />
        <slot name="helper"></slot>
    </div>
</template>

<script setup lang="ts">
import type { VueClass } from "@/types/ui";

const { id, type, error, label } = defineProps<{
    id?: string;
    type: string;
    error?: boolean;
    label?: string;
    inputClasses?: VueClass;
}>();

const model = defineModel({ default: "" });
</script>

<style scoped lang="scss">
.text-field__wrapper {
    display: flex;
    flex-direction: column;
}
</style>