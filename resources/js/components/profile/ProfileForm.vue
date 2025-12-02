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
                    v-model:model="profile.username"
                ></TextField>
                <TextField 
                    id="company-name" 
                    type="text" 
                    label="Firmenname (optional)"
                    v-model:model="profile.company_name"
                ></TextField>
                <AppTextArea id="biography" rows="10" label="Bio" v-model:model="profile.biography" />
            </div>
            <div class="wrapper">
                <header>Kontaktdaten</header>
                <TextField 
                    type="text" 
                    id="phone" 
                    label="Telefonnummer (optional)"
                    v-model:model="profile.e164phone"
                ></TextField>
                <TextField 
                    type="text" 
                    id="email" 
                    label="E-Mail-Adresse *"
                    v-model:model="profile.email"
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
        <AppDivider variant="horizontal" />
        <div class="row">
            <AddressForm v-model:address="profile.first_address" />
        </div>
        <AppDivider variant="horizontal" />
        <div class="row">
            <header>Fotos für Ihre Bildergalerie</header>
            <UploadFiles
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
                <div>
                    <!-- Todo: validate and sanitize urls -->
                    <span>Instagram-Profil-Url: </span>
                    <TextField 
                        type="text" 
                        id="instagram" 
                        v-model:model="profile.instagram_url"
                    ></TextField>
                </div>
                <div>
                    <span>Webseite-Url: </span>
                    <TextField 
                        type="text" 
                        id="website" 
                        v-model:model="profile.website_url"
                    ></TextField>
                </div>
            </div>
        </div>
        <AppDivider variant="horizontal" />
        <div class="row">
            <header>Zusätzliche Informationen</header>
            <div class="checkbox-input-wrapper">
                <input id="offers-delivery" type="checkbox" v-model="profile.offers_delivery" /> 
                <label for="offers-delivery">Ich kann liefern</label>
            </div>
            <TextField 
                type="text" 
                id="average-rate" 
                label="Durchschnittspreis (in Euro)"
                v-model:model="profile.average_rate"
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
import UploadFiles from "../presentation/UploadFiles.vue";
import AppTextArea from "../presentation/AppTextArea.vue";
import TextField from "../presentation/TextField.vue";
import AddressForm from "../addresses/AddressForm.vue";
import RekaSelect from "@/third-party/reka-ui/RekaSelect.vue";

import { useSpecialityStore } from "@/stores/speciality";
import { defaultProfile } from "@/utils/artisans";
import type { ArtisanProfile } from "@/types/users";

const emit = defineEmits<{
    (e: 'photos-uploaded', value: File[]): void;
    (e: 'submit', value: ArtisanProfile): void;
}>();

const specialityStore = useSpecialityStore();
const profile = ref<ArtisanProfile>(defaultProfile());

const selectedFiles = ref<File[]>([]);

function updateFileSelection(files: File[]): void {
    selectedFiles.value = files;
    emit('photos-uploaded', selectedFiles.value)
}

onMounted(async () => {
    await specialityStore.getSpecialities();
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