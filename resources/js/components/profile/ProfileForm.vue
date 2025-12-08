<template>
    <div class="profile-form">
        <h1>Profil erstellen</h1>
        <div class="row">
            <div class="wrapper">
                <header>Persönliche Daten</header>
                <TextField 
                    id="username" 
                    type="text" 
                    label="Benutzername"
                    v-model="profile.username"
                ></TextField>
                <TextField 
                    id="company-name" 
                    type="text" 
                    label="Firmenname (optional)"
                    v-model="profile.company_name"
                ></TextField>
                <TextField 
                    id="main-occupation" 
                    type="text" 
                    label="Hauptbeschäftigung (optional)"
                    v-model="profile.main_occupation"
                ></TextField>
                <AppTextArea 
                    id="short-description" 
                    rows="7" 
                    label="kurze Beschreibung" 
                    v-model="profile.short_description" 
                />
                <AppTextArea 
                    id="about" 
                    rows="10" 
                    label="Über" 
                    v-model="profile.about" 
                />
            </div>
            <div class="wrapper">
                <header>Kontaktdaten</header>
                <TextField 
                    type="text" 
                    id="phone" 
                    label="Telefonnummer (optional)"
                    v-model="profile.e164phone"
                ></TextField>
                <TextField 
                    type="text" 
                    id="email" 
                    label="E-Mail-Adresse"
                    v-model="profile.email"
                ></TextField>
            </div>
        </div>
        <AppDivider variant="horizontal" />
        <div class="row">
            <header>Spezialitäten</header>
            <RekaSelect 
                placeholder="Spezialitäten auswählen" 
                :items="specialityStore.specialities"
                label-prop="label"
                value-prop="key"
                multiple
                v-model:selected-value="profile.specialities"
            />
        </div>
        <div class="row">
            <header>angebotene Diäten</header>
            <RekaSelect 
                placeholder="Diäten auswählen" 
                :items="dietTypeStore.dietTypes"
                label-prop="label"
                value-prop="key"
                multiple
                v-model:selected-value="profile.diet_types"
            />
        </div>
        <AppDivider variant="horizontal" />
        <div class="row">
            <AddressForm v-model:address="profile.first_address" />
        </div>
        <AppDivider variant="horizontal" />
        <div class="row">
            <header>Fotos für Ihre Bildergalerie</header>
            <FileUpload
                id="gallery"
                accept=".jpg, .jpeg, .png"
                multiple
                :model-value="selectedFiles"
                @update:model-value="updateFileSelection"
            />
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
                        v-model="profile.website_url"
                    ></TextField>
                </div>
                <div>
                    <span>Instagram-Profil-Url (optional)</span>
                    <TextField 
                        type="text" 
                        id="instagram" 
                        v-model="profile.instagram_url"
                    ></TextField>
                </div>
            </div>
        </div>
        <AppDivider variant="horizontal" />
        <div class="row">
            <header>Zusätzliche Informationen</header>
            <RekaCheckbox 
                id="offers-delivery" 
                label="Ich bitte Lieferung an" 
                v-model="profile.offers_delivery"
            />
            <RekaCheckbox 
                id="pick-up-on-site" 
                label="Abholung vor Ort" 
                v-model="profile.pick_up_on_site"
            />
            <TextField 
                type="text" 
                id="average-rate" 
                label="Durchschnittspreis (in Euro)"
                v-model="profile.average_rate"
            ></TextField>
        </div>
        <div class="row">
            <AppButton 
                class="submit-button"
                type="button" 
                layout="text"
                variant="primary"
                @click="emit('submit', profile)"
            >
                <template #text>Mein Profil erstellen</template>
            </AppButton>
            <p class="info-text">Ihr Profil ist sofort nach der Erstellung sichtbar.</p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";

import AppDivider from "../presentation/AppDivider.vue";
import AppButton from "../presentation/AppButton.vue";
import FileUpload from "../presentation/FileUpload.vue";
import AppTextArea from "../presentation/AppTextArea.vue";
import TextField from "../presentation/TextField.vue";
import AddressForm from "../addresses/AddressForm.vue";
import RekaSelect from "@/third-party/reka-ui/RekaSelect.vue";
import RekaCheckbox from "@/third-party/reka-ui/RekaCheckbox.vue";

import { useDietTypeStore } from "@/stores/diet-type";
import { useSpecialityStore } from "@/stores/speciality";
import { defaultProfile } from "@/utils/artisans";
import type { FileValue } from "@/types/ui";
import type { ArtisanProfile } from "@/types/users";

const emit = defineEmits<{
    (e: 'photos-uploaded', value: FileValue): void;
    (e: 'submit', value: ArtisanProfile): void;
}>();

const specialityStore = useSpecialityStore();
const dietTypeStore = useDietTypeStore();
const profile = ref<ArtisanProfile>(defaultProfile());

const selectedFiles = ref<FileValue>([]);

function updateFileSelection(files: FileValue): void {
    selectedFiles.value = files;
    emit('photos-uploaded', selectedFiles.value)
}

onMounted(async () => {
    await specialityStore.getSpecialities();
    await dietTypeStore.getDietTypes();
});
</script>

<style scoped>
.profile-form {
    display: flex;
    flex-direction: column;
    row-gap: 40px;
}

.wrapper, .row {
    display: flex;
    flex-direction: column;
}

.row {
    row-gap: 20px;
}

.wrapper {
    row-gap: 16px;
}
</style>