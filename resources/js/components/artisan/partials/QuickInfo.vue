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
                    color: '#0f0f0f',
                    left: moreButtonLeft,
                }"
                @click="onShowInfo"
            >...mehr</button>
        </div>
        <div class="profile-links">
            <a
                v-if="displayLink"
                class="link--blue"
                :href="displayLink" 
                target="_blank"
            >{{ displayLink }}</a>
            <button 
                class="font-semibold"
                :style="{
                    color: '#0f0f0f',
                }"
                v-if="moreLinksButtonIsVisible"
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

import { useBreakpoints, } from "@/composables/use-breakpoints";
import type { ArtisanPublicProfile } from "@/types/users";

const { profile, } = defineProps<{
    profile: ArtisanPublicProfile;
}>();

const { isSmallDevice, } = useBreakpoints();

const shortDescriptionText = useTemplateRef("shortDescriptionText");

const showInfo = ref(false);
const moreButtonLeft = ref<number | string>(0);

const displayLink = computed(() => profile.website_url ?? profile.instagram_url);

const moreButtonIsVisible = computed(() => {
    const text = shortDescriptionDisplay.value;
    return text && text.length > visibleDescriptionLength.value;
});

const moreLinksButtonIsVisible = computed(() => {
    return !!(profile.website_url && profile.instagram_url);
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

const visibleDescriptionLength = computed(() => isSmallDevice.value ? 28 : 59);

function onShowInfo(): void {
    if (!showInfo.value) {
        showInfo.value = true;
    }
}

function updateMoreButtonLeft(): void {
    if (shortDescriptionText.value) {
        moreButtonLeft.value = shortDescriptionText.value.clientWidth + 12 + "px";
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