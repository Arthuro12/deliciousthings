<template>
    <div class="artisan-form">
        <h1>Profil erstellen</h1>
        <div class="row">
            <BasicProfileForm v-model:profile="basicProfile">
                <template #header><header>Allgemeine Informationen</header></template>
            </BasicProfileForm>
        </div>
        <AppDivider variant="horizontal" />
        <div class="row">
            <div class="wrapper">
                <header>Spezialitäten</header>
                <RekaSelect 
                    placeholder="Spezialitäten auswählen" 
                    :items="specialityStore.specialities"
                    label-prop="label"
                    value-prop="key"
                    multiple
                    v-model:selected-value="artisan.specialities"
                />
            </div>
        </div>
        <div class="row">
            <div class="wrapper">
                <header>Angebotene Ernährungsformen</header>
                <RekaSelect 
                    placeholder="Diäten auswählen" 
                    :items="dietTypeStore.dietTypes"
                    label-prop="label"
                    value-prop="key"
                    multiple
                    v-model:selected-value="artisan.diet_types"
                />
            </div>
        </div>
        <AppDivider variant="horizontal" />
        <AddressCollapsible class="row" v-slot="{ show }">
            <AddressForm v-show="show" v-model:address="artisan.first_address" />
        </AddressCollapsible>
        <AppDivider variant="horizontal" />
        <div class="row">
            <div class="wrapper">
                 <header>Fotos für Ihre Bildergalerie</header>
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
                <header>Netzwerk</header>
                <!-- Todo: validate and sanitize urls -->
                <div>
                    <span>Webseite-Url (optional)</span>
                    <TextField 
                        type="text" 
                        id="website" 
                        v-model="artisan.website_url"
                    ></TextField>
                </div>
                <div>
                    <span>Instagram-Profil-Url (optional)</span>
                    <TextField 
                        type="text" 
                        id="instagram" 
                        v-model="artisan.instagram_url"
                    ></TextField>
                </div>
            </div>
        </div>
        <AppDivider variant="horizontal" />
        <div class="row">
            <div class="wrapper">
                <header>Leistungen</header>
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
                    label="Durchschnittspreis (in Euro)"
                    v-model="artisan.average_rate"
                ></TextField>
            </div>
        </div>
        <div class="row">
            <AppButton 
                class="submit-button"
                type="button" 
                layout="text"
                variant="primary"
                @click="emit('submit', artisan)"
            >
                <template #text>Mein Profil erstellen</template>
            </AppButton>
            <p class="info-text">Ihr Profil ist sofort nach der Erstellung sichtbar.</p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, watch, onMounted } from "vue";

import AppDivider from "../presentation/AppDivider.vue";
import AppButton from "../presentation/AppButton.vue";
import FileUpload from "../presentation/FileUpload.vue";
import TextField from "../presentation/TextField.vue";
import BasicProfileForm from "../profile/BasicProfileForm.vue";
import AddressCollapsible from "../addresses/AddressFormCollapsible.vue";
import AddressForm from "../addresses/AddressForm.vue";
import RekaSelect from "@/third-party/reka-ui/RekaSelect.vue";
import RekaCheckbox from "@/third-party/reka-ui/RekaCheckbox.vue";

import { useDietTypeStore } from "@/stores/diet-type";
import { useSpecialityStore } from "@/stores/speciality";
import { defaultArtisan, getBasicProfile } from "@/utils/artisans";
import type { FileValue } from "@/types/ui";
import type { ArtisanPublicProfile } from "@/types/users";

const emit = defineEmits<{
    (e: 'photos-updated', value: FileValue): void;
    (e: 'submit', value: ArtisanPublicProfile): void;
}>();

const specialityStore = useSpecialityStore();
const dietTypeStore = useDietTypeStore();
const artisan = ref<ArtisanPublicProfile>(defaultArtisan());
const basicProfile = ref(getBasicProfile(artisan.value));
const selectedFiles = ref<FileValue>([]);

function updateFileSelection(files: FileValue): void {
    selectedFiles.value = files;
    emit('photos-updated', selectedFiles.value)
}

onMounted(async () => {
    await specialityStore.getSpecialities();
    await dietTypeStore.getDietTypes();
});

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
</script>
