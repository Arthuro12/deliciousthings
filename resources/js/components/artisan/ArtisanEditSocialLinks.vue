<template>
    <div class="form__group">
        <slot name="header"></slot>
        <!-- Todo: validate and sanitize urls -->
        <div>
            <span>Webseite-Url (optional)</span>
            <TextField 
                type="text" 
                id="website" 
                v-model="websiteUrl"
            ></TextField>
        </div>
        <div>
            <span>Instagram-Profil-Url (optional)</span>
            <TextField 
                type="text" 
                id="instagram" 
                v-model="instagramUrl"
            ></TextField>
        </div>
        <slot 
            name="action"
            :data="{ websiteUrl, instagramUrl, }"
        ></slot>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import TextField from "../presentation/TextField.vue";

const props = defineProps<{
    websiteUrl?: string;
    instagramUrl?: string;
}>();

const websiteUrl = ref(props.websiteUrl ?? "");
const instagramUrl = ref(props.websiteUrl ?? "");
</script>