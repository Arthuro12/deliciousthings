<template>
    <div class="artisan-overview">
        <div class="biography-section">
            <h4 class="option-header"><ScrollIcon color="#e680a5" :size="32" />Biographie</h4>

            <div class="biography-card card">
                <header class="card-header">
                    <ProfileAvatar 
                        :src="artisan.profile_photo?.url ?? ''"
                        :name="artisan.name || artisan.company_name"
                        alt="Profilbild"
                        miniature
                    />
                    <div>
                        <div class="biography-header-text">{{ artisan.name }}</div>
                        <div>veröffentlicht am {{ artisan.created_at }}</div>
                    </div>
                </header>

                <div class="biography-content">
                    <div>
                        <div>
                            <p 
                                :class="{ 'is-clamped': toggleBiography }"
                                ref="biographyText" 
                            >{{ artisan.about }}</p>
                        </div>
                        <AppButton
                            v-if="showToggleButton"
                            type="button"
                            layout="with-icon"
                            variant="tertiary"
                            @click="toggleBiography = !toggleBiography"
                        >
                            <template #leading>
                                <PlusIcon color="#e680a5" :size="20" />
                            </template>
                            <template #text>{{ !!toggleBiography ? 'mehr anzeigen' : 'weniger anzeigen' }}</template>
                        </AppButton>
                    </div>
                </div>
            </div>
        </div>

        <div class="baked-goods">
            <h4 class="option-header"><SquareMenuIcon color="#e680a5" :size="32" />Produktbuch</h4>
            <ul class="list-none menu-card card">
                <li 
                    v-for="(group, category) in bakedGoods" :key="category"
                >
                    <div class="menu-card__group">
                        <h5 class="menu-card__group-label">{{ getCategoryDisplayName(category) }}</h5>
                        <div 
                            class="menu-card__item"
                            v-for="(good, idx) in group" 
                            :key="good.key">
                            <div>{{ good.label }}</div>
                            <div class="text--center" v-if="!(idx == group.length - 1)">***</div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div>
            <h4 class="option-header"><MapPinHouseIcon color="#e680a5" :size="32" />Standort</h4>
            <ProfileAddress :address="artisan.first_address" />
        </div>
        <div>
            <h4 class="option-header">
                <ReceiptEuroIcon color="#e680a5" :size="32" />Durschnittlicher Einkaufpreis
            </h4>
            <div class="option--flex">
                <EuroIcon color="#e680a5" :size="24" />
                <p>{{ `${getPriceDisplay(artisan.average_rate)}` }}</p>
            </div>
        </div>
        <div v-show="showPickupMethods">
            <h4 class="option-header">Abholart</h4>
            <div class="option-method option--flex" v-if="artisan.offers_delivery">
                <MotorbikeIcon color="#e680a5" :size="24" />
                <p>Lieferung angeboten</p>
            </div>
            <div class="option-method option--flex" v-if="artisan.pick_up_on_site">
                <StoreIcon color="#e680a5" :size="24" />
                <p>Abholung vor Ort</p>
            </div>
        </div>

        <ArtisanContactDialog class="contact-artisan-dialog" :artisan />
    </div>
</template>

<script setup lang="ts">
import { ref, useTemplateRef, onMounted, computed, } from "vue";

import { 
    PlusIcon, 
    ScrollIcon, 
    SquareMenuIcon, 
    MapPinHouseIcon, 
    StoreIcon, 
    MotorbikeIcon,
    ReceiptEuroIcon,
    EuroIcon,
} from "lucide-vue-next";

import AppButton from "../presentation/AppButton.vue";
import ProfileAvatar from "../profile/ProfileAvatar.vue";
import ProfileAddress from "../profile/ProfileAddress.vue";
import ArtisanContactDialog from "./ArtisanContactDialog.vue";

import { bakedGoodsByCategory, getCategoryDisplayName } from "@/utils/baked-good";
import { getPriceDisplay, getPriceLevelSymbol } from "@/utils/artisans";
import type { ArtisanPublicProfile } from "@/types/users";

const { artisan, } = defineProps<{
    artisan: ArtisanPublicProfile;
}>();

const biographyText = useTemplateRef("biographyText");

const showToggleButton = ref(false);
const toggleBiography = ref(true);

const bakedGoods = bakedGoodsByCategory(artisan.baked_goods);

const showPickupMethods = computed(() => artisan.pick_up_on_site || artisan.offers_delivery);

function contentOverflows(root: HTMLElement): boolean {
    const isOverflowed = root.clientHeight < root.scrollHeight;
    return isOverflowed;
}

onMounted(() => {
    if (biographyText.value) {
        showToggleButton.value = contentOverflows(biographyText.value);
    }
});
</script>


<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.biography-section {
    .biography-card {
        padding: 16px;

        .card-header {
            display: flex;
            gap: 16px;
        }

        .biography-header-text {
            font-weight: 600;
        }

        .biography-content {
            margin-top: 14px;
        }
    }
}

.menu-card {
    display: block;

    * {
        font-family: 'Courier New', Courier, monospace;
    }

    &__group {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    &__group-label {
        font-weight: 700;
        margin: 14px 0;
    }
}

.option-method {
    margin-bottom: 14px;
}

.contact-artisan-dialog {
    display: flex;
    justify-content: center;
    margin: 16px 0;

    @include breakpoints.respond-to('medium') {
        :deep(> .button--primary) {
            flex-basis: 40%;
        }
    }
}

.is-clamped {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 4;
    overflow: hidden;
}
</style>