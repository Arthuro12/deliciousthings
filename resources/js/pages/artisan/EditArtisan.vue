<template>
    <AppLayout>
        <Head>
            <title>Profil bearbeiten</title>
        </Head>
        <main class="edit-artisan-page">
            <div class="card-layout content">
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Allgemeine Informationen</p><PenIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanBasicProfile :profile="basicProfile">
                            <template #action="{ data }">
                                <AppButton
                                    class="submit-button"
                                    type="button"
                                    layout="text"
                                    variant="primary"
                                    @click="updateBasicProfil(data)"
                                >
                                    <template #text>Speichern</template>
                                </AppButton>
                            </template>
                        </ArtisanBasicProfile>
                    </template>
                </RekaCollapsible>
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Kontaktdaten</p><PenIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanEditContacts :phone="contact.phone" :email="contact.email">
                            <template #action="{ data }">
                                <AppButton
                                    class="submit-button"
                                    type="button"
                                    layout="text"
                                    variant="primary"
                                >
                                    <template #text>Speichern</template>
                                </AppButton>
                            </template>
                        </ArtisanEditContacts>
                    </template>
                </RekaCollapsible>
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Spezialitäten</p><PenIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanEditSpecialities 
                            :options="specialityStore.specialities" 
                            :specialities="artisan.specialities"
                        >
                            <template #action="{ data }">
                                <AppButton
                                    class="submit-button"
                                    type="button"
                                    layout="text"
                                    variant="primary"
                                    @click="console.log(data)"
                                >
                                    <template #text>Speichern</template>
                                </AppButton>
                            </template>
                        </ArtisanEditSpecialities>
                    </template>
                </RekaCollapsible>
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Angebotene Ernährungsformen</p><PenIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanEditDietTypes 
                            :options="dietTypeStore.dietTypes" 
                            :types="artisan.diet_types"
                        >
                            <template #action="{ data }">
                                <AppButton
                                    class="submit-button"
                                    type="button"
                                    layout="text"
                                    variant="primary"
                                    @click="console.log(data)"
                                >
                                    <template #text>Speichern</template>
                                </AppButton>
                            </template>
                        </ArtisanEditDietTypes>
                    </template>
                </RekaCollapsible>
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Adresse</p><PenIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanEditAddress 
                            :address="artisan.first_address"
                        >
                            <template #action="{ data }">
                                <AppButton
                                    class="submit-button"
                                    type="button"
                                    layout="text"
                                    variant="primary"
                                    @click="console.log(data)"
                                >
                                    <template #text>Speichern</template>
                                </AppButton>
                            </template>
                        </ArtisanEditAddress>
                    </template>
                </RekaCollapsible>
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Fotogalerie</p><PenIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanAddFotos>
                            <template #action="{ data }">
                                <AppButton
                                    class="submit-button"
                                    type="button"
                                    layout="text"
                                    variant="primary"
                                    @click="console.log(data)"
                                >
                                    <template #text>Speichern</template>
                                </AppButton>
                            </template>
                        </ArtisanAddFotos>
                    </template>
                </RekaCollapsible> 
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Leistungen</p><PenIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanEditServices 
                            :offers-delivery="services.offersDelivery"
                            :pick-up-on-site="services.pickUpOnSite"
                            :average-rate="services.averageRate"
                        >
                            <template #action="{ data }">
                                <AppButton
                                    class="submit-button"
                                    type="button"
                                    layout="text"
                                    variant="primary"
                                    @click="console.log(data)"
                                >
                                    <template #text>Speichern</template>
                                </AppButton>
                            </template>
                        </ArtisanEditServices>
                    </template>
                </RekaCollapsible>  
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Netzwerk</p><PenIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanEditSocialLinks
                            :website-url="socialLinks.instagramUrl"
                            :instagram-url="socialLinks.instagramUrl"
                        >
                            <template #action="{ data }">
                                <AppButton
                                    class="submit-button"
                                    type="button"
                                    layout="text"
                                    variant="primary"
                                    @click="console.log(data)"
                                >
                                    <template #text>Speichern</template>
                                </AppButton>
                            </template>
                        </ArtisanEditSocialLinks>
                    </template>
                </RekaCollapsible>     
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";

import { Head } from "@inertiajs/vue3";
import { PenIcon } from "lucide-vue-next";

import AppLayout from "@/layout/AppLayout.vue";
import AppButton from "@/components/presentation/AppButton.vue";
import RekaCollapsible from "@/third-party/reka-ui/RekaCollapsible.vue";
import ArtisanBasicProfile from "@/components/artisan/ArtisanBasicProfile.vue";
import ArtisanEditContacts from "@/components/artisan/ArtisanEditContacts.vue";
import ArtisanEditSpecialities from "@/components/artisan/ArtisanEditSpecialities.vue";
import ArtisanEditDietTypes from "@/components/artisan/ArtisanEditDietTypes.vue";
import ArtisanEditAddress from "@/components/artisan/ArtisanEditAddress.vue";
import ArtisanAddFotos from "@/components/artisan/ArtisanAddFotos.vue";
import ArtisanEditSocialLinks from "@/components/artisan/ArtisanEditSocialLinks.vue";
import ArtisanEditServices from "@/components/artisan/ArtisanEditServices.vue";

import { useSpecialityStore } from "@/stores/speciality";
import { useDietTypeStore } from "@/stores/diet-type";
import { defaultArtisanBasicProfile } from "@/utils/artisans";
import type { 
    BasicProfile, 
    ArtisanPublicProfile, 
    Image, 
} from "@/types/users";

const { artisan, gallery } = defineProps<{
    artisan: ArtisanPublicProfile;
    gallery: Image[];
}>();

const specialityStore = useSpecialityStore();
const dietTypeStore = useDietTypeStore();

const basicProfile = ref(defaultArtisanBasicProfile(artisan));
const contact = ref({
    phone: artisan.e164phone || "",
    email: artisan.email,
});
const services = ref({
    offersDelivery: artisan.offers_delivery,
    pickUpOnSite: artisan.pick_up_on_site,
    averageRate: artisan.average_rate,
});
const socialLinks = ref({
    websiteUrl: artisan.website_url,
    instagramUrl: artisan.instagram_url,
});

function updateBasicProfil(data: BasicProfile): void {
}

onMounted(() => {
    specialityStore.getSpecialities();
    dietTypeStore.getDietTypes();
});
</script>

<style scoped>
.artisan-collapsible {
    border: 1px solid var(--color-neutral-10);
    border-radius: 8px;

    &:not(:last-of-type) {
        margin-bottom: 16px;
    }

    & > :deep(.artisan-collapsible__trigger) {
        display: flex;
        justify-content: space-between;
        width: 100%;
        height: 100%;
        padding: 16px;
    }

    & > :deep(.artisan-collapsible__content) {
        padding: 16px;
    }

    .submit-button {
        width: 30%;
        align-self: end;
    }
}
</style>
