<template>
    <AppLayout>
        <main class="create-profile-page">
            <ProfileForm class="card-layout" />
        </main>
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
