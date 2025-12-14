<template>
    <AppLayout>
        <Head>
            <title>Profil erstellen</title>
        </Head>
        <main class="create-profile-page">
            <ProfileForm 
                class="card-layout" 
                @photos-uploaded="(photos) => profileForm.gallery = photos"
                @submit="submit" 
            />
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

import ProfileForm from "@/components/profile/ProfileForm.vue";
import AppLayout from "@/layout/AppLayout.vue";

import { defaultProfile } from "@/utils/artisans";
import type { FileValue } from "@/types/ui";
import type { Auth } from "@/types/users";
import type { ArtisanPublicProfile } from "@/types/users";

const { auth } = defineProps<{
    auth: Auth;
}>();

export type ProfileFormData = ArtisanPublicProfile & { gallery: FileValue };

const formData: ProfileFormData = Object.assign(defaultProfile(), { gallery: null });

const profileForm = useForm<ProfileFormData>(formData);

function submit(profile: ArtisanPublicProfile): void {
    try {
        if (!auth.user) {
            throw new Error("Can not create profile.");
        }
        Object.assign(profileForm, profile);
        profileForm.post(`/users/${auth.user.id}/profile`, {
            onError(event) {}
        }); 
    } catch (error: any) {
        console.error(error);
    }   
}
</script>
