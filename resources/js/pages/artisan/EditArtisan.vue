<template>
    <AppLayout>
        <Head>
            <title>Profil bearbeiten</title>
        </Head>
        <ArtisanForm 
            class="card-layout" 
            :default-value="artisan"
            @submit="(value) => console.log(value)" 
        />
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";

import AppLayout from "@/layout/AppLayout.vue";
import ArtisanForm from "@/components/artisan/ArtisanCreateForm.vue";

import type { ArtisanProfile, Image } from "@/types/users";

defineProps<{
    artisan: ArtisanProfile;
    gallery: Image[];
}>();
</script>

