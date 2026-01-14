<template>
    <div class="form__group">
        <slot name="header"></slot>
        <ArtisanGalleryPreview :gallery="gallery" />
        <FileUpload
            id="gallery"
            accept=".jpg, .jpeg, .png"
            multiple
            v-model="form.gallery"
        />
        <AppButton
            class="align-end"
            type="button"
            layout="text"
            variant="primary"
            @click="uploadPhotos"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";
import FileUpload from "../presentation/FileUpload.vue";
import ArtisanGalleryPreview from "./ArtisanGalleryPreview.vue"; 

import type { FileValue } from "@/types/ui";
import type { Image } from "@/types/users";

defineProps<{
    gallery: Image[];
}>();

const form = useForm({ gallery: <FileValue>[] });

function uploadPhotos(): void {
    form.post("/artisan/profile/gallery");
}
</script>
