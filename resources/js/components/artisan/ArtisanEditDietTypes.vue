<template>
    <div class="form__group">
        <slot name="header"></slot>
        <RekaSelect 
            placeholder="Diäten auswählen" 
            :items="options"
            label-prop="label"
            value-prop="key"
            multiple
            v-model:selected-value="form.diet_types"
        />
        <AppButton
            class="align-end"
            type="button"
            layout="text"
            variant="primary"
            @click="updateDietTypes"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";
import RekaSelect from "@/third-party/reka-ui/RekaSelect.vue";

import type { DietType } from "@/types/users";

const props = defineProps<{
    options: DietType[];
    types?: DietType[];
}>();

const form = useForm({ diet_types: [...props.types ?? []] });

function updateDietTypes(): void {
    form.put("/artisan/profile/diet-types");
}
</script>