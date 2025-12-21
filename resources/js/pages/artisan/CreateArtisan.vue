<template>
    <AppLayout>
        <Head>
            <title>Profil erstellen</title>
        </Head>
        <RekaToast  
            to="body" 
            :default-open="showAlert"
            :title="pageAlertMessage" 
            :duration="3000"          
        />
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
import { computed, ref } from "vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

import AppLayout from "@/layout/AppLayout.vue";
import RekaToast from "@/third-party/reka-ui/RekaToast.vue";
import ArtisanForm from "@/components/artisan/ArtisanForm.vue";

import { defaultArtisan } from "@/utils/artisans";
import type { FlashProps, FileValue } from "@/types/ui";
import type { Auth } from "@/types/users";
import type { ArtisanPublicProfile } from "@/types/users";

const { auth, flash } = defineProps<{
    auth: Auth;
    flash: FlashProps;
}>();

export type ProfileFormData = ArtisanPublicProfile & { gallery: FileValue };

const formData: ProfileFormData = Object.assign(defaultArtisan(), { gallery: null });
const artisanForm = useForm<ProfileFormData>(formData);

const pageAlertMessage = computed(() => {
    if ("info" in flash) {
        return flash.info || flash.success || "";
    } else if ("severity" in flash) {
        return flash.message;
    }
    return "";
});

const showAlert = ref(Boolean(pageAlertMessage.value));

function submit(artisan: ArtisanPublicProfile): void {
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
