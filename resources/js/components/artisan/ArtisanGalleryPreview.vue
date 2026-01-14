<template>
    <div class="gallery">
        <template v-for="photo in gallery" :key="photo.url">
            <div class="preview">
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
        </template>
    </div>
</template>

<script setup lang="ts">
import { router } from "@inertiajs/vue3";

import { TrashIcon } from "lucide-vue-next";

import AppButton from "../presentation/AppButton.vue";

import type { Image } from "@/types/users";

defineProps<{
    gallery: Image[]
}>();

function deletePhoto(id: number): void {
    router.delete(`/artisan/profile/gallery/${id}`);
}
</script>

<style scoped lang="scss">
.gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(105px, 1fr));
    gap: 16px;

    .preview {
        position: relative;

        &__photo {
            width: 100%;
            max-height: 130px;
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