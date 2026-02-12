<template>
    <div class="form__group">
        <slot name="header"></slot>
        <div class="gallery">
            <div 
                class="preview" 
                v-for="photo in gallery" 
                :key="photo.url"
            >
                <img class="preview__photo" :src="photo.url" alt="" />
                <AppButton
                    class="delete-button"
                    type="button"
                    variant="primary"
                    layout="icon"
                    @click="deletePhoto(photo.id as number)"
                >
                    <template #leading><TrashIcon :size="12" /></template>
                </AppButton>
            </div>
        </div>
        <FileUpload
            id="gallery"
            accept=".jpg, .jpeg, .png"
            multiple
            v-model="form.gallery"
        />
        <AppButton
            class="align-end"
            type="button"
            variant="primary"
            size="medium"
            @click="uploadPhotos"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { router, useForm } from "@inertiajs/vue3";

import { TrashIcon } from "lucide-vue-next";

import AppButton from "../presentation/AppButton.vue";
import FileUpload from "../presentation/FileUpload.vue";

import type { FileValue } from "@/types/ui";
import type { Image } from "@/types/users";

defineProps<{
    gallery: Image[];
}>();

const form = useForm({ gallery: <FileValue>[] });

function deletePhoto(id: number): void {
    router.delete(`/artisan/profile/gallery/${id}`);
}

function uploadPhotos(): void {
    form.post("/artisan/profile/gallery");
}
</script>

<style scoped lang="scss">
.gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(105px, 100%), 1fr));
    gap: 16px;

    .preview {
        position: relative;

        &__photo {
            width: 100%;
            height: 130px;
            border-radius: 5px;
        }

        .delete-button {
            position: absolute;
            top: 5px;
            right: 5px;
        }
    }
}
</style>
