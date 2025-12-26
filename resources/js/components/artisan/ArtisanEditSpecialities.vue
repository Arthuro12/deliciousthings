<template>
    <div class="form__group">
        <slot name="header"></slot>
        <RekaSelect 
            placeholder="Spezialitäten auswählen" 
            :items="options"
            label-prop="label"
            value-prop="key"
            multiple
            v-model:selected-value="selectedSpecialities"
        />
        <slot name="action" :data="selectedSpecialities"></slot>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import RekaSelect from "@/third-party/reka-ui/RekaSelect.vue";

import type { Speciality } from "@/types/users";

const props = defineProps<{
    options: Speciality[];
    specialities: Speciality[];
}>();

const selectedSpecialities = ref(props.specialities);
</script>