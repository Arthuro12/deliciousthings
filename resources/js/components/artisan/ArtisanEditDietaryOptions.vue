<template>
    <div class="form__group">
        <slot name="header"></slot>
        <RekaSelect 
            placeholder="Ernährungsformen auswählen" 
            :items="options"
            label-prop="label"
            value-prop="key"
            multiple
            v-model:selected-value="form.dietary_options"
        />
        <AppButton
            class="align-end"
            type="button"
            layout="text"
            variant="primary"
            @click="syncDietaryOptions"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";
import RekaSelect from "@/third-party/reka-ui/RekaSelect.vue";

import type { DietaryOption } from "@/types/users";

const props = defineProps<{
    options: DietaryOption[];
    types?: DietaryOption[];
}>();

const form = useForm({ dietary_options: [...(props.types ?? [])] });

function syncDietaryOptions(): void {
    form.put("/artisan/profile/dietary-options");
}
</script>