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
    background-color: #E6ACA9;
    color: #99201a;
    text-align: center;
    padding: 1rem;
    border-radius: 5px;
}
</style>