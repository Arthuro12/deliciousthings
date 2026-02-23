<template>
    <RekaCheckboxGroup 
        :checkboxes 
        v-model="value"
    />
</template>

<script setup lang="ts">
import RekaCheckboxGroup from "@/third-party/reka-ui/RekaCheckboxGroup.vue";

import type { Checkbox } from "@/types/ui";

const checkboxes: Checkbox[] = [
    { 
        id: "inexpensive",
        label: "niedrig (€)",
        name: "inexpensive",
        value: "inexpensive"
    },
    { 
        id: "moderate",
        label: "mittel (€€)",
        name: "moderate",
        value: "moderate", 
    },
    { 
        id: "higher-end",
        label: "hoch (€€€)",
        name: "higher-end",
        value: "higher-end",
    }
];

const value = defineModel<string[]>({ default: [] });
</script>