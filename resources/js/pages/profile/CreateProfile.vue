<template>
    <AppLayout>
        <main class="create-profile-page">
            <ProfileForm class="card-layout" @submit="submit" />
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { useForm, router } from "@inertiajs/vue3";

import ProfileForm from "@/components/profile/ProfileForm.vue";
import AppLayout from "@/layout/AppLayout.vue";

import type { ArtisanProfile, Auth } from "@/types";
import { defaultProfile } from "@/utils/artisans";

const { auth } = defineProps<{
    auth: Auth;
}>();

const profileForm = useForm<ArtisanProfile>(defaultProfile());

function submit(profile: ArtisanProfile) {
    Object.assign(profileForm, profile);
}

// watch(() => profileForm, () => {
//     console.log("Updated form", profileForm);
// }, { deep: true });
</script>
