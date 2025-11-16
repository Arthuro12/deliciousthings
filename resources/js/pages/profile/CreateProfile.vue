<template>
    <AppLayout>
        <main class="create-profile-page">
            <ProfileForm class="card-layout" @submit="submit" />
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import ProfileForm from "@/components/profile/ProfileForm.vue";
import AppLayout from "@/layout/AppLayout.vue";

import { defaultProfile } from "@/utils/artisans";
import type { Auth } from "@/types/users";
import type { ArtisanProfile } from "@/types/users";

const { auth } = defineProps<{
    auth: Auth;
}>();

const profileForm = useForm<ArtisanProfile>(defaultProfile());

function submit(profile: ArtisanProfile): void {
    Object.assign(profileForm, profile);
    profileForm.post(`/users/${auth.user.id}/profile`);
}
</script>
