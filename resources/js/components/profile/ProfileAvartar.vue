<template>
    <RekaAvatar 
        class="profile-avatar"
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

<style scoped>
.profile-avatar :deep(.avatar__image) {
    object-fit: cover;
}
</style>
