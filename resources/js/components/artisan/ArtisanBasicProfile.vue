<template>
    <div>
        <BasicProfileForm v-model:profile="artisan" />
        <AppButton
            type="button"
            layout="text"
            variant="primary"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import BasicProfileForm from "../profile/BasicProfileForm.vue"; 

import type { ArtisanPublicProfile } from "@/types/users";
import AppButton from "../presentation/AppButton.vue";

const props = defineProps<{
    artisan: ArtisanPublicProfile;
}>();

const artisan = ref(props.artisan);
</script>