<template>
    <RekaAvatar 
        :src="src" 
        :alt="alt" 
        :name="name"
    />
</template>

<script setup lang="ts">
import RekaAvatar from "@/third-party/reka-ui/RekaAvatar.vue";

defineProps<{
    src: string;
    alt?: string;
    name?: string;
}>();
</script>
