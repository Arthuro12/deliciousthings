<template>
    <SelectRoot :multiple v-model="selectedValue">
        <SelectTrigger class="select__dropdown-button">
            <SelectValue :placeholder="placeholder" />
            <ChevronDownIcon />
        </SelectTrigger>
        <SelectPortal>
            <SelectContent 
                class="select__content" 
                position="popper" 
                :side-offset="15"
            >
                <SelectViewport>
                    <SelectItem 
                        class="select__item"
                        v-for="item in items" 
                        :value="item" 
                        :key="getItemProp(item, labelProp)"
                    >
                        <SelectItemText>
                            {{ getItemProp(item, labelProp) }}
                        </SelectItemText>
                    </SelectItem>
                </SelectViewport>
            </SelectContent>
        </SelectPortal>
    </SelectRoot>
</template>

<script setup lang="ts">
import {
    SelectValue,
    SelectContent,
    SelectItem,
    SelectItemText,
    SelectPortal,
    SelectRoot,
    SelectTrigger,
    SelectViewport,
} from "reka-ui";

import { ChevronDownIcon } from "lucide-vue-next";

import { getItemProp } from "@/utils/select";
import type { SelectProps, SelectValue as SelectValueType } from "@/types/ui";

defineProps<SelectProps>();

const selectedValue = defineModel<SelectValueType>("selectedValue", {
    default: undefined
});
</script>
