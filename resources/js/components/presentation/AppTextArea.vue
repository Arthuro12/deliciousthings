<template>
    <div class="text-zone__wrapper">
        <label :for="id">{{ label }}</label>
        <textarea :id="id" v-model="model" :rows="rows"></textarea>
    </div>
</template>

<script setup lang="ts">
defineProps<{
    id?: string;
    rows?: string;
    label: string;
}>();

const model = defineModel("model", { default: "" });
</script>

<style scoped>
.text-zone__wrapper {
    display: flex;
    flex-direction: column;
}
</style>