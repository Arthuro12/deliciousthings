<template>
    <div class="profile-form">
        <h1>Profil erstellen</h1>
        <div class="wrapper">
            <div class="row">
                <header>Persönliche Daten</header>
                <TextField 
                    id="name" 
                    type="text" 
                    label="Name"
                    v-model:model="profile.name"
                ></TextField>
                <TextField 
                    id="company-name" 
                    type="text" 
                    label="Firmenname (optional)"
                    v-model:model="profile.companyName"
                ></TextField>
                <TextZone id="biography" rows="10" label="Bio" v-model:model="profile.biography" />
            </div>
            <div class="row">
                <header>Kontaktdaten</header>
                <TextField 
                    type="text" 
                    id="phone" 
                    label="Telefonnummer (optional)"
                    v-model:model="profile.phone"
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
            <select id="specialities">
                <option>Torten</option>
                <option>Kuchen</option>
                <option>Gebäck</option>
                <option>Praline</option>
                <option>Brot</option>
                <option>Brötchen</option>
                <option>Eis</option>
                <option>Schokoladen</option>
            </select>
        </div>
        <AppDivider variant="horizontal" />
        <div class="wrapper">
            <div class="row">
                <header>Adressdaten (Optional)</header>
                <TextField 
                    type="text" 
                    id="street" 
                    label="Straße"
                ></TextField>
                <TextField 
                    type="text" 
                    id="house-number" 
                    label="Hausnummer"
                ></TextField>
                <TextField 
                    type="text" 
                    id="postal-code" 
                    label="PLZ"
                ></TextField>
                <TextField 
                    type="text" 
                    id="city" 
                    label="Ort"
                ></TextField>
                <!-- Défaut à Berlin et pas éditable -->
                <TextField 
                    type="text" 
                    id="country" 
                    label="Land"
                ></TextField>
            </div>
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
                    ></TextField>
                </div>
                <div>
                    <span>Webseite-Url: </span>
                    <TextField 
                        type="text" 
                        id="website" 
                    ></TextField>
                </div>
            </div>
        </div>
        <AppDivider variant="horizontal" />
        <div class="wrapper">
            <header>Zusätzliche Informationen</header>
            <div><input type="checkbox" /> Ich kann liefern</div>
            <TextField 
                type="text" 
                id="average-rate" 
                label="Durchschnittspreis (in Euro)"
            ></TextField>
        </div>
        <div>
            <button class="button button--primary" type="button">Mein Profil erstellen</button>
            <p class="info-text">Ihr Profil ist sofort nach der Erstellung sichtbar.</p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppDivider from "../presentation/AppDivider.vue";
import TextZone from "../presentation/TextZone.vue";
import TextField from "../presentation/TextField.vue";

import { defaultProfile } from "@/utils/artisans";
import type { ArtisanProfile } from "@/types";

const profile = useForm<ArtisanProfile>(defaultProfile());
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