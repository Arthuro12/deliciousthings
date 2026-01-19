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
        <main class="row show-artisan-page">
            <div class="column">
                <div class="profile__intro">
                    <ProfileAvartar 
                        class="profile__avatar" 
                        :src="profile_photo?.url ?? ''" 
                        alt="Profile-Avatar"
                        :name="artisan.company_name || artisan.name" 
                    />
                    <div>
                        <h1 class="profile__title">{{ artisan.name }}</h1>
                        <h2 class="profile__subtitle" v-if="pageSubtitle">{{ pageSubtitle }}</h2>
                    </div>
                </div>
                <div><p>{{ artisan.short_description }}</p></div>
                <div>
                    <h4>Über</h4>
                    <p>{{ artisan.about }}</p>
                </div>
                <div>
                    <h4>Spezialitäten</h4>
                    <div class="profile__specialities">
                        <AppTag 
                            v-for="speciality in artisan.specialities" 
                            :key="speciality.key" 
                            :text="speciality.label"
                        />
                    </div>
                </div>
                <div v-if="artisan.diet_types && artisan.diet_types.length > 0">
                    <h4>Angebotene Ernährungsformen</h4>
                    <div class="profile__diet-types">
                        <AppTag 
                            v-for="dietType in artisan.diet_types" 
                            :key="dietType.key" 
                            :text="dietType.label"
                        />
                    </div>
                </div>
                <div class="gallery">
                    <h4>Galerie</h4>
                    <EmblaCarousel 
                        :slides="gallery"
                        v-slot="{ slide }"
                    >
                        <img class="gallery__image" :src="slide.url" />
                    </EmblaCarousel>
                </div>
                <div v-if="address">
                    <div class="card profile-card">
                        <AddressPreview :address="address" />
                    </div>
                </div>
                <div class="profile__services">
                    <h4>Leistungen</h4>
                    <div class="profile__service-option">
                        <p v-if="artisan.offers_delivery"><CheckIcon color="#e680a5" :size="20" />Lieferdienst</p>
                        <p v-if="artisan.pick_up_on_site"><CheckIcon color="#e680a5" :size="20" />Abholung vor Ort</p>
                    </div>
                    <div><p>Durchschnittpreis: {{ artisan.average_rate }}</p></div>
                </div>
                <div v-show="showNetworkInfo">
                    <h4>Netzwerk</h4>
                    <div class="card profile-card">
                        <p class="profile-card__item" v-if="artisan.website_url"><ExternalLinkIcon color="#e680a5" :size="20" /><a class="link--neutral" :href="artisan.website_url" target="_blank">Webseite</a></p>
                        <p class="profile-card__item" v-if="artisan.instagram_url"><ExternalLinkIcon color="#e680a5" :size="20" /><a class="link--neutral" :href="artisan.instagram_url" target="_blank">Instragram-Seite</a></p>
                    </div>
                </div>
            </div>
            <div class="column contact-dialog-wrapper">
                <ContactArtisan />
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { computed } from "vue";

import { Head } from "@inertiajs/vue3";

import { CheckIcon, ExternalLinkIcon } from "lucide-vue-next";

import AppLayout from "@/layout/AppLayout.vue";
import AppTag from "@/components/presentation/AppTag.vue";
import RekaToast from "@/third-party/reka-ui/RekaToast.vue";
import EmblaCarousel from "@/third-party/embla/EmblaCarousel.vue";
import ProfileAvartar from "@/components/profile/ProfileAvartar.vue";
import AddressPreview from "@/components/addresses/AddressPreview.vue";
import ContactArtisan from "@/components/artisan/ArtisanContactDialog.vue";

import { useAlert } from "@/composables/use-alert";
import { FlashProps } from "@/types/ui";
import type { ArtisanProfile, Image } from "@/types/users";

const { flash, artisan, gallery, } = defineProps<{
    artisan: ArtisanProfile;
    profile_photo?: Image;
    gallery: Image[];
    flash: FlashProps;
}>();

const {
    showAlert,
    alertMessage
} = useAlert(flash);

const address = artisan.first_address;

const pageSubtitle = computed(() => {
    if (artisan.company_name || artisan.main_occupation) {
        const textOutput = `${artisan.company_name && artisan.main_occupation 
            ? `${artisan.company_name} | ${artisan.main_occupation}` 
            : !artisan.main_occupation ? `${artisan.company_name}` 
            : `${artisan.main_occupation}`}`;
        return textOutput;
    }
    return "";
});

const showNetworkInfo = computed(() => artisan.website_url || artisan.instagram_url);
</script>

<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.contact {
    display: flex;
    column-gap: 12px;
    align-items: center;
}

.profile-card {
    display: flex;
    flex-direction: column;
    row-gap: 12px;

    &__item {
        display: flex;
        align-items: center;
        column-gap: 12px;
    }
}

.profile__specialities, 
.profile__diet-types {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.profile__services {
    > .profile__service-option {
        margin-bottom: 12px;

        > p {
            display: flex;
            column-gap: 12px;
        }
    }
}

.gallery {
    &__image {
        width: 100%;
        max-height: 200px;
        border-radius: 20px;
    }
}

.address-details {
    display: flex;
    flex-direction: column;
}

.contact-dialog-wrapper {
    position: sticky;
    bottom: 20px;
    display: flex;
    justify-content: center;
    padding: 8px 24px;
    border-radius: 8px;
    width: 100%;
    height: fit-content;

    @include breakpoints.respond-to('medium') {
        top: 20px;
        width: 40%;
    }
}
</style>