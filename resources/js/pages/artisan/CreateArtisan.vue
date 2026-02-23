<template>
    <AppLayout>
        <Head>
            <title>Profil erstellen</title>
        </Head>
        <RekaToast  
            to="body" 
            :default-open="showAlert"
            :title="alertMessage" 
            :duration="3000"          
        />
        <main class="card-layout wrapper">
            <ArtisanForm  
                @photos-updated="(photos) => artisanForm.gallery = photos"
                @submit="submit" 
            />
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";

import AppLayout from "@/layout/AppLayout.vue";
import RekaToast from "@/third-party/reka-ui/RekaToast.vue";
import ArtisanForm from "@/components/artisan/ArtisanCreateForm.vue";

import { useAlert } from "@/composables/use-alert";
import { defaultArtisan } from "@/utils/artisans";
import type { FlashProps, FileValue } from "@/types/ui";
import type { Auth } from "@/types/users";
import type { ArtisanProfile } from "@/types/users";

export type ProfileFormData = ArtisanProfile & { gallery: FileValue };

const { auth, flash } = defineProps<{
    auth: Auth;
    flash: FlashProps;
}>();

const {
    showAlert,
    alertMessage
} = useAlert(flash);

const formData: ProfileFormData = Object.assign(defaultArtisan(), { gallery: null });
const artisanForm = useForm<ProfileFormData>(formData);

function submit(artisan: ArtisanProfile): void {
    try {
        if (!auth.user) {
            throw new Error("Can not create profile.");
        }

        Object.assign(artisanForm, artisan);
        artisanForm.post(`/artisan/profile`, {
            onError: () => {}
        }); 
    } catch (error: any) {
        console.error(error);
    }   
}
</script>

<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.wrapper {
    border-radius: 0;
    width: 100%;
    margin: 0;

    @include breakpoints.respond-to('large') {
        border-radius: 16px;
        margin: 48px auto;
        width: 50%;
    }
}
</style>
