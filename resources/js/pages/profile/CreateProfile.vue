<template>
    <AppLayout>
        <ProfileForm />
    </AppLayout>
</template>

<script setup lang="ts">
import ProfileForm from "@/components/profile/ProfileForm.vue";
import AppLayout from "@/layout/AppLayout.vue";

import type { Auth } from "@/types";

defineProps<{
    auth: Auth;
}>();
</script>
