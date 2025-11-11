<template>
    <div class="profile-form">
        <h1>Profil erstellen</h1>
        <div class="wrapper">
            <div class="row">
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
            <div class="row">
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
        <div class="wrapper">
            <header>Spezialitäten</header>
            <select 
                id="specialities"
                multiple
                v-model=profile.specialities
            >
                <option v-for="speciality in specialities" :key="speciality.key">
                    {{ speciality.label }}
                </option>
            </select>
        </div>
        <AppDivider variant="horizontal" />
        <div class="wrapper">
            <AddressForm v-model:address="profile.address" />
        </div>
        <AppDivider variant="horizontal" />
        <div class="wrapper">
            <header>Fotos für Ihre Bildergalerie</header>
            <input type="file" />
            <div>Bildervorschau</div>
        </div>
        <AppDivider variant="horizontal" />
        <div class="wrapper">
            <div class="row">
                <header>Netzwerk</header>
                <div>
                    <!-- TODO: validate and sanitize urls -->
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
        <div class="wrapper">
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
        <div>
            <button 
                class="button button--primary" 
                type="button"
                @click="emit('submit', profile)"
            >
                Mein Profil erstellen
            </button>
            <p class="info-text">Ihr Profil ist sofort nach der Erstellung sichtbar.</p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";

import AppDivider from "../presentation/AppDivider.vue";
import AppTextArea from "../presentation/AppTextArea.vue";
import TextField from "../presentation/TextField.vue";
import AddressForm from "../addresses/AddressForm.vue";

import { fetchAll } from "@/api";
import { defaultProfile } from "@/utils/artisans";
import type { ArtisanProfile, Speciality } from "@/types";

const emit = defineEmits<{
    (e: 'submit', value: ArtisanProfile): void,
}>();

const profile = ref<ArtisanProfile>(defaultProfile());

const specialities = ref<Speciality[]>([]);

async function fecthSpecialities(): Promise<void> {
    const { data } = await fetchAll<Speciality[]>("/api/specialities");
    specialities.value = data;
}

fecthSpecialities();

// watch(
//     () => profile, 
//     () => {
//         console.log(profile.value.specialities)
//     }, { deep: true }
// );
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

.wrapper {
    row-gap: 20px;
}

.row {
    row-gap: 16px;
}
</style>