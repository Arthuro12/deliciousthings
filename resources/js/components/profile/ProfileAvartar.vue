<template>
    <RekaAvatar 
        :src="src" 
        :alt="alt" 
        :fallback-text="fallbackText"
    />
</template>

<script setup lang="ts">
import RekaAvatar from "@/third-party/reka-ui/RekaAvatar.vue";

defineProps<{
    src: string;
    alt: string;
    fallbackText?: string;
}>();
</script>