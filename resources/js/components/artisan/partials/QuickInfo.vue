<template>
    <div>
        <div class="short-description-wrapper">
            <p 
                ref="shortDescriptionText"
                class="short-description-preview" 
                v-if="profile.short_description"
            >
                {{ shortDescriptionDisplay }}
            </p>
            <button 
                class="font-semibold button more-details-button" 
                v-if="moreButtonIsVisible"
                type="button"
                :style="{
                    left: moreButtonLeft,
                }"
            @click="onShowInfo"
            >...mehr</button>
        </div>
        <div class="profile-links">
            <a
                v-if="profile.website_url"
                class="link--blue"
                :href="profile.website_url" 
                target="_blank"
            >{{ profile.website_url }}</a>
            <button 
                class="font-semibold"
                v-if="profile.instagram_url && moreButtonIsVisible"
                type="button"
                @click="onShowInfo"
            >
                und ein weiterer Link
            </button>
        </div>

        <ProfileInfoPopup 
            :profile="profile" 
            v-model:open="showInfo"
        />
    </div>
</template>

<script setup lang="ts">
import { computed, ref, useTemplateRef, onMounted, onUnmounted, } from "vue";

import ProfileInfoPopup from "./ProfileInfoPopup.vue";

import { useDeviceSize, } from "@/composables/use-device-size";
import type { ArtisanPublicProfile } from "@/types/users";

const { profile, } = defineProps<{
    profile: ArtisanPublicProfile;
}>();

const { isSmallDevice, } = useDeviceSize();

const shortDescriptionText = useTemplateRef("shortDescriptionText");

const showInfo = ref(false);
const moreButtonLeft = ref<number | string>(0);

const moreButtonIsVisible = computed(() => {
    const hasMoreLinks = !!(profile.website_url && profile.instagram_url);
    if (profile.short_description || hasMoreLinks) {
        return true;
    }

    return false;
});

const shortDescriptionDisplay = computed(() => {
    const description = profile.short_description;
    const visibleTextLenght = visibleDescriptionLength.value;
    if (!description) {
        return "";
    } else if (description.length > visibleTextLenght) {
        return `${description.slice(0, visibleTextLenght + 1)}`;
    }
    return description;
});

const visibleDescriptionLength = computed(() => isSmallDevice.value ? 40 : 150);

function onShowInfo(): void {
    if (!showInfo.value) {
        showInfo.value = true;
    }
}

function updateMoreButtonLeft(): void {
    if (shortDescriptionText.value) {
        moreButtonLeft.value = shortDescriptionText.value.clientWidth + 5 + "px";
    }
}

onMounted(() => {
    updateMoreButtonLeft();
    window.addEventListener("resize", updateMoreButtonLeft);
});

onUnmounted(() => {
    window.addEventListener("resize", updateMoreButtonLeft);
});
</script>

<style scoped lang="scss">
.short-description-wrapper {
    position: relative;

    .short-description-preview {
        color: var(--color-neutral-30);
        overflow: hidden;
        white-space: nowrap;
        text-overflow: clip;
        width: fit-content;
    }

    .more-details-button {
        position: absolute;
        top: 0;
    }
}

.profile-links {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin: 12px 0;
}
</style>