<template>
    <CheckboxGroupRoot v-model="modelValue">
        <template v-for="checkbox in checkboxes" :key="checkbox.id">
            <RekaCheckbox 
                :id="checkbox.id"
                :name="checkbox.name"
                :label="checkbox.label"
                :value="checkbox.value"
            />
        </template>
    </CheckboxGroupRoot>
</template>

<script setup lang="ts">
import { CheckboxGroupRoot, type AcceptableValue } from "reka-ui";

import RekaCheckbox from "./RekaCheckbox.vue";

import type { Checkbox } from "@/types/ui";

const { checkboxes, } = defineProps<{
    checkboxes: Checkbox[];
}>();

const modelValue = defineModel<AcceptableValue[]>();
</script>