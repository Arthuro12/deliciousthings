<template>
    <div class="form__group">
        <slot name="header"></slot>
        <div>
            <TextField 
                id="website"
                type="text"  
                label="Webseite-Url (optional)"
                v-model="form.website_url"
            />
        </div>
        <div>
            <TextField 
                label="Instagram-Profil-Url (optional)"
                id="instagram"
                type="text"  
                v-model="form.instagram_url"
            />
        </div>
        <AppButton
            class="align-end"
            type="button"
            variant="primary"
            size="medium"
            @click="updateNetwork"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";
import TextField from "../presentation/TextField.vue";

const props = defineProps<{
    websiteUrl?: string;
    instagramUrl?: string;
}>();

const form = useForm({
    website_url: props.websiteUrl,
    instagram_url: props.instagramUrl,
});

function updateNetwork(): void {
    form.patch("/artisan/profile/network");
}
</script>