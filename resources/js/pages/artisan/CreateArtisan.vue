<template>
    <AppLayout>
        <Head>
            <title>Profil erstellen</title>
        </Head>
        <main>
            <ArtisanForm 
                class="card-layout" 
                @photos-uploaded="(photos) => artisanForm.gallery = photos"
                @submit="submit" 
            />
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

import ArtisanForm from "@/components/artisan/ArtisanForm.vue";
import AppLayout from "@/layout/AppLayout.vue";

import { defaultArtisan } from "@/utils/artisans";
import type { FileValue } from "@/types/ui";
import type { Auth } from "@/types/users";
import type { ArtisanPublicProfile } from "@/types/users";

const { auth } = defineProps<{
    auth: Auth;
}>();

export type ProfileFormData = ArtisanPublicProfile & { gallery: FileValue };

const formData: ProfileFormData = Object.assign(defaultArtisan(), { gallery: null });

const artisanForm = useForm<ProfileFormData>(formData);

function submit(artisan: ArtisanPublicProfile): void {
    try {
        if (!auth.user) {
            throw new Error("Can not create profile.");
        }
        Object.assign(artisanForm, artisan);
        artisanForm.post(`/users/${auth.user.id}/artisan`, {
            onError(event) {}
        }); 
    } catch (error: any) {
        console.error(error);
    }   
}
</script>
