<template>
    <div>
        <header>Allgemeine Informationen</header>
        <TextField 
            id="profile-name" 
            type="text" 
            label="Profilname"
            v-model="profile.name"
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
</template>

<script setup lang="ts">
import TextField from "../presentation/TextField.vue";
import AppTextArea from "../presentation/AppTextArea.vue";

import type { BasisProfile } from "@/types/users";

const profile = defineModel<BasisProfile>("profile", { required: true });
</script>