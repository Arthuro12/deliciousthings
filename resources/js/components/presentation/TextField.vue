<template>
    <div class="text-field__wrapper">
        <label v-if="label" :for="id">{{ label }}</label>
        <slot name="leadingIcon"></slot>
        <input 
            :class="{
                'is-invalid': error
            }" 
            :type="type"
            v-model="model"
        />
        <slot name="helper"></slot>
    </div>
</template>

<script setup lang="ts">
import type { VueClass } from "@/types";
const { id, type, error, label } = defineProps<{
    id?: string;
    type: string;
    error?: boolean;
    label?: string;
    inputClasses?: VueClass;
}>();

const model = defineModel("model", {
    default: ""
});
</script>

<style scoped>
.text-field__wrapper {
    display: flex;
    flex-direction: column;
}

input.is-invalid:focus-visible {
    outline: none;
}

input.is-invalid {
    border: 2px solid #f73003;
}
</style>