<template>
    <div class="profile-photo-form">
        <ProfileAvartar 
            class="profile-avatar"
            :src="profilePhoto?.url ?? ''" 
            :name="profileName"
            alt=""
        />
        <input 
            id="profile-photo"
            type="file" 
            accept=".jpg, .jpeg, .png" 
            hidden
            @input="handleUpdate"
        />
        <div class="actions">
            <label 
                class="button button--primary button--with-icon cursor--pointer" 
                for="profile-photo"
            >
                <UploadIcon color="#fff" />
                <p>Bild hochladen</p>
            </label>
            <AppButton
                type="button"
                variant="secondary"
                layout="with-icon"
                :disabled="disableDeleteButton"
                @click="deleteProfilePhoto"
            >
                <template #leading><TrashIcon /></template>
                <template #text><p>Bild löschen</p></template>
            </AppButton>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from "vue";

import { router } from "@inertiajs/vue3";

import { UploadIcon, TrashIcon } from "lucide-vue-next";

import AppButton from "../presentation/AppButton.vue";
import ProfileAvartar from "../profile/ProfileAvartar.vue";

import type { FileValue } from "@/types/ui";
import type { Image } from "@/types/users";

const { profilePhoto } = defineProps<{
    profileName: string;
    profilePhoto?: Image;
}>();

const disableDeleteButton = computed(() => !profilePhoto);

function deleteProfilePhoto(): void {
    if (profilePhoto?.id) {
        router.delete(`/artisan/profile/photo/${profilePhoto.id}`);
    }
}

function handleUpdate(event: Event): void {
    const photo = (event.target as HTMLInputElement).files?.[0] as FileValue;
    router.post("/artisan/profile/photo", {
        _method: "put",
        profile_photo: photo,
    });
}
</script>

<style scoped lang="scss">
.profile-photo-form {
    display: flex;
    flex-direction: column;
    row-gap: 16px;

    .profile-avatar {
        align-self: center;
    }

    .actions {
        display: flex;
        justify-content: center;
        column-gap: 16px;
    }
}
</style>