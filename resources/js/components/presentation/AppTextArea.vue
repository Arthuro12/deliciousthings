<template>
    <div class="text-area__wrapper">
        <label :for="id">{{ label }}</label>
        <textarea 
            :id="id"  
            :rows="rows"       
            v-model.trim="model"
        >
        </textarea>
    </div>
</template>

<script setup lang="ts">
defineProps<{
    id?: string;
    rows?: string;
    label: string;
}>();

const model = defineModel<string | null>("model", { default: "" });
</script>
