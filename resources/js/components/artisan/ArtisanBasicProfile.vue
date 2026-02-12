<template>
    <div class="form__group">
        <BasicProfileForm v-model:profile="form" />
        <AppButton
            class="align-end"
            type="button"
            variant="primary"
            size="medium"
            @click="updateBasicProfile"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";
import BasicProfileForm from "../profile/BasicProfileForm.vue"; 

import type { BasicProfile } from "@/types/users";

const props = defineProps<{
    profile: BasicProfile;
}>();

const form = useForm(Object.assign({}, props.profile));

function updateBasicProfile(): void {
    form.patch("/artisan/profile/basic");
}
</script>