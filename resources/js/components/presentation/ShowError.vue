<template>
    <p>{{ message }}</p>
</template>

<script setup lang="ts">
defineProps<{
    message: string;
}>();
</script>

<style scoped>
p {
    background-color: var(--color-error-10);
    color: var(--color-error-50);
    text-align: center;
    padding: 1rem;
    border-radius: 5px;
}
</style>