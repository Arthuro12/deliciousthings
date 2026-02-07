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
                    <SelectGroup 
                        v-for="(items, key) in groups" 
                        :key
                    >
                        <SelectLabel class="select-group__label">{{ key }}</SelectLabel>
                        <SelectItem 
                            class="select__item"
                            v-for="item in items"
                            :value="item"
                            :key="getItemLabel(item)"
                        >
                            <SelectItemText>
                                {{ getItemLabel(item) }}
                            </SelectItemText>
                        </SelectItem>
                    </SelectGroup>
                </SelectViewport>
            </SelectContent>
        </SelectPortal>
    </SelectRoot>
</template>

<script setup lang="ts">
import {
    SelectValue,
    SelectContent,
    SelectGroup,
    SelectLabel,
    SelectItem,
    SelectItemText,
    SelectPortal,
    SelectRoot,
    SelectTrigger,
    SelectViewport,
} from "reka-ui";

import { ChevronDownIcon } from "lucide-vue-next";

import type { 
    SelectGroupProps, 
    SelectItem as SelectItemType,
    SelectValue as SelectValueType,
} from "@/types/ui";

const props = defineProps<SelectGroupProps>();

const selectedValue = defineModel<SelectValueType>("selectedValue", {
    default: undefined
});

/**
 * Gets the item label.
 */
function getItemLabel(item: SelectItemType): string {
    if (props.labelProp && typeof item == "object" && item) {
        return item[props.labelProp] ?? "";
    }
    return "";
}
</script>
