<template>
    <div class="artisan-form">
        <h1>Profil erstellen</h1>
        <div class="row">
            <BasicProfileForm v-model:profile="basicProfile">
                <template #header><header class="form__group__header">Allgemeine Informationen</header></template>
            </BasicProfileForm>
        </div>
        <AppDivider variant="horizontal" />
        <div class="row">
            <div>
                <header class="form__group__header">Angebot</header>
            </div>
            <div class="wrapper">
                <div class="select-input-wrapper">
                    <RekaSelectGroup 
                        label="Backwaren"
                        placeholder="Backwaren auswählen" 
                        show-item-indicator
                        :groups="bakedGoodsGroups"
                        label-prop="label"
                        value-prop="key"
                        multiple
                        :select-value-option="{ as: 'p' }"
                        v-model:selected-value="artisan.baked_goods"
                    >
                        <template #itemLabel="{ text }">
                            <p>{{ text }}</p>
                        </template>
                    </RekaSelectGroup>
                </div>

                <div class="select-input-wrapper">
                    <RekaSelect 
                        label="Ernährungsformen (optional)"
                        placeholder="Ernährungsformen auswählen" 
                        show-item-indicator
                        :items="dietaryOptionStore.dietaryOptions"
                        label-prop="label"
                        value-prop="key"
                        multiple
                        :select-value-option="{ as: 'p' }"
                        v-model:selected-value="artisan.dietary_options"
                    >
                        <template #itemLabel="{ text }">
                            <p>{{ text }}</p>
                        </template>
                    </RekaSelect>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="wrapper">
                <header class="form__group__header">Angebotene Ernährungsformen</header>
                <RekaSelect 
                    placeholder="Ernährungsformen auswählen" 
                    show-item-indicator
                    :items="dietaryOptionStore.dietaryOptions"
                    label-prop="label"
                    value-prop="key"
                    multiple
                    :select-value-option="{ as: 'p' }"
                    v-model:selected-value="artisan.dietary_options"
                >
                    <template #itemLabel="{ text }">
                        <p>{{ text }}</p>
                    </template>
                </RekaSelect>
            </div>
        </div> -->
        <AppDivider variant="horizontal" />
        <AddressCollapsible class="row" v-slot="{ show }">
            <AddressForm v-show="show" v-model:address="artisan.first_address" />
        </AddressCollapsible>
        <AppDivider variant="horizontal" />
        <div class="row">
            <div class="wrapper">
                 <header class="form__group__header">Fotos für Ihre Bildergalerie</header>
                <FileUpload
                    id="gallery"
                    accept=".jpg, .jpeg, .png"
                    multiple
                    :model-value="selectedFiles"
                    @update:model-value="updateFileSelection"
                />
            </div>
        </div>
        <AppDivider variant="horizontal" />
        <div class="row">
            <div class="wrapper">
                <header class="form__group__header">Netzwerk</header>
                <!-- Todo: validate and sanitize urls -->
                <div>
                    <TextField 
                        id="website" 
                        type="text" 
                        label="Webseite-Url (optional)"
                        v-model="artisan.website_url"
                    ></TextField>
                </div>
                <div>
                    <TextField 
                        id="instagram"
                        type="text" 
                        label="Instagram-Profil-Url (optional)" 
                        v-model="artisan.instagram_url"
                    ></TextField>
                </div>
            </div>
        </div>
        <AppDivider variant="horizontal" />
        <div class="row">
            <div class="wrapper">
                <header class="form__group__header">Abholart und Enkaufspreis</header>
                <RekaCheckbox 
                    id="offers-delivery" 
                    label="Ich bitte Lieferung an" 
                    v-model="artisan.offers_delivery"
                />
                <RekaCheckbox 
                    id="pick-up-on-site" 
                    label="Abholung vor Ort" 
                    v-model="artisan.pick_up_on_site"
                />
                <TextField 
                    type="text" 
                    id="average-rate" 
                    label="Durschnittlicher Einkaufspreis (€)"
                    v-model="artisan.average_rate"
                ></TextField>
            </div>
        </div>
        <div class="row">
            <AppButton 
                class="submit-button"
                type="button" 
                variant="primary"
                size="medium"
                @click="emit('submit', artisan)"
            >
                <template #text>Mein Profil erstellen</template>
            </AppButton>
            <p class="info-text">Ihr Profil ist sofort nach der Erstellung sichtbar.</p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed, ref, watch, onMounted } from "vue";

import AppDivider from "../presentation/AppDivider.vue";
import AppButton from "../presentation/AppButton.vue";
import FileUpload from "../presentation/FileUpload.vue";
import TextField from "../presentation/TextField.vue";
import BasicProfileForm from "../profile/BasicProfileForm.vue";
import AddressCollapsible from "../address/AddressFormCollapsible.vue";
import AddressForm from "../address/AddressForm.vue";
import RekaSelect from "@/third-party/reka-ui/RekaSelect.vue";
import RekaSelectGroup from "@/third-party/reka-ui/RekaSelectGroup.vue";
import RekaCheckbox from "@/third-party/reka-ui/RekaCheckbox.vue";

import { useBakedGoodStore } from "@/stores/baked-good";
import { useDietaryOptionStore } from "@/stores/dietary-option";
import { defaultArtisan, getBasicProfile } from "@/utils/artisans";
import { BAKED_GOODS, } from "@/constants";
import { groupByCategories, mapGroupsToDisplayName, } from "@/utils/options";
import type { FileValue } from "@/types/ui";
import type { ArtisanProfile, GroupedBakedGoods } from "@/types/users";

const emit = defineEmits<{
    (e: "photos-updated", value: FileValue): void;
    (e: "submit", value: ArtisanProfile): void;
}>();

const bakedGoodStore = useBakedGoodStore();
const dietaryOptionStore = useDietaryOptionStore();
const artisan = ref<ArtisanProfile>(defaultArtisan());
const basicProfile = ref(getBasicProfile(artisan.value));
const selectedFiles = ref<FileValue>([]);

const bakedGoodsGroups = computed<GroupedBakedGoods>(() => {
    let groups = groupByCategories(bakedGoodStore.bakedGoods);
    groups = mapGroupsToDisplayName(groups, BAKED_GOODS.CATEGORY);

    return groups as GroupedBakedGoods;
});

function updateFileSelection(files: FileValue): void {
    selectedFiles.value = files;
    emit("photos-updated", selectedFiles.value)
}

watch(
    basicProfile, 
    () => {
        artisan.value.name = basicProfile.value.name;
        artisan.value.company_name = basicProfile.value.company_name;
        artisan.value.main_occupation = basicProfile.value.main_occupation;
        artisan.value.short_description = basicProfile.value.short_description;
        artisan.value.about = basicProfile.value.about;
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

.artisan-form {
    display: flex;
    flex-direction: column;
    row-gap: 40px;

    .wrapper, .row {
        display: flex;
        flex-direction: column;
    }

    .wrapper {
        row-gap: 16px;

        > .select-input-wrapper {
            width: 100%;

            :deep(.select__dropdown-button) {
                width: 100%;
            }
        }
    }

    .row {
        row-gap: 20px;
    }

    .row > .submit-button {
        width: 100%;

        @include breakpoints.respond-to('medium') {
            width: 30%;
        }

        @include breakpoints.respond-to('large') {
            width: 50%;
        }
    }
}
</style>
