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
                        :src="artisan.profile_photo?.url ?? ''" 
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
                    <h4>Angebotene Backwaren</h4>
                    <div class="profile__baked-goods">
                        <AppTag 
                            v-for="good in artisan.baked_goods" 
                            :key="good.key" 
                            :text="good.label"
                        />
                    </div>
                </div>
                <div v-if="artisan.dietary_options && artisan.dietary_options?.length > 0">
                    <h4>Angebotene Ernährungsformen</h4>
                    <div class="profile__dietary-options">
                        <AppTag 
                            v-for="option in artisan.dietary_options" 
                            :key="option.key" 
                            :text="option.label"
                        />
                    </div>
                </div>
                <div>
                    <h4>Galerie</h4>
                    <div class="gallery__preview">
                        <div 
                            v-for="image in artisan.gallery" 
                            :key="image.url" 
                        >                        
                                <img 
                                    class="gallery__image" 
                                    :src="image.url" 
                                />
                        </div>
                    </div>
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
                    <div><p>Durchschnittpreis: {{ getPriceDisplay(artisan.average_rate) }}</p></div>
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
import ProfileAvartar from "@/components/profile/ProfileAvartar.vue";
import AddressPreview from "@/components/address/AddressPreview.vue";
import ContactArtisan from "@/components/artisan/ArtisanContactDialog.vue";

import { useAlert } from "@/composables/use-alert";
import { getPriceDisplay } from "@/utils/artisans";
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
    max-width: 450px;

    &__item {
        display: flex;
        align-items: center;
        column-gap: 12px;
    }
}

.profile__baked-goods, 
.profile__dietary-options {
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
    display: flex;
    flex-direction: column;

    &__preview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 14px;
    }

    &__image {
        width: 100%;
        height: 250px;
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