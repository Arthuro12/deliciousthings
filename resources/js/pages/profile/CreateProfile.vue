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

import type { ArtisanProfile } from "@/types";
import { defaultProfile } from "@/utils/artisans";

const profileForm = useForm<ArtisanProfile>(defaultProfile());

function submit(profile: ArtisanProfile) {
    Object.assign(profileForm, profile);
}
</script>
