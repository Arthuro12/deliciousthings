<template>
    <SelectRoot class="select__root" :multiple v-model="selectedValue">
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
                        :key="getItemLabel(item)"
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
    SelectItem,
    SelectItemText,
    SelectPortal,
    SelectRoot,
    SelectTrigger,
    SelectViewport,
} from "reka-ui";

import { ChevronDownIcon } from "lucide-vue-next";

import type { 
    SelectProps, 
    SelectItem as SelectItemType,
    SelectValue as SelectValueType,
} from "@/types/ui";
import { computed } from "vue";

const props = defineProps<SelectProps>();

const selectedValue = defineModel<SelectValueType>("selectedValue", {
    default: undefined
});

const items = computed(() => props.items ?? []);

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
