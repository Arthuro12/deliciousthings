<template>
    <AppLayout>
        <div>{{ auth.user }}</div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layout/AppLayout.vue';
import type { Auth } from '@/types';

defineProps<{
    auth: Auth;
}>();
</script>
