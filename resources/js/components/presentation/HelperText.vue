<template>
    <div class="wrapper">
        <Info fill="#f73003" /><p>{{ text  }}</p>
    </div>
</template>

<script setup lang="ts">
import Info from "@/components/icons/Info.vue";

defineProps<{
    text: string;
}>();
</script>

<style scoped>
.wrapper {
    display: flex;
    align-items: center;
    column-gap: 4px;

    > p {
        color: #f73003;
    }
}
</style>