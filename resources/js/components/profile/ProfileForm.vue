<template>
    <div>
        <h1>Profil erstellen</h1>
        <div>
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
            <div>
                <label>Biographie</label>
                <textarea v-model="profile.biography"></textarea>
            </div>
        </div>
        <div>
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
        <div>
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
        <div>
            <h4>Adressdaten (Optional)</h4>
            <div>
                <TextField 
                    type="text" 
                    id="street" 
                    label="Straße"
                ></TextField>
            </div>
            <div>
                <TextField 
                    type="text" 
                    id="house-number" 
                    label="Hausnummer"
                ></TextField>
            </div>
            <div>
                <TextField 
                    type="text" 
                    id="postal-code" 
                    label="PLZ"
                ></TextField>
            </div>
            <div>
                <TextField 
                    type="text" 
                    id="city" 
                    label="Ort"
                ></TextField>
            </div>
            <div>
                <!-- Défaut à Berlin et pas éditable -->
                <TextField 
                    type="text" 
                    id="country" 
                    label="Land"
                ></TextField>
            </div>
        </div>
        <div>
            <label>Fotos für Ihre Bildergalerie</label>
            <input type="file" />
            <div>Bildervorschau</div>
        </div>
        <div>
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
        <div>
            <header>Zusätzliche Informationen</header>
            <div><input type="checkbox" /> Ich kann liefern</div>
            <TextField 
                type="text" 
                id="average-rate" 
                label="Durchschnittspreis (in Euro)"
            ></TextField>
        </div>
        <button class="button button--primary" type="button">Mein Profil erstellen</button>
        <p>Ihr Profil ist sofort nach der Erstellung sichtbar.</p>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import TextField from "../presentation/TextField.vue";

import { defaultProfile } from "@/utils/artisans";
import type { ArtisanProfile } from "@/types";

const profile = useForm<ArtisanProfile>(defaultProfile());
</script>