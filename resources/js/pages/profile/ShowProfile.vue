<template>
    <AppLayout>
        <Head>
            <title>{{  artisan.company_name || artisan.username  }}</title>
        </Head>
        <main class="row show-profile-page">
            <div class="column">
                <div class="profile__intro">
                    <img class="profile__avatar" src="" alt="Profile photo" />
                    <div>
                        <p class="profile__title">{{ userName }}</p>
                        <p class="profile__subtitle" v-if="artisan.company_name">{{ artisan.company_name }}</p>
                    </div>
                </div>
                <div>
                    <h4>Über</h4>
                    <p>{{ artisan.about }}</p>
                </div>
                <div>
                    <h4>Spezialitäten</h4>
                    <div class="specialities">
                        <AppTag 
                            v-for="sepciality in artisan.specialities" 
                            :key="sepciality.key" 
                            :text="sepciality.label"
                        />
                    </div>
                </div>
                <div class="gallery">
                    <h4>Galerie</h4>
                    <div >
                        <img :src="gallery[0].url" />
                        <AppButton
                            class="transparent show-gallery-button" 
                            type="button" 
                            variant="neutral" 
                            layout="with-icon"
                        >
                            <template #leading><ImageIcon :size="22" /></template>
                            <template #text>
                                <p>{{ gallery.length }}</p>
                            </template>
                        </AppButton>
                    </div>
                </div>
                <div v-if="address">
                    <div class="card location">
                        <MapPinIcon class="icon" color="#e680a5" :size="20" />
                        <p>
                            {{ `${address.street} ${address.house_number}` }}<br />
                            {{ `${address.postal_code} ${address.city} ${address.country}` }}                    
                        </p>
                    </div>
                </div>
                <div>
                    <h4>Leistungen</h4>
                    <div>
                        <p>Durchschnittpreis: {{ artisan.average_rate }}</p>
                        <p>{{ `Ich biete ${artisan.offers_delivery ? 'Lieferung' : 'keine Lieferung'} an` }}</p>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <p class="contact"><ExternalLinkIcon color="#e680a5" :size="20" /><a class="link contact__link" :href="artisan.website_url" target="_blank">Webseite</a></p>
                    <p class="contact"><ExternalLinkIcon color="#e680a5" :size="20" /><a class="link contact__link" :href="artisan.instagram_url" target="_blank">Instragram-Seite</a></p>
                    <p class="contact"><PhoneIcon color="#e680a5" :size="20" /><span class="link contact__text">{{ artisan.e164phone }}</span></p>
                </div>
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { computed } from "vue";

import { Head } from "@inertiajs/vue3";

import { 
    ExternalLinkIcon, 
    PhoneIcon, 
    MapPinIcon,
    ImageIcon,
} from "lucide-vue-next";

import AppLayout from "@/layout/AppLayout.vue";
import AppButton from "@/components/presentation/AppButton.vue";
import AppTag from "@/components/presentation/AppTag.vue";

import type { ArtisanProfile, Auth } from "@/types/users";

export type Image = {
    url: string;
};

const { auth, artisan, gallery } = defineProps<{
    auth: Auth;
    artisan: ArtisanProfile;
    gallery: Image[];
}>();

const address = artisan.first_address;

const userName = computed(() => {
    const user = auth.user;
    return `${user.first_name} ${user.last_name}`;
});
</script>

<style scoped lang="scss">
.contact {
    display: flex;
    column-gap: 12px;
    align-items: center;
    
    span {
        color: var(--color-neutral-30);
    }

    &:not(:last-of-type) {
        margin-bottom: 12px;
    }
}

.location {
    display: flex;
    column-gap: 12px;

    .icon {
        align-self: center;
    }
}

.specialities {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.gallery {
//     display: flex;
//     flex-direction: column;
//     row-gap: 14px;

//     &__image {
//         border-radius: 10px;
//         height: 350px;
//     }

//     :deep(>.root) {
//         display: flex;
//         flex-direction: column;
//         row-gap: 12px
// ;
//         > .container + .gallery__navigation {
//             display: flex;
//         }
//     }
}

.show-gallery-button {
    position: relative;
    top: -40px;
    left: 10px;
}
</style>