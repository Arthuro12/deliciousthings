<template>
    <AppLayout>
        <Head>
            <title>{{ artisan.company_name || artisan.name }}</title>
        </Head>
        <RekaToast  
            to="body" 
            severity="success" 
            :default-open="showAlert"
            :title="alertMessage" 
            :duration="3000"          
        />

        <main class="artisan-profile">
            <header class="profile-page-header">
                <div class="cover-image"></div>
                <div class="profile-introduction">
                    <ProfileAvatar 
                        class="profile-avatar"
                        alt="Profilbild"
                        :src="artisan.profile_photo?.url ?? ''"
                        :name="artisan.name || artisan.company_name"
                    />
                    <div>
                        <div class="page-header-title">
                            <h1 class="page-title">{{ artisan.name }}</h1>
                            <div class="profile-header-details">
                                <div class="page-subtitle" v-if="pageSubtitle" v-html="pageSubtitle"></div> 
                                <AppButton
                                    class="show-gallery-button"
                                    type="button"
                                    variant="tertiary"
                                    @click="menu = 'gallery'"
                                >
                                    <template #text>Galerie</template>
                                </AppButton> 
                                <QuickInfo class="quick-info-section info--medium" :profile="artisan" />
                            </div>
                        </div>
                    </div>
                </div>

                <QuickInfo class="quick-info-section info--mobile" :profile="artisan" />
                <div>
                    <div class="profile-options" v-if="dietaryOptions.length > 0">
                        <h4 class="option-header option-header--dietary"><WheatIcon color="#e680a5" :size="18" />Ernährungsformen</h4>
                        <div class="options__tags">
                            <AppTag 
                                v-for="option in dietaryOptions" 
                                :key="option.key" 
                                :text="option.label"
                            />
                        </div>
                    </div>
                    <div class="contact-artisan-dialog">
                        <ContactArtisan :artisan />
                    </div>
                </div>
            </header>
            <ArtisanTabs :artisan="artisan" v-model="menu">
                <template #overview>
                    <ArtisanOverview :artisan />
                </template>
                <template #bestsellers>
                    <div class="bestsellers-fallback">
                        <div>
                            <h4>Die beliebste Produkte sind bald verfügbar.</h4>
                        </div>
                        <img class="bestsellers-fallback__image" :src="bakedGoods" alt="Gebäcks" />
                    </div>
                </template>
                <template #gallery>
                    <GalleryDisplay :gallery="artisan.gallery" />
                </template>
            </ArtisanTabs>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { computed, ref, } from "vue";

import { Head } from "@inertiajs/vue3";

import { 
    WheatIcon,
} from "lucide-vue-next";

import AppLayout from "@/plattform/layout/AppLayout.vue";
import ArtisanTabs from "@/components/artisan/ArtisanTabs.vue";
import AppButton from "@/components/presentation/AppButton.vue";
import AppTag from "@/components/presentation/AppTag.vue";
import RekaToast from "@/third-party/reka-ui/RekaToast.vue";
import ProfileAvatar from "@/components/profile/ProfileAvatar.vue";
import ContactArtisan from "@/components/artisan/ArtisanContactDialog.vue";
import ArtisanOverview from "@/components/artisan/ArtisanOverview.vue";
import QuickInfo from "@/components/artisan/partials/QuickInfo.vue";
import GalleryDisplay from "@/components/artisan/gallery/GalleryDisplay.vue";

import bakedGoods from "../../../../images/pastries-and-baked-goods-assortment.webp";

import { useAlert } from "@/composables/use-alert";
import { getPriceLevelSymbol } from "@/utils/artisans";
import type { FlashProps } from "@/types/ui";
import type { ArtisanPublicProfile } from "@/types/users";

const { artisan, flash } = defineProps<{
    artisan: ArtisanPublicProfile;
    flash: FlashProps;
}>();

const {
    showAlert,
    alertMessage
} = useAlert(flash);

const menu = ref("overview");

const dietaryOptions = computed(() => {
    const options = artisan.dietary_options ? artisan.dietary_options : [];
    return options;
});

const pageSubtitle = computed(() => {
    if (artisan.company_name && artisan.price_level) {
        const levelSymbol = getPriceLevelSymbol(artisan.price_level);
        let textOutput = artisan.company_name ?? '';
        textOutput = textOutput ? textOutput + `<span class="separator">•</span>` : '';
        textOutput += levelSymbol;
        return textOutput;
    }
    return "";
});
</script>

<style scoped lang="scss">
@use '../../../../css/abstracts/breakpoints' as breakpoints;

.short-description-wrapper,
.profile-links {
    * {
        font-size: 14px;
    }
}

.cover-image {
    width: 100%;
    height: 200px;
    border-top-left-radius: 16px;
    border-top-right-radius: 16px;
    border-bottom-left-radius: 16px;
    border-bottom-right-radius: 16px;
    background-color: var(--color-primary-10);
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 80 80' width='80' height='80'%3E%3Cg fill='%23e680a5' fill-opacity='0.4'%3E%3Cpath d='M0 0h80v80H0V0zm20 20v40h40V20H20zm20 35a15 15 0 1 1 0-30 15 15 0 0 1 0 30z' opacity='.5'%3E%3C/path%3E%3Cpath d='M15 15h50l-5 5H20v40l-5 5V15zm0 50h50V15L80 0v80H0l15-15zm32.07-32.07l3.54-3.54A15 15 0 0 1 29.4 50.6l3.53-3.53a10 10 0 1 0 14.14-14.14zM32.93 47.07a10 10 0 1 1 14.14-14.14L32.93 47.07z'%3E%3C/path%3E%3C/g%3E%3C/svg%3E");
}

.profile-page-header {
    display: flex;
    flex-direction: column;
    position: relative;
    padding: 20px 14px;
    row-gap: 12px;

    .page-subtitle {
        span {
            margin: 0 4px;
        }
    }

    .profile-introduction {
        display: flex;
        column-gap: 12px;
    }
}

.quick-info-section {
   &.info--mobile {
        display: block;

        @include breakpoints.respond-to('medium') {
            display: none;
        }
   }

   &.info--medium {
       display: none;

        @include breakpoints.respond-to('medium') {
            display: block;
        }
   }
}

.contact-artisan-dialog {
    display: flex;
    justify-content: center;
    margin: 16px 0;

    @include breakpoints.respond-to('medium') {
        justify-content: start;
    }
}

.profile-options {
    .options__tags {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .option-header--dietary {
        margin: 0 0 12px 0;
    }
}

.bestsellers-fallback {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    padding: 16px;

    &__image {
        width: 253px;
        height: 224px;
    }
}
</style>