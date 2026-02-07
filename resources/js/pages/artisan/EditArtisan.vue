<template>
    <AppLayout>
        <Head>
            <title>Profil bearbeiten</title>
        </Head>
        <main class="card-layout wrapper">
            <div>
                <ArtisanProfilePhotoForm 
                    class="artisan-profile-photo-form" 
                    :profile-name="artisan.company_name || artisan.name" 
                    :profile-photo="profile_photo"
                />
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Allgemeine Informationen</p><ChevronDownIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanBasicProfile :profile="basicProfile" />
                    </template>
                </RekaCollapsible>
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Angebotene Backwaren</p><ChevronDownIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanEditBakedGoods 
                            :options="bakedGoodsGroups" 
                            :baked-goods="artisan.baked_goods"
                        />
                    </template>
                </RekaCollapsible>
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Angebotene Ernährungsformen</p><ChevronDownIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanEditDietaryOptions 
                            :options="dietaryOptionStore.dietaryOptions" 
                            :types="artisan.dietary_options"
                        />
                    </template>
                </RekaCollapsible>
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Adresse</p><ChevronDownIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanAddressSettings :address="firstAddress" />
                    </template>
                </RekaCollapsible>
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Fotogalerie</p><ChevronDownIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanAddFotos :gallery="gallery" />
                    </template>
                </RekaCollapsible> 
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Leistungen</p><ChevronDownIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanEditServices 
                            :offers-delivery="services.offersDelivery"
                            :pick-up-on-site="services.pickUpOnSite"
                            :average-rate="services.averageRate"
                        />
                    </template>
                </RekaCollapsible>  
                <RekaCollapsible 
                    class="artisan-collapsible" 
                    trigger-button-class="artisan-collapsible__trigger"
                    content-class="artisan-collapsible__content"
                >
                    <template #trigger>
                        <p>Netzwerk</p><ChevronDownIcon :size="20" />
                    </template>
                    <template #content>
                        <ArtisanEditNetworkLinks
                            :website-url="artisan.website_url"
                            :instagram-url="artisan.instagram_url"
                        />
                    </template>
                </RekaCollapsible>     
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { computed, ref,  watch, onMounted } from "vue";

import { Head } from "@inertiajs/vue3";

import { ChevronDownIcon } from "lucide-vue-next";

import AppLayout from "@/layout/AppLayout.vue";
import RekaCollapsible from "@/third-party/reka-ui/RekaCollapsible.vue";
import ArtisanProfilePhotoForm from "@/components/artisan/ArtisanProfilePhotoForm.vue";
import ArtisanBasicProfile from "@/components/artisan/ArtisanBasicProfile.vue";
import ArtisanEditBakedGoods from "@/components/artisan/ArtisanEditBakedGoods.vue";
import ArtisanEditDietaryOptions from "@/components/artisan/ArtisanEditDietaryOptions.vue";
import ArtisanAddressSettings from "@/components/artisan/ArtisanAddressSettings.vue";
import ArtisanAddFotos from "@/components/artisan/ArtisanAddFotos.vue";
import ArtisanEditNetworkLinks from "@/components/artisan/ArtisanEditNetworkLinks.vue";
import ArtisanEditServices from "@/components/artisan/ArtisanEditServices.vue";

import { useBakedGoodStore } from "@/stores/baked-good";
import { useDietaryOptionStore } from "@/stores/dietary-option";
import { getBasicProfile } from "@/utils/artisans";
import { bakedGoodsByCategory, mapGroupsToDisplayName } from "@/utils/baked-good";
import type { 
    Address,
    ArtisanPublicProfile, 
    GroupedBakedGoods,
    Image, 
} from "@/types/users";

const { 
    artisan,
    profile_photo, 
    gallery 
} = defineProps<{
    artisan: ArtisanPublicProfile;
    profile_photo?: Image;
    gallery: Image[];
}>();

const bakedGoodStore = useBakedGoodStore();
const dietaryOptionStore = useDietaryOptionStore();

const firstAddress = ref<Address | undefined>(undefined);
if (artisan.first_address) {
    firstAddress.value = { ...artisan.first_address };
}
const basicProfile = getBasicProfile(artisan);
const services = {
    offersDelivery: artisan.offers_delivery,
    pickUpOnSite: artisan.pick_up_on_site,
    averageRate: artisan.average_rate,
};

const bakedGoodsGroups = computed<GroupedBakedGoods>(() => {
    let groups = bakedGoodsByCategory(bakedGoodStore.bakedGoods);
    groups = mapGroupsToDisplayName(groups);

    return groups;
});

watch(
    () => artisan.first_address, 
    (newAddress) => {
        if (newAddress) {
            firstAddress.value = { ...newAddress };
        } else {
            firstAddress.value = undefined; // We are deliberately forcing the UI update.
        }
    }, 
    { deep: true }
);

onMounted(async () => {
    await bakedGoodStore.getBakedGoods();
    await dietaryOptionStore.getDietaryOptions();
});
</script>

<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.wrapper {
    border-radius: 0;
    width: 100%;
    margin: 0;

    @include breakpoints.respond-to('large') {
        border-radius: 16px;
        margin: 48px auto;
        width: 50%;
    }
}

.artisan-profile-photo-form {
    margin-bottom: 32px;
}

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
