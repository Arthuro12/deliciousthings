<template>
    <RadioGroupRoot class="radio-root" v-model="modelValue">
        <label 
            class="radio-items" 
            v-for="radio in radios" 
            :key="radio.name"
        >
            <RadioGroupItem 
                class="radio__item" 
                :value="radio.value"
                :id="radio.id"
            >
                <RadioGroupIndicator 
                    class="radio__indicator"  
                />
            </RadioGroupItem>
            {{ radio.label }}
        </label>
  </RadioGroupRoot>
</template>

<script setup lang="ts">
import { AcceptableValue, RadioGroupRoot, RadioGroupItem, RadioGroupIndicator, } from "reka-ui";

import type { Radio } from "@/types/ui";

export type RadioGroupProps = {
    radios: Radio[];
};

const { radios } = defineProps<RadioGroupProps>();

const modelValue = defineModel<AcceptableValue>();
</script>

<style scoped lang="scss">
.radio-root {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.radio-items {
    display: flex;
    column-gap: 12px;
    align-items: center;
}

.radio__item {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 1px solid var(--color-neutral-20);
    background: white;
}

.radio__indicator {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    position: relative;

  &::after {
    content: "";
        display: block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: var(--color-primary-50);
    } 
}
</style>