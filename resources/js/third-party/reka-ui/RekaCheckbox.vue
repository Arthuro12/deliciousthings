<template>
    <div class="checkbox__wrapper">
        <CheckboxRoot 
            class="checkbox__root" 
            :as="as" 
            :id="id"
            v-model="modelValue"
        >
            <CheckboxIndicator>
                <CheckIcon color="#e680a5" :size="16"/>
            </CheckboxIndicator>
        </CheckboxRoot>
        <label class="checkbox__label" :for="id">{{ label }}</label>
    </div>
</template>

<script setup lang="ts">
import { CheckboxIndicator, CheckboxRoot } from "reka-ui";
import { CheckIcon } from "lucide-vue-next";

type CheckboxValue = "indeterminate" | boolean | null;

defineProps<{
    as?: string;
    id?: string;
    label: string;
}>();

const modelValue = defineModel<CheckboxValue>({ default: "indeterminate" });
</script>

<style scoped lang="scss">
.checkbox {
    &__wrapper {
        display: flex;
        column-gap: 12px;
        align-items: center;
        height: 36px;
    }

    &__root {
        height: 22px;
        width: 22px;
        border: 1px solid var(--color-neutral-10);
        border-radius: 5px;
        padding: 2px;
    }

    &__label {
        cursor: pointer;
    }
}
</style>