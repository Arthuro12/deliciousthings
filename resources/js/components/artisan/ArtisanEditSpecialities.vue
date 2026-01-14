<template>
    <div class="form__group">
        <slot name="header"></slot>
        <RekaSelect 
            placeholder="Spezialitäten auswählen" 
            :items="options"
            label-prop="label"
            value-prop="key"
            multiple
            v-model:selected-value="form.specialities"
        />
        <AppButton
            class="align-end"
            type="button"
            layout="text"
            variant="primary"
            @click="syncSpecialities"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";
import RekaSelect from "@/third-party/reka-ui/RekaSelect.vue";

import type { Speciality } from "@/types/users";

const props = defineProps<{
    options: Speciality[];
    specialities: Speciality[];
}>();

const form = useForm({ specialities: [...props.specialities] });

function syncSpecialities(): void {
    form.put("/artisan/profile/specialities");
}
</script>