<template>
    <div class="form__group">
        <slot name="header"></slot>
        <RekaSelect 
            placeholder="Diäten auswählen" 
            :items="options"
            label-prop="label"
            value-prop="key"
            multiple
            v-model:selected-value="selectedTypes"
        />
        <slot name="action" :data="selectedTypes"></slot>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import RekaSelect from "@/third-party/reka-ui/RekaSelect.vue";

import type { DietType } from "@/types/users";

const props = defineProps<{
    options: DietType[];
    types?: DietType[];
}>();

const selectedTypes = ref(props.types ?? []);
</script>