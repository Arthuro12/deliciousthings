<template>
    <RekaDialog
        :title="`${profile.name}`"
        v-model:open="isOpen"
    >
        <div class="info-popup-content">
            <section class="info__section" v-if="profile.short_description">
                <header class="info-section-header">Kurze Beschreibung</header>
                <p class="info--description">{{ profile.short_description }}</p>
            </section>

            <section class="info__section info__links">
                <header class="info-section-header">Links</header>
                <a
                    class="info__detail"
                    :href="`${profile.website_url}`"
                    target="_blanc"
                >
                   <GlobeIcon color="#0f0f0f" />{{ profile.website_url }} 
                </a>
                <a
                    class="info__detail"
                    v-if="profile.instagram_url"
                    :href="`${profile.instagram_url}`"
                    target="_blanc"
                >
                   <Instagram 
                        :style="{
                            heigth: '24px',
                            width: '24px',
                        }" 
                    />
                    {{ profile.instagram_url }} 
                </a>
            </section>

            <section 
                class="info__section info__location" 
                v-if="profile.first_address && profile.first_address.visibility != AddressVisibility.Private">
                <header class="info-section-header">Standort</header>
                <div class="info__detail">
                    <MapPinIcon color="#0f0f0f" />
                    {{ profile.first_address.city }}
                </div>
            </section>
        </div>
    </RekaDialog>
</template>

<script setup lang="ts">
import { GlobeIcon, MapPinIcon } from "lucide-vue-next";

import RekaDialog from "@/third-party/reka-ui/RekaDialog.vue";

import { AddressVisibility } from "@/enums";
import type { ArtisanPublicProfile, } from "@/types/users";
import Instagram from "@/components/icons/Instagram.vue";

const { profile, } = defineProps<{
    profile: ArtisanPublicProfile;
}>();

const isOpen = defineModel("open", { default: false });
</script>

<style scoped lang="scss">
.info-popup-content {
    margin: 18px 0;
}

.info__section {
    margin-bottom: 8px;
}

.info--description {
    font-size: var(--text-sm);
    color: var(--color-neutral-40);
}

.info-section-header {
    font-size: 1rem;
    font-weight: 600;
    color: var(--color-neutral-40);
    margin-bottom: 8px;
}

.info__detail {
    display: flex;
    column-gap: 8px;
    color: var(--color-neutral-40);
}

.info__links {
    .info__detail:not(:last-child) {
        margin-bottom: 12px;
    }
}
</style>