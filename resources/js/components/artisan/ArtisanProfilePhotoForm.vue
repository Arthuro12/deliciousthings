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
                class="button-input button--primary" 
                for="profile-photo"
            >
                <UploadIcon color="#fff" :size="18"  />
                <span>Bild hochladen</span>
            </label>
            <AppButton
                class="button-input"
                type="button"
                variant="secondary"
                layout="with-icon"
                size="small"
                :disabled="disableDeleteButton"
                @click="deleteProfilePhoto"
            >
                <template #leading><TrashIcon :size="18" /></template>
                <template #text><span>Bild löschen</span></template>
            </AppButton>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from "vue";

import { router } from "@inertiajs/vue3";

import { UploadIcon, TrashIcon } from "lucide-vue-next";

import AppButton from "../presentation/AppButton.vue";
import ProfileAvartar from "../profile/ProfileAvatar.vue";

import type { FileValue } from "@/types/ui";
import type { Image } from "@/types/users";

const { profilePhoto = null } = defineProps<{
    profileName: string;
    profilePhoto?: Image | null;
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
@use "../../../css/abstracts/breakpoints" as breakpoints;

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

    .button-input {
        font-size: var(--text-sm);
        display: flex;
        justify-content: center;
        column-gap: 12px;
        align-items: center;
        line-height: 1.4;
        text-align: center;
        border-radius: 5px;
        padding: 5px 12px;
        cursor: pointer;

        @include breakpoints.respond-to('medium') {
            font-size: var(--text-base);
        }
    }
}
</style>