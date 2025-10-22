<template>
    <div>{{ auth.user }}</div>
</template>

<script setup lang="ts">
import type { Auth } from '@/types';

defineProps<{
    auth: Auth;
}>();
</script>
