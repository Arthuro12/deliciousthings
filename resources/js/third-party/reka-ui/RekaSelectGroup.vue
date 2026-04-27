<template>
    <SelectRoot :multiple v-model="selectedValue">
        <label v-if="label">{{  label  }}</label>
        <SelectTrigger class="select__dropdown-button">
            <SelectValue 
                class="dropdown-button__text"
                :placeholder="placeholder" 
                :as="selectValueOption?.as" 
            />
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
                            :key="getItemProp(item, labelProp)"
                        >
                            <SelectItemIndicator v-if="showItemIndicator">
                                <CheckIcon :size="16" />
                            </SelectItemIndicator>
                            <SelectItemText>
                                <slot name="itemLabel" :text="getItemProp(item, labelProp)">{{ getItemProp(item, labelProp) }}</slot>
                            </SelectItemText>
                        </SelectItem>
                    </SelectGroup>
                </SelectViewport>

                <SelectScrollDownButton class="select__scroll-button">
                    <ChevronDownIcon />
                </SelectScrollDownButton>
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
    SelectItemIndicator,
    SelectPortal,
    SelectRoot,
    SelectTrigger,
    SelectViewport,
    SelectScrollDownButton,
} from "reka-ui";

import { CheckIcon, ChevronDownIcon } from "lucide-vue-next";

import { getItemProp } from "@/utils/select";
import type { 
    SelectGroupProps, 
    SelectValue as SelectValueType,
} from "@/types/ui";

defineProps<SelectGroupProps>();

const selectedValue = defineModel<SelectValueType>("selectedValue", {
    default: undefined
});
</script>
