<template>
    <SelectRoot :multiple v-model="selectedValue">
        <SelectTrigger>
            <SelectValue :placeholder="placeholder" />
        </SelectTrigger>
        <SelectPortal>
            <SelectContent>
                <SelectViewport>
                    <SelectItem 
                        v-for="item in items" 
                        :value="getItemValue(item)" 
                        :key="item.label"
                        
                    >
                        <SelectItemText>
                            {{ getItemLabel(item) }}
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
    // SelectGroup,
    SelectItem,
    SelectItemText,
    // SelectItemIndicator,
    SelectPortal,
    SelectRoot,
    SelectTrigger,
    SelectViewport,
} from "reka-ui";

import type { 
    SelectProps, 
    SelectItem as SelectItemType,
    SelectValue as SelectValueType,
} from "@/types/ui";

const props = defineProps<SelectProps>();

const selectedValue = defineModel<SelectValueType>("selectedValue", {
    default: undefined
});

/**
 * Gets the item label.
 */
function getItemLabel(item: SelectItemType): string | null {
    if (props.labelProp) {
        return item[props.labelProp] ?? null;
    }
    return null;
}

/**
 * Gets the item value.
 */
function getItemValue(item: SelectItemType): string | null {
    if (props.valueProp) {
        return item[props.valueProp] ?? null;
    }
    return null;
}
</script>