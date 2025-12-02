<template>
    <p class="tag">{{ text }}</p>
</template>

<script setup lang="ts">
defineProps<{
    text: string;
}>();
</script>

<style scoped lang="scss">
.tag {
    background-color: var(--color-primary-10);
    color: var(--color-primary-50);
    width: fit-content;
    padding: 8px 20px;
    border-radius: 15px;
}
</style>